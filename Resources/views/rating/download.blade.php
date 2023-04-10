
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
        <style>
            html {
                font-family: 'helvetica neue', helvetica, arial, sans-serif;
                font-size:10px;
            }
            .page-break {
                page-break-after: always;
            }

            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #eceeef;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #eceeef;
            }

            .table tbody + tbody {
                border-top: 2px solid #eceeef;
            }

            .table .table {
                background-color: #fff;
            }

            .table-sm th,
            .table-sm td {
                padding: 0.3rem;
            }

            .table-bordered {
                border: 1px solid #000000;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #3a4047;
            }

            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 1px;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

            .table-responsive.table-bordered {
                border: 0;
            }
            .font-italic{
                font-style: italic;
            }
            .bg-dark{
                background-color: #0F192A;
                color:#eceeef;
            }

            @media print {
                .page-break { page-break-after: always; } /* page-break-after works, as well */
            }

        </style>
    </head>

    <body>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-dark">
                            <th colspan="2">Performance Contract Plan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold">
                                Serial
                            </td>
                            <td>
                                {{strtoupper($plan->id)}}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Session
                            </td>
                            <td>
                                {{strtoupper($plan->financialYear->name)}}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Employee
                            </td>
                            <td>
                                {{$plan->staff->fullname()}}
                                ({{$plan->staff->employment->position->name}})
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Supervisor
                            </td>
                            <td>
                                {{$plan->appraiser->fullname()}}
                                ({{$plan->appraiser->employment->position->name}})
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Weight
                            </td>
                            <td class="font-weight-bold">
                                {{$plan->totalWeight()}} %</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Status
                            </td>
                            <td class="font-weight-bold">
                                {{$plan->plan_status}}
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="page-break"></div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th>Rating</th>
                            <th>Mid Year</th>
                            <th>End Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Self Rating</th>
                            <td>{{$plan->midYearPerformance()->getTotalSelfRate()}}</td>
                            <td>{{$plan->endYearPerformance()->getTotalSelfRate()}}</td>
                        </tr>
                        <tr>
                            <th>Supervisor Rating</th>
                            <td>{{$plan->midYearPerformance()->getTotalAppraiserRate()}}</td>
                            <td>{{$plan->endYearPerformance()->getTotalAppraiserRate()}}</td>
                        </tr>
                        <tr>
                            <th>Agreed Rating</th>
                            <td>{{$plan->midYearPerformance()->getTotalAgreedRate()}}</td>
                            <td>{{$plan->endYearPerformance()->getTotalAgreedRate()}}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-dark">
                            <th colspan="2" >Overall Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Agreed Rate</th>
                            <td>{{$plan->overallPerformance()->getTotalAgreedRate()}}</td>
                        </tr>
                        <tr>
                            <th>Overall Rate</th>
                            <td>{{$plan->overallPerformance()->getFinalRate()}}</td>
                        </tr>
                        <tr>
                            <th>Overall Status</th>
                            <td>{{$plan->overallPerformance()->getStatus()}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="page-break"></div>

        @foreach($pillars as $key => $pillar)
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-dark">
                                <th colspan="4">
                                    <strong>
                                        {{$pillar->name}} ({{$plan->getPillarWeight($pillar)}} %)
                                    </strong>
                                </th>
                                <th colspan="4">
                                    <strong>Mid Year Rating</strong>
                                </th>
                                <th colspan="4">
                                    <strong>End Year Rating</strong>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">Objectives(Goals)</th>
                                <th scope="col">Measures(KPIs)</th>
                                <th scope="col">Targets</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Self</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Agreed</th>
                                <th scope="col">Outcome</th>
                                <th scope="col">Self</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Agreed</th>
                                <th scope="col">Outcome</th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($plan->getPillarDeliverables($pillar) as $deliverable)
                            @foreach($deliverable->indicators as $index => $indicator)
                                @if($index == 0)
                                    <tr>
                                        <td class="font-weight-normal" rowspan="{{$deliverable->indicators->count()}}">
                                            {{$deliverable->name}}
                                            ({{$deliverable->totalWeight()}} %)
                                        </td>

                                        <td class="font-italic">{{$indicator->name}}</td>
                                        <td class="font-italic">{{$indicator->target}}</td>
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
                                        <td>{{$indicator->target}}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach

    </body>
</html>

