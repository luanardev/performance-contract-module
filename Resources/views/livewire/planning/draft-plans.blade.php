<div>
    <div class="card card-outline card-info">
        <div class="card-header">
            <div class="card-title">Draft Plans</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @if(count($draftPlans) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>Session</th>
                                        <th>Supervisor</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($draftPlans as $key => $plan)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td class="text-capitalize">
                                            {{strtoupper($plan->financialYear->name)}}
                                        </td>
                                        <td>{{$plan->appraiser->fullname()}}</td>
                                        <td>{{$plan->createdPeriod()}}</td>
                                        <td>{!! $plan->statusBadge() !!}</td>
                                        <td>
                                            <a href="{{route('performance_contract.edit', $plan)}}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a wire:click.prevent="delete('{{$plan->id}}')" href="#"
                                               class="btn btn-sm btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="callout callout-info py-2 mb-4">
                            <p>
                                No draft plans found.
                            </p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>


