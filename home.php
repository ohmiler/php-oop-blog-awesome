<?php 

    session_start();

    if ($_SESSION['username'] == "") {
        header("location: index.php");
    }

    include_once('class/functions.php');
    $userdata = new DB_con();
    //fetch user data
    $sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
    $row = $userdata->userDetails($sql);

    // Delete Data
    if (isset($_GET['deleteId'])) {
        $deleteId = $_GET['deleteId'];
        $userdata->deleteData($deleteId);
    }

    function getRandomNumber() {
        $randomNumber = rand();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

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


    <div class="container">
        <h1 class="mt-5">Welcome, <?php echo $_SESSION['username']; ?></h1>
        <hr>
        <h3>บทความของคุณ</h3>
        <div class="row">
            <?php 
              $sql2 = "SELECT * FROM posts WHERE post_username = '".$_SESSION['username']."'";
              $posts = $userdata->getSingleByUsername($sql2);
              while($row2 = $posts->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img style="object-fit: cover;" height="300px" src="uploads/<?php echo $row2['post_image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row2['post_title']; ?></h5>
                        <p class="card-text"><?php echo $row2['post_content']; ?></p>
                        <a href="edit.php?id=<?php echo $row2['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="home.php?deleteId=<?php echo $row2['id']; ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Are you sure to delete this record?')"
                        >
                           Delete
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>
