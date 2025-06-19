<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TriviaTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_csrf_is_disabled()
    {
        $response = $this->post('/csrf-test');
        $response->assertStatus(200);
    }

    public function test_form_validation_works()
    {
        // $this->withoutMiddleware();
        $response = $this->post('/start-quiz', [], ['HTTP_REFERER' => '/']);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['full_name', 'email', 'number_of_questions', 'difficulty', 'type']);
    }

    public function test_trivia_api_and_filtering()
    {
        // $this->withoutMiddleware();        
        // Simulate a valid form submission
        $payload = [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'number_of_questions' => 5,
            'difficulty' => 'easy',
            'type' => 'multiple',
        ];

        $response = $this->post('/start-quiz', $payload, ['HTTP_REFERER' => '/']);
        $response->assertRedirect('/quiz');
        $this->assertNotEmpty(session('questions'));
        foreach (session('questions') as $q) {
            $this->assertNotEquals('Entertainment: Video Games', $q['category']);
        }
    }

    public function test_quiz_navigation_and_results()
    {
        // $this->withoutMiddleware();
        // Setup session with dummy questions
        $questions = [
            ['question' => 'Q1', 'category' => 'Science', 'incorrect_answers' => ['A','B','C'], 'correct_answer' => 'D'],
            ['question' => 'Q2', 'category' => 'Math', 'incorrect_answers' => ['E','F','G'], 'correct_answer' => 'H'],
        ];
        session(['questions' => $questions, 'answers' => [], 'current' => 0]);

        $response = $this->get('/quiz');
        $response->assertStatus(200);

        $response = $this->post('/quiz/answer', ['answer' => 'D']);
        $response->assertRedirect('/quiz');

        session(['questions' => $questions, 'answers' => ['D'], 'current' => 1]);
        $response = $this->post('/quiz/answer', ['answer' => 'H']);
        $response->assertRedirect('/results');
    }
}