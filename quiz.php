<?php require('conn.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Exam Panel</title>
</head>
<body>
    <div>
    <h2>Welcome <?php echo $_SESSION['name']; ?> in Examination Panel</h2>
        <div class="quiz-head">
            <?php
                $sql = "select * from question";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "$row['question']";
                  }
                }
            ?>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="radio" name="" id="">
        </form>
    </div>
</body>
</html>