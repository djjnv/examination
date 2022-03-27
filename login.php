<?php require('conn.php'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>how to confirm password</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

        body{
        background-color:#fff;
        }

        input[type=text], input[type=password]{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }
        div {
        position:absolute;
        top:40%;
        left:50%;
        transform:translate(-50%,-50%);
        border-radius: 5px;
        background-color: #f2f2f2;
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
        input[type=submit] {
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
        

        #notice{
        width: 80%;
        background-color: #009432;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-transform:uppercase;
        font-size:1.2rem;
        text-align:center;
        margin:8px auto;
        padding:5px;
        }
        #notice a
        {
        font-size:.9rem;
        text-decoration:none;
        color: white;  
        }

    </style>
</head>
<body>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h1>Sign in</h1>
        <input type="text" name="name" placeholder="Enter Your Name">
        <input type="text" name="reg" placeholder="Enter Registration Number">
        <input type="password" name="pass" placeholder="Enter Password">
        <input type="submit" value="LOGIN">
        <?php

            $name = $reg = $pass ="";

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $name=test_input($_POST['name']);
                $reg=test_input($_POST['reg']);
                $pass=test_input($_POST['pass']);

                if(empty($name)||empty($reg)||empty($pass))
                {
                    echo "<p style='color:red; text-align: center;'> Please Enter Registration or Password </p>";                  
                }
                elseif(!preg_match('/^[a-zA-Z\s]+$/',$name)) //check pass is numeric 'not allowed'
                {
                    echo "<p style='color:red; text-align: center;'>Numeric not Allowed !</p>";
                }
                elseif(!preg_match('/^[0-9]*$/',$reg)) //check pass is alphabets 'not allowed'
                {
                    echo "<p style='color:red; text-align: center;'>Only Numeric Allowed in Regiteration no!</p>";
                }
                elseif(!preg_match('/^[a-zA-Z\s]+$/',$pass)) //check pass is numeric 'not allowed'
                {
                    echo "<p style='color:red; text-align: center;'>Numeric Password Not Allowed!</p>";
                }
                else
                {

                
                    $sql = "Select * from users where reg = '$reg' && password = '$pass'";
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0)
                    {
                        $_SESSION['name'] = $name;
                        $_SESSION['pass'] = $pass;

                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            
                            <p id="notice"><a href = 'quiz.php/?id=<?php echo  $_SESSION['id'] =$row['id']; ?>'><?php echo "Welcome $name Click Here to Proceed";?></a></p>
                       
                            
                            <?php
                        }
                        
                    }
                    else
                    {
                        echo "<p style='color:red; text-align: center;'>Registration invalid !</p>";
                    }

                
                
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