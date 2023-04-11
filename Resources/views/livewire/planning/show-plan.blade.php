<div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">
                    <li class="nav-item">
                        <a href="{{route('performance_contract.home')}}" class="nav-link">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    @if($plan->isDraft())
                    <li class="nav-item">
                        <a href="{{route('performance_contract.plan.edit', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i> Edit
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{route('performance_contract.rating.midyear', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-star"></i> Mid Rating
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.rating.endyear', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-star"></i> Final Rating
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.rating.performance', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i> Performance
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.plan.copy', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i> Copy
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.plan.share', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-share"></i> Share
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('performance_contract.plan.download', $plan)}}" target="_blank" class="nav-link">
                            <i class="nav-icon fas fa-download"></i> Download
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <livewire:performancecontract::planning.plan-header
                :plan="$plan"
            />
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
