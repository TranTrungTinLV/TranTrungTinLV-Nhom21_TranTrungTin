<?php
   include_once '../resouce/session.php';
   include_once '../resouce/database.php';
   include_once '../resouce/ulities.php';
    if(isset($_POST['SignUp'])){

        $form_errors = array();

        //Form calition
        $required_fields = array('email', 'username', 'password');

        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        $feilds_to_check_length = array('username' => 3, 'password' => 8);

        $form_errors = array_merge($form_errors, check_min_length($feilds_to_check_length));

        $form_errors = array_merge($form_errors, check_email($_POST));

        if(empty($form_errors)){
            //collect
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            //hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try{
            //Create
            $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                        VALUES (:username, :email , :password, now())";
            //use PDO
            $statement = $db->prepare($sqlInsert);
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

            if($statement ->rowCount() == 1){
                
                $result = "<p style = 'color:green ; margin:2px 0;'> Successfully</p>";
            }
        }catch(PDOException $ex){
            $result = "<p style = 'padding : 20px; color:red;'>Error : " .$ex->getMessage(). "</p>";
        }
    }
    else{
        if(count($form_errors) == 1){
            $result = "<p style = 'padding : 20px; color:red;'>There was 1 error in the form</p>";
        }else{
            $result = "<p style='color:red;'>There are" .count($form_errors) . "error in the form <br>";
            
        } 
    }
}
 
    
    ?>


<?php 
    include_once '../resouce/session.php';
    include_once '../resouce/database.php';
    include_once '../resouce/ulities.php';

    if(isset($_POST['LoginBtn'])){
        //array to hold errors
    $form_errors = array();

    //validate
    $required_fields = array('usernameSignIn' , 'passwordSignIn');

    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)){

        //collect form data
        $user = $_POST['usernameSignIn'];
        $password = $_POST['passwordSignIn'];
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
                $index = 'http://localhost:8001/guestbook1/Components/users/User.php';
                header("location: {$index}");
            }else{
                $result1 = "<p style='color:red;'>Invalid username or password</p>";

            }
        }
    }else{
        if(count($form_errors) == 1){
            $result1 = "<p style='color:red;'>There was one error in the form</p>";
        }else{
            $result1 = "<p style='color:red;'>There were" .count($form_errors) ."error in the form</p>";
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
    <div class="loader ">
    </div>

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign
                In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

            <div class="login-form">
                <div class="sign-in-htm">
                    <?php if(isset($result1)) echo $result1; ?>
                    <?php if(!isset($form_errors)) echo show_errors($form_errors); ?>
                    <form action="" name="frmSignIn" method = "post">
                        <div id="pthongbao">
                            <p id="thongbao">

                            </p>
                        </div>
                        <div class="group">
                            <label for="name" class="label" >Username</label>
                            <input  type="text" class="input" id="name" name = "usernameSignIn" required/>
                        </div>
                        <div class="group">
                            <label for="password" class="label"  name="txtPassWord">Password</label>
                            <input  type="password" class="input" id="password" name = "passwordSignIn" required/>
                        </div>
                        
                        <div class="group">
                            <input type="submit" class="button" value="Sign In" id="signin"  name="LoginBtn"/>
                        </div> 
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="Forgotpassword.php" target = "_blank">Forgot Password?</a>
                        </div>
                    </form>
                    <p><a href = "index.php">Back</a></p>
                </div>
                <div class="sign-up-htm">
                    <?php if(isset($result)) echo $result; ?>
                    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
                    <form action="" name="frmSignUp" method = "post">
                    <div id="pthongbao1">
                            <p id="thongbao1">

                            </p>
                        </div>
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="user" type="text" class="input" name = "username" />
                        </div>
                        <div class="group">
                            <label for="password2" class="label">Password</label>
                            <input id="password2" type="password" class="input" name = "password" />
                        </div>
                        <div class="group">
                            <label for="password" class="label">Email Address</label>
                            <input id="email2" type="email" class="input" name = "email">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up" id="signup" name = "SignUp" />
                       </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Already Member?</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="signup.js">

    </script>
</body>

</html>