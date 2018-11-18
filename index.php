<?php
    Session_start();

 //login not avalible yet.
    /* if{isset} ($_session['']) {
        header("location: login.php");
        return;
    } */

    include_once("db.php");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
    
    </head>
<div id=makeup>
<body>
    
       <form class="form-signin" method="POST">
       	   <span class="input-group-addon" id="basic-addon1"></span>
	       <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" required>
	       <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <input type="button" value="Registeer" onclick="location.href='register.php';">
            <input type="button" value="Nieuwe bericht" onclick="location.href='post.php';">
        </form>
    
        
    <?php
    require_once("nbbc.php");
    
    $bbcode = new BBCode;
    
    $sql = "SELECT * FROM post ORDER BY id DESC";
    
    $res = mysqli_query($db, $sql) or die(mysqli_error($db));
    
    $post ="";
    
    if(mysqli_num_rows($res) >0) {
        while($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $date = $row['date'];

/* de knoppen Delete, Edit en New.  */
            
            $admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a>&nbsp;<a href='post.php?pid=$id'>New</a></div>";
            
            $output = $bbcode->Parse($content);
            
            $post .="<div><h2><a href='view_post/php?pid=$id'>$title</a></h2><h3>$date</h3><p>$output</p>$admin</div>";
          }
        echo $post;
    }  else {
        echo "Niets te zien!";
    }
    
  ?>
        
    </body>
    </div>  
</html>