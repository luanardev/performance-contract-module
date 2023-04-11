
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Document</title>
        <style>
            html {
                font-family: 'helvetica neue', helvetica, arial, sans-serif;
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
                            <th colspan="2">Performance Contract Report</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="font-weight-bold">
                                Session
                            </td>
                            <td>
                                {{strtoupper($financialYear->name)}}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">
                                Supervisor
                            </td>
                            <td>
                                {{$appraiser->fullname()}}
                                ({{$appraiser->employment->position->name}})
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="bg-dark">
                                <th colspan="3">Staff</th>
                                <th colspan="3">Mid Year</th>
                                <th colspan="3">End Year</th>
                                <th colspan="2">Overall</th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Staff</th>
                                <th>Position</th>
                                <th>Self</th>
                                <th>Manager</th>
                                <th>Agreed</th>
                                <th>Self</th>
                                <th>Manager</th>
                                <th>Agreed</th>
                                <th>Overall</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{$plan->staff->employee_number}}</td>
                                <td>{{$plan->staff->fullname()}}</td>
                                <td>{{$plan->staff->getPosition()}}</td>
                                <td>{{$plan->midYearPerformance()->getSelfRate()}}</td>
                                <td>{{$plan->midYearPerformance()->getAppraiserRate()}}</td>
                                <td>{{$plan->midYearPerformance()->getAgreedRate()}}</td>
                                <td>{{$plan->endYearPerformance()->getSelfRate()}}</td>
                                <td>{{$plan->endYearPerformance()->getAppraiserRate()}}</td>
                                <td>{{$plan->endYearPerformance()->getAgreedRate()}}</td>
                                <td>{{$plan->overallPerformance()->getFinalRate()}}</td>
                                <td>{{$plan->overallPerformance()->getStatus()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>

