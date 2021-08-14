
<?php 

session_start();

// include function file
include_once('class/functions.php'); 

// object creation
$userdata = new DB_con();

if(isset($_POST['register'])) {

    // Posted Values
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //Function Calling
    $sql = $userdata->registration($fullname, $username, $email, $password);
    if($sql) {
        $_SESSION['username'] = $username;
        // Message for successfull insertion
        echo "<script>alert('Registration successfull.');</script>";
        echo "<script>window.location.href='home.php'</script>";
    } else {
        // Message for unsuccessfull insertion
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='signup.php'</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<title>Hello, world!</title>

<style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>


    <div class="container">
        <main class="form-signin">
            <form method="POST">
                <p align="center"><i style="font-size:4rem;" class="bi bi-person-circle"></i></p>
                <h1 class="mb-3 text-center">Sign Up</h1>

                <div class="form-floating">
                    <input type="text" name="fullname" class="form-control" placeholder="Fullname">
                    <label for="floatingInput">Fullname</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="username" onkeyup="checkusername(this.value)" class="form-control" placeholder="Username">
                    <label for="floatingInput">Username</label>
                    <span id="usernameAvailable"></span>
                </div>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                    <label for="floatingPassword">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" name="register" type="submit">Sign Up</button>
                <p class="mt-5 mb-3 text-muted text-center">&copy; 2021</p>
                <p class="text-muted text-center">Already register? <a href="signin.php">Sign In</a></p>
            </form>
            <hr>
            <a class="btn btn-secondary" href="index.php"><i class="bi bi-arrow-left"></i> Go back</a>
        </main>
    </div>

<!-- Optional JavaScript; choose one of the two! -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkusername(val) {
        $.ajax({
            type: "POST",
            url: "check_availability.php",
            data:'username='+val,
            success: function(data){
                $("#usernameAvailable").html(data);
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>