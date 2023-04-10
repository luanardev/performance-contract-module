
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark">
                        <th colspan="3">
                           {{$pillar->name}} ({{$this->getTotalWeight()}} %)
                        </th>
                        <th colspan="4">End Year Rating</th>
                    </tr>
                    <tr>
                        <th scope="col" style="width: 20%">Objectives(Goals)</th>
                        <th scope="col" style="width: 20%">Measures(KPIs)</th>
                        <th scope="col" style="width: 20%">Targets</th>
                        <th scope="col" style="width: 10%">Weight</th>
                        <th scope="col" style="width: 10%">Rate</th>
                        <th scope="col" style="width: 20%">Outcome</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($this->deliverables() as $deliverable)

                        @foreach($deliverable->indicators as $index => $indicator)
                            @if($index == 0)
                                <tr>
                                    <td class="font-weight-normal" rowspan="{{$deliverable->indicators->count()}}">
                                        {{$deliverable->name}}
                                        ({{$deliverable->totalWeight()}} %)
                                    </td>

                                    <td class="font-italic">{{$indicator->name}}</td>
                                    <td class="font-italic">{{$indicator->target}}</td>
                                    <td class="font-italic">{{$indicator->weight}} %
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.self_rate" class="form-control" />
                                    </td>
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.outcome" class="form-control" />
                                    </td>

                                </tr>
                            @else
                                <tr>
                                    <td class="font-italic">{{$indicator->name}}</td>
                                    <td class="font-italic">{{$indicator->target}}</td>
                                    <td class="font-italic">{{$indicator->weight}} %
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.self_rate" class="form-control" />
                                    </td>
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.outcome" class="form-control" />
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
