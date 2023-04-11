<?php

namespace Lumis\PerformanceContract\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Lumis\Organization\Exceptions\FinancialYearNotFoundException;
use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\Organization\Entities\FinancialYear;
use Lumis\StaffManagement\Exceptions\StaffNotFoundException;

class SharedController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function inbox(): Renderable
    {
        $staff = StaffProfile::get();
        $financialYear = FinancialYear::getCurrent();

        if(empty($staff)){
            throw new StaffNotFoundException();
        }

        if(empty($financialYear)){
            throw new FinancialYearNotFoundException();
        }

        return view('performancecontract::shared.inbox')->with([
            'staff' => $staff,
            'financialYear' => $financialYear
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function outbox(): Renderable
    {
        $staff = StaffProfile::get();
        $financialYear = FinancialYear::getCurrent();

        if(empty($staff)){
            throw new StaffNotFoundException();
        }

        if(empty($financialYear)){
            throw new FinancialYearNotFoundException();
        }

        return view('performancecontract::shared.outbox')->with([
            'staff' => $staff,
            'financialYear' => $financialYear
        ]);
    }


}
