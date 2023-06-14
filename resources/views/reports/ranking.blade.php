@extends('layouts.app')
@section('content')
<h1>Faculty Ranking Report</h1>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Select Quarter</label>
            <form action="{{ route('faculties.ranking') }}" method="GET">
                <select class="form-control" name="quarter" onchange="this.form.submit()">
                    <option value="">All Quarters</option>
                    <option value="1st"{{ Request::input('quarter') === '1st' ? ' selected' : '' }}>1st</option>
                    <option value="2nd"{{ Request::input('quarter') === '2nd' ? ' selected' : '' }}>2nd</option>
                    <option value="3rd"{{ Request::input('quarter') === '3rd' ? ' selected' : '' }}>3rd</option>
                    <option value="4th"{{ Request::input('quarter') === '4th' ? ' selected' : '' }}>4th</option>
                </select>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-sm btn-primary mb-2" type="button" onclick="printJS('printJS-form', 'html')">
            Print
        </button>
        <table class="table table-bordered" id="printJS-form">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Faculty</th>
                    <th>Average Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facultyRankings as $key => $facultyRanking)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $facultyRanking['faculty']->full_name }}</td>
                        <td>{{ $facultyRanking['averageRate'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
