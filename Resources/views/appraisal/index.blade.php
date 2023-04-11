@extends('performancecontract::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">
                        Performance Appraisals
                        <span class="text-muted font-weight-light">
                            ({{strtoupper($financialYear->name)}})
                        </span>
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('performance_contract.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appraisal</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <nav class="mb-4">
                            <ul class="nav nav-pills flex-sm-row"  role="menu">

                                <li class="nav-item">
                                    <a href="{{route('performance_contract.report')}}" class="nav-link">
                                        <i class="fa fa-chart-pie"></i> Performance Report
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Please choose staff member</h3>
                        </div>
                        <div class="card-body">
                             <livewire:performancecontract::appraisal.submitted-plans
                                 :appraiser="$appraiser"
                                 :financialYear="$financialYear"
                             />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
