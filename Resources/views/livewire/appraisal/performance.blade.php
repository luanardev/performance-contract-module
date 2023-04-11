
<div class="row">
    <div class="col-lg-12">
        <div class="float-left">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">

                    <li class="nav-item">
                        <a href="{{route('performance_contract.appraisal.show', $plan)}}" class="nav-link">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
    <div class="col-lg-12">
        <livewire:performancecontract::appraisal.header
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
                <td>{{$this->midYear()->getSelfRate()}}</td>
                <td>{{$this->endYear()->getSelfRate()}}</td>
            </tr>
            <tr>
                <th>Supervisor Rating</th>
                <td>{{$this->midYear()->getAppraiserRate()}}</td>
                <td>{{$this->endYear()->getAppraiserRate()}}</td>
            </tr>
            <tr>
                <th>Agreed Rating</th>
                <td>{{$this->midYear()->getAgreedRate()}}</td>
                <td>{{$this->endYear()->getAgreedRate()}}</td>
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
                    <td>{{$this->overall()->getAgreedRate()}}</td>
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
