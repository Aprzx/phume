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
    <link rel="stylesheet" href="style_phume_register.css">
</head>

<body>

    <form method="POST" action="save_member.php">
        <div class="container">
            <p>register</p>
            <?php
            //checking if the session 'success' is set.
            if (isset($_SESSION['success'])) {
            ?>
                <!-- Display regostration success message -->
                <div class="alert-success"><?php echo $_SESSION['success'] ?></div>
            <?php
                //Unsetting the 'success' session after displaying the message.
                unset($_SESSION['success']);
            }
            ?>

            <div class="group">
                <label>username</label>
                <input type="text" name="username" class="control" required="required" /></br>
            </div>
            <div class="group">
                <label>email</label>
                <input type="text" name="email" class="control" required="required" /></br>
            </div>
            <div class="group">
                <label>password</label>
                <input type="password" name="password" class="control" required="required" /></br>
            </div>


            <button class="btn" name="register">register</button>
            <a href="login_phum.php">Already a member? Log in here...</a>
        </div>

    </form>
</body>

</html>