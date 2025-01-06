<!DOCTYPE html>
<?php
    //starting the session
    session_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="stlye_phume1.css">
    </head>

    <body>
        <form method="POST" action="login_query.php">
            <div class="container">
                <p>login</p>
                <?php
                //checking if the session 'error' is set. Erro session is the message if the 'Username' and 'Password' is not valid.
                if (isset($_SESSION['error'])) {
                ?>
                    <!-- Display Login Error message -->
                    <div class="alert-danger"><?php echo $_SESSION['error'] ?></div>
                <?php
                    //Unsetting the 'error' session after displaying the message.
                    unset($_SESSION['error']);
                }
                ?>
                <div class="group">
                    <label>username</label>
                    <input type="text" name="username" class="control" required="required" /></br>
                </div>
                <div class="group">
                    <label>password</label>
                    <input type="password" name="password" class="control" required="required" /></br>
                </div>

                <button class="btn" name="login">login</button>
            </div>
        </form>
        <script src="style.js"></script>
    </body>


    </html>