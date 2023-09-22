<?php
$FirstNameErr = $LastNameErr = $PhoneErr = $emailErr = $passwordErr = "";
$fName = $lName = $PhoneNo = $email = $Password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["FirstName"])) {
        $FirstNameErr = "First name is required";
    } else {
        $fName = $_POST["FirstName"];
    }

    if (empty($_POST["LastName"])) {
        $LastNameErr = "Last name is required";
    } else {
        $lName = $_POST["LastName"];
    }

    if (empty($_POST["PhoneNo"])) {
        $PhoneErr = "Phone number is required";
    } else {
        $PhoneNo = $_POST["PhoneNo"];
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!filter_let($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["Password"])) {
        $passwordErr = "Password is required";
    } else {
        $Password = $_POST["Password"];
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*[@#$%^&+=!])(?=.{8,})/", $Password)) {
            $passwordErr = "Password must be at least 8 characters, including one alphabet and one special character";
        }
    }

    if (empty($FirstNameErr) && empty($LastNameErr) && empty($PhoneErr) && empty($emailErr) && empty($passwordErr)) {
      header("Location:http://localhost:8080/php/form.php");
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="main-conatiner">
        <div class="form-head">
          <span>SIGN UP</span>
        </div>
        <div class="form-container">
          <form action="index.php" method="post">
            <label for="FirstName">First Name: </label> <span class="error">*</span>
            <input type="text" id="FirstName" name="FirstName" value= '<?php echo "$fName" ?>'/><br>
            <span class="error_msg">
                <?php 
            echo $FirstNameErr;
            echo "<br>"; ?></span>
            

            <label for="LastName">Last Name:</label><span class="error">*</span><br />
            <input type="text" id="LastName" name="LastName" value= '<?php echo "$lName" ?>' /><br />
            <span class="error_msg">
                <?php 
            echo $LastNameErr;
            echo "<br>"; ?></span>
            <label for="PhoneNo">Phone No:</label><span class="error">*</span><br />
            <input
              type="number"
              id="PhoneNo"
              name="PhoneNo"
              oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
              maxlength="10"
              value= '<?php echo "$PhoneNo" ?>'
            /><br />
            <span class="error_msg">
                <?php 
            echo $PhoneErr;
            echo "<br>"; ?></span
            <label for="email">E-mail:</label><span class="error">*</span><br />
            <input
              type="email"
              id="email"
              name="email"
              pattern=".+@gmail\.com"
              value= '<?php echo "$email" ?>'
            /><br />
            <span class="error_msg">
                <?php 
            echo $emailErr;
            echo "<br>"; ?></span>
            <label for="Password">Password:</label><span class="error">*</span><br />
            <input type="password" id="Password" name="Password"  value= '<?php echo "$Password" ?>' /><br />
            <span class="error_msg">
                <?php 
            echo $passwordErr;
            echo "<br>"; ?></span>
           
            <button type="signUp" id="submit">Sign Up</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>