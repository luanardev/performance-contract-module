@extends('performancecontract::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0">
                        End Year Rating
                        <span class="text-muted font-weight-light">
                            ({{strtoupper($plan->financialYear->name)}})
                        </span>
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('performance_contract.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('performance_contract.appraisal.index') }}">Appraisal</a></li>
                        <li class="breadcrumb-item active">Rating</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <livewire:performancecontract::appraisal.end-year-rating :plan="$plan" />
                </div>
            </div>
        </div>
    </div>

@endsection
