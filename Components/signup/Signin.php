<?php 
    include_once '../resouce/session.php';
    include_once '../resouce/database.php';
    include_once '../resouce/ulities.php';

    if(isset($_POST['LoginBtn'])){
        //array to hold errors
    $form_errors = array();

    //validate
    $required_fields = array('username' , 'password');

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)){

        //collect form data
        $user = $_POST['username'];
        $password = $_POST['password'];
        //check if user exist in the database
        $sqlQuery = "SELECT * FROM users WHERE username = :username";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':username' => $user));

        while ($row = $statement->fetch()) {
            $id = $row['id'];
            $hashed_password = $row['password'];
            $username = $row['username'];

            if(password_verify($password, $hashed_password)){
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                
                header("location: index.php");
            }else{
                $result = "<p style='color:red;'>Invalid username or password</p>";

            }
        }
    }else{
        if(count($form_errors) == 1){
            $result = "<p style='color:red;'>There was one error in the form</p>";
        }else{
            $result = "<p style='color:red;'>There were" .count($form_errors) ."error in the form</p>";
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
    <title>Chatbox</title>
    <link rel="stylesheet" href="signup_in.css">
    <script type="text/javascript" src="validition.js"></script>
</head>


<body>
<div class="sign-in-htm">
                    <?php if(isset($result)) echo $result; ?>
                    <?php if(!isset($form_errors)) echo show_errors($form_errors); ?>
                    <form action="" name="frmSignIn" method = "post">
                        <div id="pthongbao">
                            <p id="thongbao">

                            </p>
                        </div>
                        <div class="group">
                            <label for="name" class="label" >Username</label>
                            <input  type="text" class="input" id="name" name = "username" required/>
                        </div>
                        <div class="group">
                            <label for="password" class="label"  name="password">Password</label>
                            <input  type="password" class="input" id="password" name = "password" required/>
                        </div>
                        
                        <div class="group">
                            <input type="submit" class="button" value="Sign In" id="signin"  name="LoginBtn"/>
                        </div> 
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </form>
                    <p><a href = "index.php">Back</a></p>
                </div>
</div>
</body>

</html>

