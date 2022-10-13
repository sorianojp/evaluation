@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-sm-8 my-1">
            <h3><span class="font-weight-bold">My Evaluations for:</span> {{ $evaluation->faculty->name }}</h3>
            <div class="card my-1">
                <div class="card-header bg-primary text-white">Rating Legend</div>
                <div class="card-body">
                    <div>5 = Strongly Agree 4 = Agree 3 = Uncertain 2 = Disagree 1 = Strongly Disagree</div>
                </div>
            </div>
            <table class="table table-bordered">

                @foreach ($categories as $i => $questions)
                <tr>
                    <th>{{ $i }}</th>
                    <th width="280px">My Rate</th>
                </tr>

                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->question }}</td>
                            <td>
                                {{ $question->pivot->rate }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
@endsection
