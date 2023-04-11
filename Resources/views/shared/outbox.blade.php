@extends('performancecontract::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">
                         My Outbox
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('performance_contract.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Outbox</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Shared with colleagues</h3>
                        </div>
                        <div class="card-body">
                            <livewire:performancecontract::shared.outbox :staff="$staff" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
