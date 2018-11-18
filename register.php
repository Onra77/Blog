<php
require_once('connect.php')
if(isset($_POST) & !empty($_POST)){
    $username = mysql_real_escape_string($connection, $_POST['username']);
    $email = mysql_real_escape_string($connection, $_POST['email']);
    $password = md5($_POST['password']);
     
     $sql = "INSERT INTO 'login' (username, email, password) VALUES ('$username', '$email', '$password')";
     $result = mysqli_query($connection, $sql);
     if($result){
        $smsg = "Gebruiker succesvol geregisteerd.";
     }else{
        $fsmg = "Registratie mislukt."
     }
     
     }
}     

>

    
<!DOCTYPE html> 
<html>
<head>
        <title>Registreren</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 

       <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    
        <link rel="stylesheet" type="text/css" href="styles.css"
</head>    
<body>
    <div class="container">
        <form class="form-signing" method="POST">
        <h2 class="form-signin-heading">Registeren</h2>
        <div class="input-group">
    <span class="input-group-addon"         id="basic-addon1">@</span>
        <input type="text"     name="username" class="form-control" placeholder="Gebruikersnaam" required>
    </div>    
        <label for="inputEmail" class="sr-only">Email adress</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Wachtwoord</label>
        <input type="password" name="password" id="inputPasword" class="form-control" placeholder="Wachtwoord vereist">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registeer</button>
        <a class="btn btn-lg btn-primary btn-block" href="index.php">Login</a>
    </form>
    </div>
</body>
</html>