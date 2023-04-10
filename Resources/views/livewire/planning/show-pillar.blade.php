
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark">
                        <th colspan="4">
                           {{$pillar->name}} ({{$this->getTotalWeight()}} %)
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" style="width:35%">Objectives(Goals)</th>
                        <th scope="col" style="width:35%">Measures(KPIs)</th>
                        <th scope="col" style="width:25%">Targets</th>
                        <th scope="col" style="width:5%">Weight</th>
                    </tr>
                </thead>

                <tbody>
                @if($this->hasDeliverables())
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
                                </tr>
                            @else
                                <tr>
                                    <td class="font-italic">{{$indicator->name}}</td>
                                    <td class="font-italic">{{$indicator->target}}</td>
                                    <td class="font-italic">{{$indicator->weight}} %</td>
                                </tr>
                            @endif
                        @endforeach

                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-muted text-center font-italic">
                            Record not found
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
