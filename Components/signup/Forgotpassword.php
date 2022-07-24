<?php
  include_once '../resouce/database.php';
  include_once '../resouce/ulities.php';

  //process the form if the reset password button is clicked
  if(isset($_POST['passwordResetBtn'])){
    //initialize an arr to store any error message from the form
    $form_errors = array();

    //Form validation 
    $required_fields = array('email', 'new_password', 'confirm_password');

    //call the function to checking for minium length
    $fields_to_check_length = array('new_password' => 6 , 'confirm_password' => 6);

    //Fields that requires checking for minium length
    $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

    //call the function to check minium required length and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation / merge the return data into from_error array
    $form_errors = array_merge($form_errors, check_email($_POST));

    //check if error is empty , if yes process form data and insert record
    if(empty($form_errors)){
      $email = $_POST['email'];
      $password1 = $_POST['new_password'];
      $password2 = $_POST['confirm_password'];

      //check if new password and confirm password is same
      if($password1 != $password2){
        $result = "<p style = 'padding:20px; border:1px solid gray; color:red'>New password and confirm password does not match</p>";
      }else{
        try{
          //create SQL select statement to verify  if email address input exist in the database
          $sqlQuery = "SELECT email FROM users WHERE email =:email";

          //use PDO prepared to sanitize data
          $statement = $db->prepare($sqlQuery);

          //execute the query
          $statement->execute(array(':email'=> $email));

          //check if record exist
          if($statement->rowCount() == 1){
            //hash the password
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

            //SQL statement to update password
            $sqlUpdate = "UPDATE users SET password =:password WHERE email =:email";

            //use PDO prepared to sanitize SQL statement
            $statement = $db->prepare($sqlUpdate);

            //execute the statement
            $statement->execute(array(':password' => $hashed_password, ':email' => $email));

            $result = "<p style='padding:20px ; border:1px solid gray; color:green;'>Password reset Success</p>";
          }
          else{
            $result = "<p style='padding:20px ; border:1px solid gray; color:red;'>The email address provide does not exist in our database , please try again </p>";

          }
        }catch(PDException $ex){
          $result = "<p style='padding:20px; border:1px solid gray; color:red;'>An error occured: ".$ex->getMessage()."</p>";
        }
      }
    }
      else{
        if(count($form_errors) == 1){
          $result = "<p style = 'color : red;'>There was 1 error in the form</p>";
        }else{
          $result = "<p style='color:red;'>There were" .count($form_errors). "errors in the form <br>";
        }
      }
    }
   
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/—Pngtree—white pop style cloud dot_4040591.png">
    <title>Forgot</title>
</head>


<body>
    <h3>Reset Password</h3>
      <?php if(isset($result)) echo $result;?>
      <?php if(!empty($form_errors)) echo show_errors($form_errors);?>
      <form method = "post" action = "">
        <table>
          <tr><td>Email:</td><td><input type="text" value="" name="email"></td></tr>
          <tr><td>New PassWord:</td><td><input type="password" value="" name="new_password"></td></tr>
          <tr><td>confirm_password</td><td><input type="password" value="" name="confirm_password"></td></tr>
          <tr><td></td><td><input type="submit" value="Reset Now" name="passwordResetBtn" style = "float:right"></td></tr>
        </table>
      </form>
</body>

</html>



