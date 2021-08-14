<?php 

    session_start();

    // ไม่ต้องเช็ค SESSION เพราะทุกคนสามารถอ่านบทความได้
    // if ($_SESSION['username'] == "") {
    //     header("location: index.php");
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Post</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="index.php">BlogAwesome</a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php 
                        if (isset($_SESSION['username'])) {
                    ?>
                    <li class="nav-item">
                        <a href="create.php" class="nav-link btn btn-success">Write article</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, <?php echo $_SESSION['username']; ?> 
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="home.php">Profile</a></li>
                        <li><a class="dropdown-item" href="#">User settings</a></li>
                        <li><a class="dropdown-item" href="#">My articles</a></li>
                        <li><a class="dropdown-item" href="#">Write article</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                    </li>
                    <?php } else {  ?>
                    <a href="signin.php" class="btn btn-success me-2">Login</a>
                    <a href="signup.php" class="btn btn-primary">Sign-up</a>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>


    <section class="py-5 container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <?php 
                    include_once('class/functions.php');

                    if (isset($_GET['id'])) {
                        $post_id = $_GET['id'];
                        $postdata = new DB_con();
                        //fetch user data
                        $sql = "SELECT * FROM posts WHERE id = $post_id";
                        $row = $postdata->getSingle($sql);
                    }
                ?>
                <h1 class="fw-light"><?php echo $row['post_title']; ?></h1>
                <hr>
                <div>
                    <span>Post by <?php echo $row['post_username']; ?> at</span>
                    <span class="text-muted">
                        <?php echo $row['post_date']; ?>
                    </span>
                    <img src="uploads/<?php echo $row['post_image']; ?>" class="img-fluid rounded mt-4" alt="">
                    <p class="my-4"><?php echo $row['post_content']; ?></p>
                </div>
                <hr>
                <a class="btn btn-secondary" href="index.php"><i class="bi bi-arrow-left"></i> Go back</a>
            </div>
        </div>
    </section>


    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
