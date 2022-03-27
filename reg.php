<?php require('conn.php'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0-9/css/all.css" integrity="sha512-h7GJ1/B7ne4IeavUbcBsiAfjGg0HOg0jbLn0q3nm3iCZwDJSuRrW3xqsri7KMR2wEKOOQlf6zKCoS9jk0AtFPQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>how to confirm password</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

        body{
        background-color:#fff;
        }

        input[type=text], input[type=password]{
        width: 100%;
        padding: 12px 6px 12px 48px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }
        .form-wrapper {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        border-radius: 8px;
        background-color: #fff;
        padding: 20px;
        width:30%;
        margin: 0 auto;
        font-family: 'Lato', sans-serif;
        
        }

        ::placeholder{
        font-family: 'Lato', sans-serif;
        font-size:1.2rem;
        opacity:0.5;
        }
        h1 {
        margin: 0;
        text-align:center;
        font-family: 'Lato', sans-serif;
        font-size:2rem;
        text-transform:uppercase;
        color:#5352ed;
        }
        .submit-btn {
        width: 100%;
        background-color: #5352ed;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-transform:uppercase;
        font-size:1.2rem;
        }
        input[type=submit]:hover {
        background-color: #45a049;
        }

    </style>
</head>
<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh; height: auto; width: 100%;">
    <div class="form-wrapper">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="position:relative; overflow:hidden; ">
        <img src="assets/images/user-image.jpg" alt="" style="width:100%;max-width: 170px; height:auto; display:block; margin :2rem auto; border-radius: 50%; ">
        <h1>Create Account</h1>
        <div style="position: relative; width: 100%">
            <i class="fa fa-user" style="position: absolute;
            top: 19px;
            left: 20px;
            font-size: 16px;"></i>
            <input type="text" name="name" placeholder="Enter name">
        </div>
        
        <input type="text" name="reg" placeholder="Enter Registration Number">
        <input type="password" name="pass" placeholder="Enter Password">
        <input type="text" name="cpass" placeholder="Confirm Password">
        <button type="submit" class="submit-btn" name="submitBtn">REGISTER</button> 
        <?php

            $name = $reg = $pass = $cpass = "";

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $name=test_input($_POST['name']);
                $reg=test_input($_POST['reg']);
                $pass=test_input($_POST['pass']);
                $cpass=test_input($_POST['cpass']);

                
                if(empty($name)||empty($reg)||empty($pass)||empty($cpass))
                {
                    echo "<p style='color:red; text-align: center;'> Some Fields are Empty</p>";                  
                }
                elseif(!preg_match('/^[0-9]*$/',$reg)) //check pass is alphabets 'not allowed'
                {
                    echo "<p style='color:red; text-align: center;'>Only Numeric Allowed in Regiteration no!</p>";
                }
                
                elseif(!preg_match('/^[a-zA-Z\s]+$/',$pass)) //check pass is numeric 'not allowed'
                {
                    echo "<p style='color:red; text-align: center;'>Numeric Password Not Allowed!</p>";
                }

                elseif($pass==$cpass)
                {
                    echo "<p style='color:green; text-align: center;'>Password Matched! Registration Succesfully, Wait for 3 Sec</p>";
                    $sql="insert into users(name,reg,password)values('$name','$reg','$pass')";
                    mysqli_query($conn,$sql);
                    $_SESSION['name'] = $name;
                    header('Refresh: 3; URL=login.php');
                    
                }
                else
                {
                    echo "<p style='color:red; text-align: center;'>Password not Matched!</p>";
                }
            }

            //secure data inputs
            function test_input($data) 
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        </form>
    </div>
</body>
</html>

