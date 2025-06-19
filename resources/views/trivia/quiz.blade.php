@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Question {{ $index }} of {{ $total }}</h3>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{!! $question['question'] !!}</h5>
            <form method="POST" action="{{ route('trivia.answer') }}">
                @csrf
                @foreach($answers as $answer)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="{{ md5($answer) }}" value="{{ $answer }}" required>
                        <label class="form-check-label" for="{{ md5($answer) }}">{!! $answer !!}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success mt-3">Next</button>
            </form>
        </div>
    </div>
</div>
@endsection