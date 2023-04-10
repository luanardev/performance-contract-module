
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark">
                        <th colspan="6">
                            {{$pillar->name}} ({{$this->getTotalWeight()}} %)
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" style="width:10%">Action</th>
                        <th scope="col" style="width:25%">Objectives(Goals)</th>
                        <th scope="col" style="width:25%">Measures(KPIs)</th>
                        <th scope="col" style="width:25%">Targets</th>
                        <th scope="col" style="width:5%">Weight</th>
                        <th scope="col" style="width:10%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if($this->hasDeliverables())
                        @foreach($this->deliverables() as $deliverable)

                            @foreach($deliverable->indicators as $index => $indicator)
                                @if($index == 0)
                                    <tr>
                                        <td rowspan="{{$deliverable->indicators->count()}}">
                                            <button wire:click="createDeliverable" class="btn btn-sm btn-success">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                            <button wire:click="deleteDeliverable('{{$deliverable->id}}')" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td rowspan="{{$deliverable->indicators->count()}}">
                                            <input wire:model.lazy="deliverables.{{$deliverable->id}}.name" class="form-control" />
                                        </td>
                                        <td>
                                            <input wire:model.lazy="indicators.{{$indicator->id}}.name" class="form-control" />
                                        </td>
                                        <td>
                                            <input wire:model.lazy="indicators.{{$indicator->id}}.target" class="form-control" />
                                        </td>
                                        <td>
                                            <input wire:model.lazy="indicators.{{$indicator->id}}.weight" class="form-control" />
                                        </td>
                                        <td>
                                            <button wire:click="addIndicator('{{$deliverable->id}}')" class="btn btn-sm btn-success">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                            <button wire:click="deleteIndicator('{{$indicator->id}}')" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <input wire:model.lazy="indicators.{{$indicator->id}}.name" class="form-control" />
                                        </td>
                                        <td>
                                            <input wire:model.lazy="indicators.{{$indicator->id}}.target" class="form-control" />
                                        </td>
                                        <td>
                                            <input wire:model.lazy="indicators.{{$indicator->id}}.weight" class="form-control" />
                                        </td>
                                        <td>
                                            <button wire:click="addIndicator('{{$deliverable->id}}')" class="btn btn-sm btn-success">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                            <button wire:click="deleteIndicator('{{$indicator->id}}')" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        @endforeach
                    @else
                        <tr>
                            <td>
                                <button wire:click="createDeliverable" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </td>
                            <td colspan="4" class="text-muted font-italic">
                                Record not found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

