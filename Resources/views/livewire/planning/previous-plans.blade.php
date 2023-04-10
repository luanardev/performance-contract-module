<div>
    <div class="card card-outline card-dark">
        <div class="card-header">
            <div class="card-title">My Previous Plans</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($previousPlans) > 0)
                        <div class="table-responsive pre-scrollable">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Session</th>
                                    <th>Supervisor</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($previousPlans as $key => $plan)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td class="text-capitalize">
                                            {{strtoupper($plan->financialYear->name)}}
                                        </td>
                                        <td>{{$plan->appraiser->fullname()}}</td>
                                        <td>{{$plan->submittedPeriod()}}</td>
                                        <td>{!! $plan->statusBadge() !!}</td>
                                        <td>
                                            <a href="{{route('performance_contract.show', $plan)}}"
                                               class="btn btn-sm btn-outline-primary">Open</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="callout callout-info py-2 mb-4">
                            <p>
                                No previous plans found.
                            </p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>


