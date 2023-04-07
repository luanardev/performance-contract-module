<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\PerformanceContract\Entities\Pillar;
use Lumis\PerformanceContract\Entities\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(): Renderable
    {
        $staff = StaffProfile::get();
        if(empty($staff)){

        }
        return view('performancecontract::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('performancecontract::create');
    }


    /**
     * Show the specified resource.
     * @param Plan $plan
     * @return Renderable
     */
    public function show(Plan $plan): Renderable
    {
        return view('performancecontract::show')->with([
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
            return view('performancecontract::edit')->with([
                'plan' => $plan
            ]);
        }

    }


}
