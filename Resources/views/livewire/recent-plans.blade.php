<div>
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-title">My Recent Plans</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($recentPlans) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>Session</th>
                                        <th>Appraiser</th>
                                        <th>Submitted</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($recentPlans as $key => $plan)
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
                                No recent plans found.
                            </p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>


