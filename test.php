<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Alert</title>
</head>
<body>
    <form action="check_database.php" method="post">
        <button type="submit">Check Database</button>
    </form>
    <div id="alert-container">
        <?php if (isset($_GET['alert']) && $_GET['alert'] == 'true'): ?>
            <p><?php echo htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
 