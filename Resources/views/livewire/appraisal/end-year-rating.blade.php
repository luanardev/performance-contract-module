<div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">
                    <li class="nav-item">
                        <a href="{{route('performance_contract.appraisal.show', $plan)}}" class="nav-link">
                            <i class="fa fa fa-arrow-left"></i> Back
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <livewire:performancecontract::appraisal.header
                :plan="$plan"
            />
        </div>
    </div>
    @foreach($pillars as $key => $pillar)
        <livewire:performancecontract::appraisal.rate-end-year
            :plan=$plan
            :pillar=$pillar
            :wire:key="'rate-mid-year-'.$key.'-'.$pillar->id"
        />
    @endforeach
</div>
