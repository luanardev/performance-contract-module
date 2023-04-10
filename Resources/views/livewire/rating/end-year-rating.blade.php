<div>
    <div class="row">
        <div class="col-lg-12">
            <livewire:performancecontract::rating.rating-nav
                :plan="$plan"
            />
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
        <livewire:performancecontract::rating.rate-end-year
            :plan=$plan :pillar=$pillar
            :wire:key="'rate-end-year-'.$key.'-'.$pillar->id"
        />
    @endforeach
</div>
