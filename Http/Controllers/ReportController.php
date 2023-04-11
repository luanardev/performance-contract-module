<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Exceptions\StaffNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ReportController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        $appraiser = StaffProfile::get();

        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        if(empty($appraiser)){
            throw new StaffNotFoundException();
        }

        return view('performancecontract::report.index')->with([
            'appraiser' => $appraiser
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param FinancialYear $financialYear
     * @return Response
     */
    public function download(FinancialYear $financialYear): Response
    {
        $appraiser = StaffProfile::get();

        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        if(empty($appraiser)){
            throw new StaffNotFoundException();
        }

        $plans = Plan::appraisedBy($appraiser)
            ->where('financial_year', $financialYear->id)
            ->get();

        $pdf = Pdf::loadView('performancecontract::report.download', [
            'appraiser' => $appraiser,
            'financialYear' => $financialYear,
            'plans' => $plans
        ]);

        $pdf->setPaper('A4', 'landscape');

        $name = $financialYear->name;
        $postPix = "performance report";

        $fileName = Str::kebab("{$name} {$postPix}");
        return $pdf->stream($fileName.'.pdf');
    }




}
