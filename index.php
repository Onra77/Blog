
<!DOCTYPE HTML>  
<html>
<head>
     <link rel="stylesheet" href="style.css">
    <title>Contact formulier</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $ageErr =$emailErr = $genderErr = $websiteErr = "";
$name = $age = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["age"])) {
    $ageErr = "Age is required";
  } else {
    $age = test_input($_POST["age"]);
    // check if the age is well-formed
    if (!preg_match("/^[0-9 ]*$/",$age)) {
      $ageErr = "Only numbers are allowed";
    }
  }
    
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div id=formulier>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name:<br> <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Age:<br> <input type="number" name="age" value="<?php echo $age;?>">
  <span class="error">* <?php echo $ageErr;?></span>
  <br><br>
  E-mail:<br> <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website:<br> <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Comment:<br> <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
    <input type="submit" name="submit" value="Submit">  
</form>
    </div>
    
<div id=output>    
<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $age;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $gender;
echo "<br>";
echo $comment;
    
$txt = "data2.txt";
if (isset($_POST['name']) && isset($_POST['email'])) { //check if both fields are set
    $fh = fopen($txt, 'a'); 
    
    $text = $_POST['name'].';'.$_POST['age'].';'.$_POST['email'].';'.$_POST['website'].';'.$_POST['comment'].';'.$_POST['gender'].'*';
    $result = fwrite($fh,$text); // Write information to the file
    fclose($fh); // Close the file
}

?>
    </div>

<div id=data>
<?php
echo file_get_contents("data2.txt");
?>     
    </div>    
    
    
</body>
</html>
