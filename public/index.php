<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['message'])) {
    addMessage($_POST['name'], $_POST['message']);
    header('Location: index.php');
    exit;
}

$messages = getMessages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Wall</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; }
        h1 { text-align: center; margin-bottom: 20px; color: #333; }
        .form { background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .form input, .form textarea { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .form textarea { height: 80px; resize: vertical; }
        .form button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .form button:hover { background: #0056b3; }
        .message { background: white; padding: 15px; border-radius: 8px; margin-bottom: 10px; }
        .message h3 { color: #333; margin-bottom: 5px; }
        .message p { color: #666; margin-bottom: 5px; }
        .message small { color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Message Wall</h1>
        
        <div class="form">
            <form method="POST">
                <input type="text" name="name" placeholder="Your name" required>
                <textarea name="message" placeholder="Write a message..." required></textarea>
                <button type="submit">Post Message</button>
            </form>
        </div>

        <?php foreach ($messages as $m): ?>
            <div class="message">
                <h3><?= htmlspecialchars($m['name']) ?></h3>
                <p><?= nl2br(htmlspecialchars($m['message'])) ?></p>
                <small><?= $m['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
