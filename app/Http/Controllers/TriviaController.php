<?php

namespace App\Http\Controllers;

use App\Http\Requests\TriviaFormRequest;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TriviaController extends Controller
{
    // Show the trivia form
    public function showForm()
    {
        return view('trivia.form');
    }

    // Handle form submission, fetch questions, store search, redirect to quiz
    public function startQuiz(TriviaFormRequest $request)
    {
        // Save search to DB
        $search = SearchHistory::create($request->only([
            'full_name', 'email', 'number_of_questions', 'difficulty', 'type'
        ]));

        // Fetch questions from Open Trivia DB
        $response = Http::get('https://opentdb.com/api.php', [
            'amount' => $request->number_of_questions,
            'difficulty' => $request->difficulty,
            'type' => $request->type,
        ]);

        $data = $response->json();
        $questions = $data['results'] ?? [];

        // Filter out "Entertainment: Video Games"
        $filtered = array_filter($questions, function ($q) {
            return $q['category'] !== 'Entertainment: Video Games';
        });

        // Sort by category
        usort($filtered, function ($a, $b) {
            return strcmp($a['category'], $b['category']);
        });

        // Store in session
        session([
            'questions' => array_values($filtered),
            'answers' => [],
            'current' => 0,
            'search_id' => $search->id,
        ]);

        return redirect()->route('trivia.quiz');
    }

    // Show a single question at a time
    public function showQuiz()
    {
        $questions = session('questions', []);
        $current = session('current', 0);

        if ($current >= count($questions)) {
            return redirect()->route('trivia.results');
        }

        $question = $questions[$current];
        // Prepare shuffled answers
        $answers = $question['incorrect_answers'];
        $answers[] = $question['correct_answer'];
        shuffle($answers);

        return view('trivia.quiz', [
            'question' => $question,
            'answers' => $answers,
            'index' => $current + 1,
            'total' => count($questions),
        ]);
    }

    // Handle answer submission and move to next question
    public function submitAnswer(Request $request)
    {
        $questions = session('questions', []);
        $current = session('current', 0);
        $answers = session('answers', []);

        $answers[$current] = $request->input('answer');
        session(['answers' => $answers, 'current' => $current + 1]);

        if ($current + 1 >= count($questions)) {
            return redirect()->route('trivia.results');
        }
        return redirect()->route('trivia.quiz');
    }

    // Show all answers at the end
    public function showResults()
    {
        $questions = session('questions', []);
        $answers = session('answers', []);

        return view('trivia.results', [
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }

    public function showHistory()
    {
        $history = \App\Models\SearchHistory::orderBy('created_at', 'desc')->paginate(15);
        return view('trivia.history', compact('history'));
    }    
}