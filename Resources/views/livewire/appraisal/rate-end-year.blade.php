
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark">
                        <th colspan="6">
                           {{$pillar->name}} ({{$this->getTotalWeight()}} %)
                        </th>
                        <th colspan="2">End Year Rating</th>
                    </tr>
                    <tr>
                        <th scope="col" style="width: 20%">Objectives(Goals)</th>
                        <th scope="col" style="width: 20%">Measures(KPIs)</th>
                        <th scope="col" style="width: 20%">Targets</th>
                        <th scope="col" style="width: 20%">Outcome</th>
                        <th scope="col" style="width: 10%">Weight</th>
                        <th scope="col" style="width: 10%">Rating</th>
                        <th scope="col">Manager</th>
                        <th scope="col">Agreed</th>
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
                                    <td class="font-italic">{{$indicator->endYearRating()?->outcome}}</td>
                                    <td class="font-italic">{{$indicator->weight}}
                                    <td class="font-italic">{{$indicator->endYearRating()?->self_rate}}
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.appraiser_rate" class="form-control" />
                                    </td>
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.agreed_rate" class="form-control" />
                                    </td>

                                </tr>
                            @else
                                <tr>
                                    <td class="font-italic">{{$indicator->name}}</td>
                                    <td class="font-italic">{{$indicator->target}}</td>
                                    <td class="font-italic">{{$indicator->endYearRating()?->outcome}}</td>
                                    <td class="font-italic">{{$indicator->weight}}
                                    <td class="font-italic">{{$indicator->endYearRating()?->self_rate}}
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.appraiser_rate" class="form-control" />
                                    </td>
                                    <td>
                                        <input wire:model.lazy="ratings.{{$indicator->id}}.agreed_rate" class="form-control" />
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
