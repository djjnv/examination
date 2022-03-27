<?php
    $conn = mysqli_connect('localhost','root','','exampanel');

   
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
        
   
?>