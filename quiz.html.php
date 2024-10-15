<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <div class="">
        <?php if (isset($message)) { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } else { ?>
            <?php if (!isset($_SESSION['start_time'])) { ?>
                <form action="quiz.php" method="post">
                    <input type="submit" name="start_quiz" value="Start Quiz">
                </form>
            <?php } else { ?>
                <?php if ($timer_expired) { ?>
                    <p>Time's up! Please try again.</p>
                <?php } else { ?>
                    <p id="timer" class="timer"></p>
                    <form action="quiz.php" method="post">
                        <?php
                        $question_counter = 0;
                        foreach ($questions as $question) {
                            ?>
                            <div class="container">
                                <p><span>></span></span><?php echo $question['question']; ?></p>
                                <?php
                                // Check if the question has options
                                if (!empty($question['option1']) && !empty($question['option2']) && !empty($question['option3']) && !empty($question['option4'])) {
                                    ?>
                                    <div class="options">
                                        <div class="option">
                                            <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $question['option1']; ?>"><?php echo $question['option1']; ?><br>
                                        </div>
                                        </div>
                                        <div class="option">
                                            <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $question['option2']; ?>"><?php echo $question['option2']; ?><br>
                                        </div>
                                        <div class="option">
                                            <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $question['option3']; ?>"><?php echo $question['option3']; ?><br>
                                        </div>
                                        <div class="option">
                                            <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $question['option4']; ?>"><?php echo $question['option4']; ?><br>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <p>No options found for this question.</p>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            $question_counter++;
                            if ($question_counter >= count($questions)) {
                                break;
                            }
                        }
                        ?>
                        <input type="submit" class="button-56" id="submit-btn" name="submit_quiz" value="Submit Quiz">
                        
                    </form>
                    
                    <script>
                        var timer = <?php echo $timer; ?>;
                        var start_time = <?php echo $_SESSION['start_time']; ?>;

                        function updateTimer() {
                            var now = new Date().getTime() / 1000;
                            var elapsed_time = now - start_time;
                            var remaining_time = Math.max(timer - elapsed_time, 0);

                            if (remaining_time > 0) {
                                var minutes = Math.floor(remaining_time / 60);
                                var seconds = Math.floor(remaining_time % 60);
                                document.getElementById('timer').innerHTML = 'Time remaining: ' + minutes + ' minutes ' + seconds + ' seconds';
                                setTimeout(updateTimer, 1000);
                            } else {
                                document.getElementById('timer').innerHTML = 'Time\'s up!';
                            }
                        }
                        updateTimer();
                    </script>
                <?php } ?>
            <?php } ?>
            <?php } ?>
    </div>
</body>
</html>