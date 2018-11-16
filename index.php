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
    
    <form action="search.php" method="GET">
        <input placeholder="Werkt helaas nog niet. :(" type="text" name="query" />
        <input type="submit" value="Search" />
    </form>
    
//     
    
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