<?php

namespace Lumis\PerformanceContract\Entities;

use Lumis\Organization\Entities\FinancialYear;
use Lumis\StaffManagement\Entities\Staff;

class StaffPlan
{

    /**
     * @var Staff
     */
    protected Staff $staff;

    /**
     * @var FinancialYear
     */
    protected FinancialYear $financialYear;

    /**
     * @param Staff $staff
     * @param FinancialYear $financialYear
     *
     */
    public function __construct(Staff $staff, FinancialYear $financialYear=(new FinancialYear))
    {
        $this->staff = $staff;
        $this->financialYear = $financialYear;
    }

    /**
     * @return Staff
     */
    public function staff(): Staff
    {
        return $this->staff;
    }

    /**
     * @return FinancialYear
     */
    public function financialYear(): FinancialYear
    {
        return $this->financialYear;
    }

    public function getRecentPlans()
    {
        return Plan::where('staff_id', $this->staff->id)
            ->where('financial_year', $this->financialYear->id)
            ->where('plan_status', 'Completed')
            ->latest()
            ->get();
    }

    public function getRecentDrafts()
    {
        return Plan::where('staff_id', $this->staff->id)
            ->where('financial_year', $this->financialYear->id)
            ->where('plan_status', 'Draft')
            ->latest()
            ->get();

    }

    public function getArchivePlans()
    {
        return Plan::where('staff_id', $this->staff->id)
            ->where('plan_status', 'Archived')
            ->latest()
            ->get();

    }
}
