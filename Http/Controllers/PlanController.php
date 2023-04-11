<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Support\Renderable;
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

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        $staff = StaffProfile::get();
        $financialYear = FinancialYear::getCurrent();

        if(empty($staff)){
            throw new StaffNotFoundException();
        }

        if(empty($financialYear)){
            throw new FinancialYearNotFoundException();
        }

        return view('performancecontract::planning.index')->with([
            'staff' => $staff,
            'financialYear' => $financialYear
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('performancecontract::planning.create');
    }


    /**
     * Show the specified resource.
     * @param Plan $plan
     * @return Renderable
     */
    public function show(Plan $plan): Renderable
    {
        return view('performancecontract::planning.show')->with([
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function edit(Plan $plan): Renderable|RedirectResponse
    {
        if($plan->isCompleted()){
            return back()->with('error', 'Cannot edit once submitted');
        }else{
            return view('performancecontract::planning.edit')->with([
                'plan' => $plan
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function share(Plan $plan): Renderable|RedirectResponse
    {
        if($plan->isDraft()){
            return back()->with('error', 'Cannot share incomplete plan');
        }else{
            return view('performancecontract::planning.share')->with([
                'plan' => $plan
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Response|RedirectResponse
     */
    public function download(Plan $plan): Response|RedirectResponse
    {
        if($plan->isDraft()){
            return back()->with('error', 'Cannot download incomplete plan');
        }else{
            $pillars = Pillar::all();

            $pdf = Pdf::loadView('performancecontract::planning.download', [
                'plan' => $plan,
                'pillars' => $pillars
            ]);

            $pdf->setPaper('A4', 'landscape');

            $staffName = $plan->staff->name();
            $postPix = "performance plan";

            $fileName = Str::kebab("{$staffName} {$postPix}");
            return $pdf->stream($fileName.'.pdf');
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable
     */
    public function copy(Plan $plan): Renderable
    {
        return view('performancecontract::planning.copy')->with([
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable
     */
    public function reuse(Plan $plan): Renderable
    {
        return view('performancecontract::planning.reuse')->with([
            'plan' => $plan
        ]);
    }


}
