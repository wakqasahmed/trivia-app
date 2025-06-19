@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Trivia Quiz Setup</h2>
    <form method="POST" action="{{ route('trivia.start') }}">
        @csrf
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}">
            @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="number_of_questions" class="form-label">Number of Questions</label>
            <input type="number" name="number_of_questions" min="1" max="49" class="form-control @error('number_of_questions') is-invalid @enderror" value="{{ old('number_of_questions', 10) }}">
            @error('number_of_questions') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="difficulty" class="form-label">Select Difficulty</label>
            <select name="difficulty" class="form-select @error('difficulty') is-invalid @enderror">
                <option value="">Choose...</option>
                <option value="easy" {{ old('difficulty') == 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="medium" {{ old('difficulty') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="hard" {{ old('difficulty') == 'hard' ? 'selected' : '' }}>Hard</option>
            </select>
            @error('difficulty') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Select Type</label>
            <select name="type" class="form-select @error('type') is-invalid @enderror">
                <option value="">Choose...</option>
                <option value="multiple" {{ old('type') == 'multiple' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="boolean" {{ old('type') == 'boolean' ? 'selected' : '' }}>True / False</option>
            </select>
            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Start Quiz</button>
    </form>
</div>
@endsection