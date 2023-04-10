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

        @foreach($pillars as $key => $pillar)
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="4">
                                    {{$pillar->name}} ({{$plan->getPillarWeight($pillar)}} %)
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </body>
</html>
