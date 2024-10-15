<?php
session_start();

if (isset($_SESSION['score'])) {
    $score = $_SESSION['score'];
    unset($_SESSION['score']);
} else {
    $message = "You didn't take the quiz.";
}

require_once 'template.php';
?>