@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Your Answers</h2>
    <ul class="list-group">
        @foreach($questions as $i => $q)
            <li class="list-group-item">
                <strong>Q{{ $i+1 }}:</strong> {!! $q['question'] !!}<br>
                <strong>Your answer:</strong> {!! $answers[$i] ?? 'No answer' !!}
            </li>
        @endforeach
    </ul>
    <a href="{{ route('trivia.form') }}" class="btn btn-primary mt-3">Try Again</a>
</div>
@endsection