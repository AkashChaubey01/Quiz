<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="template.css">
</head>
<body>
<div class="container">
        <?php if (isset($score)): ?>
            <p class="result">Your score is <?php echo $score; ?> out of 25.</p>
        <?php else: ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>