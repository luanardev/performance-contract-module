<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Lumis\Organization\Exceptions\FinancialYearNotFoundException;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Plan;
use Lumis\StaffManagement\Exceptions\StaffNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AppraisalController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        $appraiser = StaffProfile::get();
        $financialYear = FinancialYear::getCurrent();

        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        if(empty($appraiser)){
            throw new StaffNotFoundException();
        }

        if(empty($financialYear)){
            throw new FinancialYearNotFoundException();
        }

        return view('performancecontract::appraisal.index')->with([
            'appraiser' => $appraiser,
            'financialYear' => $financialYear
        ]);
    }

    /**
     * Show the specified resource.
     * @param Plan $plan
     * @return Renderable
     */
    public function show(Plan $plan): Renderable
    {
        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        return view('performancecontract::appraisal.show')->with([
            'plan' => $plan
        ]);
    }

    /**
     * Show the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function midyear(Plan $plan): Renderable|RedirectResponse
    {
        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        return view('performancecontract::appraisal.midyear')->with([
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function endyear(Plan $plan): Renderable|RedirectResponse
    {
        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        return view('performancecontract::appraisal.endyear')->with([
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Plan $plan
     * @return Renderable|RedirectResponse
     */
    public function performance(Plan $plan): Renderable|RedirectResponse
    {
        if(!can_appraise()){
            throw new AccessDeniedHttpException();
        }

        return view('performancecontract::appraisal.performance')->with([
            'plan' => $plan
        ]);

    }


}
