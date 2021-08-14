<?php 

  session_start(); 
  

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

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">BlogAwesome</h1>
        <p class="lead text-muted">ยินดีต้อนรับเข้าสู่ BlogAwesome เว็บไซต์สำหรับคนรักการอ่าน</p>
        <p>
          <a href="authors.php" class="btn btn-primary my-2">นักเขียนของเรา</a>
        </p>
        
        <form action="search.php" method="POST" class="d-flex">
          <input class="form-control me-2" type="text" name="term" placeholder="ค้นหาบทความ..." aria-label="Search">
          <button class="btn btn-outline-success" type="submit">ค้นหา</button>
        </form>
      </div>
    </div>
  </section>

  <div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="https://via.placeholder.com/150x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div> -->

            <!-- <?php 
          
                include_once('class/functions.php');
                $postObj = new DB_con();
                $posts = $postObj->displayData(); 

                while($row = $posts->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img style="object-fit: cover;" height="300px" src="uploads/<?php echo $row['post_image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['post_title']; ?></h5>
                        <p class="card-text"><?php echo $postObj->limitWords($row['post_content'], 20); ?></p>
                        <a href="single.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div> -->
        
          <div class="row">
          <?php 
              include_once('class/Pagination.php');
              $postsPagi = new Pagination();
              $results = $postsPagi->createPagination(); 
              while ($row = $results->fetch_assoc()) { 
          ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img style="object-fit: cover;" height="300px" src="uploads/<?php echo $row['post_image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['post_title']; ?></h5>
                        <p class="card-text"><?php echo $postObj->limitWords($row['post_content'], 20); ?></p>
                        <a href="single.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
          <?php } ?>
        </div>
        <ul class="pagination">
          <?php for($x = 1; $x <= $postsPagi->totalPages + 1; $x++) {?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
          <?php } ?>
        </ul>
    </div>
  </div>
  

</main>

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
