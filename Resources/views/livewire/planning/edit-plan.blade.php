<div>
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

                    </ul>
                </nav>
            </div>

            @if($plan->isDraft())
            <div class="float-right">
                <a wire:click.prevent="submit" href="#" class="btn btn-sm btn-outline-primary">
                    <i class="nav-icon fas fa-check-circle"></i> Submit
                </a>
                @if($plan->isDraft())
                <a wire:click.prevent="delete" href="#" class="btn btn-sm btn-outline-danger">
                    <i class="fa fa-trash"></i> Delete
                </a>
                @endif
            </div>
            @endif
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
        <livewire:performancecontract::planning.edit-pillar
            :plan=$plan
            :pillar=$pillar
            :wire:key="'edit-pillar-'.$key.'-'.$pillar->id"
        />
    @endforeach
</div>

