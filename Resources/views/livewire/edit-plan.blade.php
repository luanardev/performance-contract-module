<div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="mb-4">
                <ul class="nav nav-pills flex-sm-row"  role="menu">
                    <li class="nav-item">
                        <a href="javascript:window.history.back();" class="nav-link">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </li>

                    @if($plan->isDraft())
                    <li class="nav-item">
                        <a wire:click.prevent="submit" href="#" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i> Submit
                        </a>
                    </li>
                    @endif
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
        <livewire:performancecontract::edit-pillar
            :plan=$plan :pillar=$pillar
            :wire:key="'edit-pillar-'.$key.'-'.$pillar->id" />
    @endforeach
</div>

