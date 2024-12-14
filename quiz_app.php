<?php

// Define the evaluateQuiz function
define('NEWLINE', "\n");
function evaluateQuiz(array $questions, array $answers): int {
    $score = 0;

    // Compare user answers with correct answers
    foreach ($questions as $index => $question) {
        if (strtolower(trim($answers[$index])) === strtolower(trim($question['correct']))) {
            $score++;
        }
    }

    return $score;
}

// Define the quiz questions
$questions = [
    ['question' => 'What is 2 + 2?', 'correct' => '4'],
    ['question' => 'What is the capital of France?', 'correct' => 'Paris'],
    ['question' => 'Who wrote "Hamlet"?', 'correct' => 'Shakespeare'],
];

// Collect answers from the user
$answers = [];
foreach ($questions as $index => $question) {
    echo ($index + 1) . ". " . $question['question'] . NEWLINE;
    $userAnswer = readline("Your answer: ");
    $answers[] = $userAnswer;
}

// Evaluate the user's score
$score = evaluateQuiz($questions, $answers);
$totalQuestions = count($questions);

// Display the score
echo "You scored $score out of $totalQuestions." . NEWLINE;

// Provide feedback based on performance
if ($score === $totalQuestions) {
    echo "Excellent job!" . NEWLINE;
} elseif ($score > $totalQuestions / 2) {
    echo "Good effort!" . NEWLINE;
} else {
    echo "Better luck next time!" . NEWLINE;
}
