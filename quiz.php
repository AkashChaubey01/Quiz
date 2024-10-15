<?php=
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'quiz';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$timer = 3600; // 1 hour in seconds
$score = 0;
$question_counter = 0;
$query = "SELECT * FROM questions LIMIT 25";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$questions = array();
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

mysqli_close($conn);

if (empty($questions)) {
    $message = "No questions found.";
} else {
    if (isset($_POST['start_quiz'])) {
        unset($_SESSION['start_time']);
        $_SESSION['start_time'] = time();
        header('Location: quiz.php');
        exit;
    } else {
        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] = time();
        } else {
            $_SESSION['start_time'] = time();
        }
    }

    if (isset($_SESSION['start_time'])) {
        $now = new DateTime();
        $elapsed_time = $now->getTimestamp() - $_SESSION['start_time'];
        if ($elapsed_time >= $timer) {
            $timer_expired = true;
        } else {
            $timer_expired = false;
        }
    }

    if (isset($_POST['submit_quiz'])) {
        if ($timer_expired) {
            $message = "Time's up! Please try again.";
        } else {
            $score = 0;
            foreach ($questions as $question) {
                if (isset($_POST['question_' . $question['id']])) {
                    if ($_POST['question_' . $question['id']] == $question['correct_answer']) {
                        $score++;
                    }
                }
            }

            $_SESSION['score'] = $score;

            // Redirect to the results page
            header('Location: results.php');
            exit;
        }
    }
}

include 'quiz.html.php';
?>