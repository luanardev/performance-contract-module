<div>
    <div class="col-lg-12">
        <form wire:submit.prevent="submit" method="post">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <select wire:model="selectedYear" class="form-control" name="financial-year">
                            <option value="">Financial Year</option>
                            @foreach($financialYears as $year)
                                <option value="{{ $year->id }}">{{strtoupper($year->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-flat">Submit</button>
                    </div>
                </div>

            </div>

        </form>
    </div>
    <div class="col-lg-12">
        @if($this->viewable())
            <div class="card card-outline">
                <div class="card-header">
                    <div class="card-title">
                        {{strtoupper($financialYear->name)}}
                        Performance Summary
                    </div>
                    <div class="float-right">
                        <a href="{{route('performance_contract.report.download', $financialYear)}}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="bg-dark">
                                    <th colspan="3">Staff Name</th>
                                    <th colspan="3">Performance</th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Staff</th>
                                    <th>Position</th>
                                    <th>Overall</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($plans as $plan)
                                    <tr>
                                        <td>{{$plan->staff->employee_number}}</td>
                                        <td>{{$plan->staff->fullname()}}</td>
                                        <td>{{$plan->staff->employment->getPosition()}}</td>
                                        <td>{{$plan->overallPerformance()->getFinalRate()}}</td>
                                        <td>{{$plan->overallPerformance()->getStatus()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="callout callout-info">
                <p>No report found</p>
            </div>
        @endif
    </div>
</div>
