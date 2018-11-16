<?php
    session_start();

    if(isset($_POST['login'])) {
        $mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        $username = stripslashes($username);
        $password = stripslashes($password);
        
        $username = mysqli_real_escape_string($mysqli, $username);
        $password = mysqli_real_escape_string($mysqli, $password);
        
        //Query the row and get that row password by matching input username
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        $id = $row['id'];
        $db_password = $row['password'];

        //Compare input password and from querired above

        //$password == $db_password
        if(password_verify($password, $db_password) == TRUE) {
            $_SESSION['username'] = $username;
            $_SESSION['loginid'] = $id;
            header("Location: index.php");
        } else {
            echo "Access denied!";
        }
    }
?>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1 style="font-family: Tahoma;">Login</h1>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <input placeholder="Username" name="username" type="text" autofocus>
        <input placeholder="Password" name="password" type="password">
        <input name="login" type="submit" value="Login">
    </form>
</body>
</html>