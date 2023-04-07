<div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">

                    @if($plan->isDraft())
                    <li class="nav-item">
                        <a href="{{route('performance_contract.edit', $plan)}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i> Edit Plan
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i> MidYear Rating
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i> EndYear Rating
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i> Performance
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i> Copy
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-share"></i> Share
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-download"></i> Download
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <livewire:performancecontract::plan-header :plan="$plan"/>
        </div>
    </div>
    @foreach($pillars as $key => $pillar)
        <livewire:performancecontract::show-pillar
            :plan=$plan :pillar=$pillar
            :wire:key="'show-pillar-'.$key.'-'.$pillar->id" />
    @endforeach
</div>
