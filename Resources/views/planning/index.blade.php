@extends('performancecontract::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">My Performance Plans</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('performance_contract.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Plans</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <livewire:performancecontract::planning.recent-plans
                        :staff="$staff"
                        :financialYear="$financialYear"
                    />
                    <livewire:performancecontract::planning.previous-plans
                        :staff="$staff"
                    />
                </div>
            </div>
        </div>
    </div>

@endsection
