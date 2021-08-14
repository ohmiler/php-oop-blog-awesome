<?php
    // include Function file
    include_once('class/functions.php');

    // Object creation
    $userdata = new DB_con();
    
    // Getting Post value
    $username = $_POST["username"]; 
    // Calling function
    $data = $userdata->usernameAvailable($username);

    if($data->num_rows > 0) {
        echo "<span style='color:red'>Username already associated with another account.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color:green'>Username available for Registration.</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }

?>