<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\Organization\Exceptions\FinancialYearNotFoundException;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\StaffManagement\Exceptions\StaffNotFoundException;

class HomeController extends Controller
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

        return view('performancecontract::home')->with([
            'staff' => $staff,
            'financialYear' => $financialYear
        ]);
    }


}
