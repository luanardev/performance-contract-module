
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark">
                        <th colspan="3">
                           {{$pillar->name}} ({{$this->getTotalWeight()}} %)
                        </th>
                        <th colspan="4">Mid Year Rating</th>
                        <th colspan="4">End Year Rating</th>
                    </tr>
                    <tr>
                        <th scope="col">Deliverable</th>
                        <th scope="col">Indicator</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Self</th>
                        <th scope="col">Manager</th>
                        <th scope="col">Agreed</th>
                        <th scope="col">Outcome</th>
                        <th scope="col">Self</th>
                        <th scope="col">Manager</th>
                        <th scope="col">Agreed</th>
                        <th scope="col">Outcome</th>
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
                                    <td>{{$indicator->weight}} %
                                    @if($indicator->midYearRating())
                                        <td>{{$indicator->midYearRating()->self_rate}}</td>
                                        <td>{{$indicator->midYearRating()->appraiser_rate}}</td>
                                        <td>{{$indicator->midYearRating()->agreed_rate}}</td>
                                        <td>{{$indicator->midYearRating()->outcome}}</td>
                                    @else
                                        <td colspan="4" class="text-muted text-center font-italic">Not rated</td>
                                    @endif

                                    @if($indicator->endYearRating())
                                        <td>{{$indicator->endYearRating()->self_rate}}</td>
                                        <td>{{$indicator->endYearRating()->appraiser_rate}}</td>
                                        <td>{{$indicator->endYearRating()->agreed_rate}}</td>
                                        <td>{{$indicator->endYearRating()->outcome}}</td>
                                    @else
                                        <td colspan="4" class="text-muted text-center font-italic">Not rated</td>
                                    @endif
                                </tr>
                            @else
                                <tr>
                                    <td class="font-italic">{{$indicator->name}}</td>
                                    <td>{{$indicator->weight}} %</td>
                                    @if($indicator->midYearRating())
                                        <td>{{$indicator->midYearRating()->self_rate}}</td>
                                        <td>{{$indicator->midYearRating()->appraiser_rate}}</td>
                                        <td>{{$indicator->midYearRating()->agreed_rate}}</td>
                                        <td>{{$indicator->midYearRating()->outcome}}</td>
                                    @else
                                        <td colspan="4" class="text-muted text-center font-italic">Not rated</td>
                                    @endif

                                    @if($indicator->endYearRating())
                                        <td>{{$indicator->endYearRating()->self_rate}}</td>
                                        <td>{{$indicator->endYearRating()->appraiser_rate}}</td>
                                        <td>{{$indicator->endYearRating()->agreed_rate}}</td>
                                        <td>{{$indicator->endYearRating()->outcome}}</td>
                                    @else
                                        <td colspan="4" class="text-muted text-center font-italic">Not rated</td>
                                    @endif
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
