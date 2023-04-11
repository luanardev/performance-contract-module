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
                    Staff Member
                </td>
                <td>
                    {{$plan->staff->fullname()}}
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">
                    Position
                </td>
                <td >
                    {{$plan->staff->employment->position->name}}
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

        </tbody>

    </table>
</div>
