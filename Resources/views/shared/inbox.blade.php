@extends('performancecontract::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">
                        My Inbox
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('performance_contract.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Received from colleagues</h3>
                        </div>
                        <div class="card-body">
                            <livewire:performancecontract::shared.inbox :staff="$staff" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
