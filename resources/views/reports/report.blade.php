@extends('layouts.app')
@section('content')
    <div class="col-sm-4">
        <div class="form-group">
            <label>Select Quarter</label>
            <form action="{{ route('faculties.report', ['faculty' => $faculty]) }}" method="GET">
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
    <div class="col-sm-12">
        <button class="btn btn-sm btn-primary mb-2" type="button" onclick="printJS('printJS-form', 'html')">
            Print
        </button>
        <table class="table table-bordered" id="printJS-form">
            <thead>
                <tr>
                    <th colspan="2">{{ $faculty->full_name }} Report per Question for A.Y. {{ $currentAcademicYear }} {{ Request::input('quarter') ? ' - Quarter ' . Request::input('quarter') : ' - All Quarters' }}</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Average Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($averageRates as $question)
                    <tr>
                        <td>{{ $question['question'] }}</td>
                        <td>{{ $question['average_rate'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
