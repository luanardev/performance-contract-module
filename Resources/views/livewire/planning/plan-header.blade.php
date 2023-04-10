<div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="bg-dark">
                <th colspan="2">Performance Contract Plan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="font-weight-bold">
                    Supervisor
                </td>
                <td>
                    {{$plan->appraiser->fullname()}}
                    ({{$plan->appraiser->employment->position->name}})
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">
                    Weight
                </td>
                <td class="font-weight-bold">
                    {{$plan->totalWeight()}} %</span>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">
                    Status
                </td>
                <td class="font-weight-bold">
                    {{$plan->plan_status}}
                </td>
            </tr>
        </tbody>

    </table>
</div>
