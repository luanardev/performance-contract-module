<div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">
                    <li class="nav-item">
                        <a href="{{route('performance_contract.appraisal.index')}}" class="nav-link">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.appraisal.midyear', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-star"></i> Mid Rating
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.appraisal.endyear', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-star"></i> Final Rating
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.appraisal.performance', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i> Performance
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>

    @foreach($pillars as $key => $pillar)
        <livewire:performancecontract::planning.show-pillar
            :plan=$plan
            :pillar=$pillar
            :wire:key="'show-pillar-'.$key.'-'.$pillar->id"
        />
    @endforeach
</div>
