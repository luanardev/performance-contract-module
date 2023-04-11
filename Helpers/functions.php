<?php

use Lumis\StaffManagement\Entities\StaffProfile;
use Lumis\PerformanceContract\Entities\Plan;


function can_appraise(): bool
{
    $staff = StaffProfile::get();
    return is_appraiser($staff);
}

function is_appraiser($staff): bool
{
    return (bool) Plan::appraisedBy($staff)->get()->count();
}

