@extends('layouts.app')

@section('content')
    <div class="row justify-content-center text-center">
        <div class="col-sm-6">
            <h3>Admin Dashboard</h3>
        </div>
    </div>
    <div class="jumbotron">
        <h3>Welcome!  <span class="font-weight-bold">{{ Auth::user()->full_name }}</span></h3>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <h3>Total Respondents: {{ $totalevaluations}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <a href="{{ route('faculties.index') }}" class="btn btn-primary p-5 btn-block my-2">Faculty Reports</a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('faculties.ranking') }}" class="btn btn-primary p-5 btn-block my-2">Faculty Ranking</a>
        </div>
    </div>
@endsection
