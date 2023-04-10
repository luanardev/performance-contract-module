
<div class="row">
    <div class="col-lg-12">
        <div class="float-left">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">
                    <li class="nav-item">
                        <a href="{{route('performance_contract.home')}}" class="nav-link">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('performance_contract.show', $plan)}}" class="nav-link">
                            <i class="fa fa-eye"></i> View
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.rating.download', $plan)}}" class="nav-link" target="_blank">
                            <i class="fa fa-download"></i> Download
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
    <div class="col-lg-12">
        <livewire:performancecontract::planning.plan-header
            :plan="$plan"
        />
    </div>
    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
            <thead class="bg-dark">
            <tr>
                <th>Rating</th>
                <th>Mid Year</th>
                <th>End Year</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Self Rating</th>
                <td>{{$this->midYear()->getTotalSelfRate()}}</td>
                <td>{{$this->endYear()->getTotalSelfRate()}}</td>
            </tr>
            <tr>
                <th>Supervisor Rating</th>
                <td>{{$this->midYear()->getTotalAppraiserRate()}}</td>
                <td>{{$this->endYear()->getTotalAppraiserRate()}}</td>
            </tr>
            <tr>
                <th>Agreed Rating</th>
                <td>{{$this->midYear()->getTotalAgreedRate()}}</td>
                <td>{{$this->endYear()->getTotalAgreedRate()}}</td>
            </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered">
            <thead>
                <tr class="bg-dark">
                    <th colspan="2" >Overall Performance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Agreed Rate</th>
                    <td>{{$this->overall()->getTotalAgreedRate()}}</td>
                </tr>
                <tr>
                    <th>Overall Rate</th>
                    <td>{{$this->overall()->getFinalRate()}}</td>
                </tr>
                <tr>
                    <th>Overall Status</th>
                    <td>{{$this->overall()->getStatus()}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
