<div>
    <table class="table table-striped table-bordered">
        <tr>
            <td class="font-weight-bold">
                Appraiser
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
    </table>
</div>
