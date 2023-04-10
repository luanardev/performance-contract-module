<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Lumis\Organization\Exceptions\FinancialYearNotFoundException;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Exceptions\StaffNotFoundException;

class RatingController extends Controller
{

    /**
     * Show the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function midyear(Plan $plan): Renderable|RedirectResponse
    {
        if($plan->isDraft()){
            return back()->with('error', 'Cannot rate draft plan');
        }else{
            return view('performancecontract::rating.midyear-rating')->with([
                'plan' => $plan
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function endyear(Plan $plan): Renderable|RedirectResponse
    {
        if($plan->isDraft()){
            return back()->with('error', 'Cannot rate draft plan');
        }else{
            return view('performancecontract::rating.endyear-rating')->with([
                'plan' => $plan
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function performance(Plan $plan): Renderable|RedirectResponse
    {

        return view('performancecontract::rating.performance')->with([
            'plan' => $plan
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Response
     */
    public function download(Plan $plan): Response
    {
        $pillars = Pillar::all();

        $pdf = Pdf::loadView('performancecontract::rating.download', [
            'plan' => $plan,
            'pillars' => $pillars
        ]);

        $pdf->setPaper('A4', 'landscape');

        $staffName = $plan->staff->name();
        $postPix = "performance rating";

        $fileName = Str::kebab("{$staffName} {$postPix}");
        return $pdf->stream($fileName.'.pdf');

    }


}
