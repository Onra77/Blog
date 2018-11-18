<?php
    session_start();
    include_once("db.php");

// zodat de value (om de waarde te behouden na foutmelding) in form niet als tekst wordt geprint.
    $title = '';
    $content = '';

    if(isset($_POST['post'])) {
        
        $title = strip_tags($_POST['title']);
        $content = strip_tags($_POST['content']); 
        $title = mysqli_real_escape_string($db, $title);
        $content = mysqli_real_escape_string($db, $content);
        $captcha = strip_tags($_POST['captcha']); 
                
        $sql =  "INSERT into post (title, content) VALUES ('$title', '$content')";
        
        if($title == "" || $content == "" || $captcha != 2 || $captcha == "") {
            echo "De post is niet compleet ingevuld!";
        }
        else {
            mysqli_query($db, $sql);

            header("Location: index.php");
        }
    
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="post_style.css">
    <title>Blog - Post</title>
</head>
    <body background="3.jpg">
      
       <form action="post.php" method="post" enctype="multipart/form-data">
            <input placeholder="Title" name="title" type="text" autofocus size="48" value=<?php echo $title; ?>><br/><br/>
            <textarea placeholder="Content" name="content" rows="20" cols="50"><?php echo $content; ?></textarea><br/>
            <input name="post" type="submit" value="Post">
            <input name="reset" type="reset" value="Reset">
            <input type="button" value="Terug" onclick="location.href='index.php';">   
               <p>1+1=</p>
            <input placeholder="Wat is de uitkomst?."text" name="captcha">  
        </form>
        
</body>    
</html>