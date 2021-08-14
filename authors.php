<?php 

    session_start();

    include_once("class/functions.php");

    $authorsData = new DB_con();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Welcome to Blog</title>
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
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, <?php echo $_SESSION['username']; ?> 
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="home.php">Profile</a></li>
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


<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">รายชื่อนักเขียน</h1>
      </div>
    </div>
  </section>

  <div class="py-5 bg-light">

    <div class="container">
        <a class="btn btn-secondary mb-3" href="index.php"><i class="bi bi-arrow-left"></i> Go back</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Register Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $result = $authorsData->fetchAllData();
                    while($row = $result->fetch_assoc()) {
                    ?>
                <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['reg_date']; ?></td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
  </div>

    <footer class="text-muted py-5">
      <div class="container">
        <p class="float-end mb-1">
          <a class="btn btn-outline-secondary" href="#">Back to top</a>
        </p>
        <p class="mb-1">&copy; BlogAwesome 2021.</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>
