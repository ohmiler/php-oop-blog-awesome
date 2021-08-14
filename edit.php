<?php 

    session_start();

    if ($_SESSION['username'] == "") {
        header("location: index.php");
    }

    include_once('class/functions.php');

    $postObj = new DB_con();

    if (isset($_POST['update'])) {
        $post_id = $_POST['post_id'];
        $post_title = $_POST['post_title'];
        $post_content = $_POST['post_content'];
        $post_image = $_FILES['post_image'];
        $post_username = $_POST['post_username'];
        $edit = $postObj->editData($post_id, $post_title, $post_content, $post_image, $post_username);
        var_dump($edit);
        if ($edit) {
            // Message for successfull insertion
            echo "<script>alert('Edit post successfull.');</script>";
            echo "<script>window.location.href='home.php'</script>";
        } else {
            // Message for unsuccessfull insertion
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script>window.location.href='edit.php'</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>

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


    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">แก้ไขข้อมูลบทความ</h1>
                <hr>
                <?php 
                    if (isset($_GET['id'])) {
                        $post_id = $_GET['id'];
                        $posts = $postObj->displayRecordById($post_id);
                    }
                ?>
                <form action="edit.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="post_id" value="<?php echo $posts['id'] ; ?>" class="form-control">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" accept="image/*" id="imgInput" name="post_image" class="form-control">
                        <img id="previewImg" class="img-fluid rounded" src="uploads/<?php echo $posts['post_image']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="post_title" required value="<?php echo $posts['post_title']; ?>" class="form-control"  placeholder="ชื่อเรื่อง...">
                        <input type="hidden" name="post_username" value="<?php echo $_SESSION['username'] ; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" required name="post_content" rows="10" placeholder="หนูมาลีมีลูกแมวเหมียว..."><?php echo $posts['post_content']; ?></textarea>
                    </div>
                    <button class="btn btn-success" type="submit" name="update">Update</button>
                </form>
                <hr>
                <a class="btn btn-secondary" href="home.php"><i class="bi bi-arrow-left"></i> Go back</a>
            </div>
        </div>
    </section>


    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script>
        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            console.log(file)
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>

</html>
