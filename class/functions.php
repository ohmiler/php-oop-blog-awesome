<?php 

    class DB_con {

        private $servername = "localhost";
        private $username   = "root";
        private $password   = "root";
        private $dbname     = "oop_database";
        public  $con;

        function __construct() {

            try {
                $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        // เช็ค username ว่ามีในระบบหรือยัง
        public function usernameAvailable($username) {
            // $result = $this->con->query("SELECT username FROM users WHERE username = '$username'");
            // return $result;
            $stmt = $this->con->prepare("SELECT username FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        // สมัครสมาชิก
        public function registration($fullname, $username, $email, $password) {
            $check_username = $this->con->query("SELECT * FROM users WHERE username = '$username'");
            $check_email = $this->con->query("SELECT * FROM users WHERE email = '$email'");
            
            if ($check_username->num_rows > 0) {
                echo "<script>alert('Username already taken!');</script>";
            } else if($check_email->num_rows > 0) {
                echo "<script>alert('Email already taken!');</script>";
            } else {
                $result = $this->con->prepare("INSERT INTO users(fullname, username, email, password) VALUES(?, ?, ?, ?)");
                $result->bind_param("ssss", $fullname, $username, $email, $password);
                $result->execute();
                return $result;
            }
        }

        // เข้าสู่ระบบ
        public function signIn($username, $password) {
            // $result = $this->con->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            // return $result;
            $stmt = $this->con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        // ดึงข้อมูล User
        public function userDetails($sql){
            $query = $this->con->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }

        // ดึงข้อมูลนักเขียนทั้งหมด
        public function fetchAllData() {
            $query = $this->con->query("SELECT * FROM users");
            return $query;
        }
 
        // เพิ่มข้อมูลบทความ
        public function insertData($post_title, $post_content, $post_image, $post_username) {
            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode('.', $post_image['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'uploads/'.$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($post_image['size'] > 0 && $post_image['error'] == 0) {
                    if (move_uploaded_file($post_image['tmp_name'], $filePath)) {
                        $query = "INSERT INTO posts(post_title, post_content, post_image, post_username) VALUES('$post_title', '$post_content', '$fileNew', '$post_username')";
                        $sql = $this->con->query($query);
                        return $sql;

                        // $sql = $this->con->prepare("INSERT INTO posts(post_title, post_content, post_image, post_username) VALUES(?, ?, ?, ?)");
                        // $sql->bind_param("ssss", $post_title, $post_content, $fileNew, $post_username);
                        // $sql->execute();
                        // return $sql;
                    }
                }
            }
        }

        // แสดงผลข้อมูล posts
        public function displayData() {
		    $sql = "SELECT * FROM posts";
		    $query = $this->con->query($sql);
		    return $query;
		}

        // ดึงข้อมูล Single post
        public function getSingle($sql){
            $query = $this->con->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }

        // ดึงข้อมูล post ของแต่ละคน
        public function getSingleByUsername($sql){
            $query = $this->con->query($sql);
            return $query;
        }

        // จำกัดข้อความ post
        public function limitWords($text, $limit) {
            if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos   = array_keys($words);
                $text  = substr($text, 0, $pos[$limit]) . '...';
            }
            return $text;
        }

        // แสดงข้อมูลตัวเก่าก่อน Edit
        public function displayRecordById($id) {
		    $query = "SELECT * FROM posts WHERE id = '$id'";
		    $result = $this->con->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                echo "Record not found";
            }
		}

        // แก้ไขข้อมูลบทความ
        public function editData($post_id, $post_title, $post_content, $post_image, $post_username) {
            $query = "UPDATE posts SET post_title = '$post_title', 
                    post_content = '$post_content', 
                    post_image = '$post_image',
                    post_username = '$post_username' WHERE id = '$post_id'";
            $sql = $this->con->query($query);
            return $sql;
        }

        // ลบบทความ
        public function deleteData($id) {
            $sql = "DELETE FROM posts WHERE id = '$id'";
            $query = $this->con->query($sql);
            if ($query == true) {
                echo "<script>alert('Post deleted successfully!');</script>";
                echo "<script>window.location.href='home.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again');</script>";
                echo "<script>window.location.href='home.php'</script>";
            }
        }
        
        // ค้นหาข้อมูล
        public function searchData($term) {
            if ($term == "") {
                $_SESSION['nodata'] = "กรุณาใส่ข้อมูลที่ต้องการค้นหา";
                header("location: index.php");
            } else {
                $query = "SELECT * FROM posts WHERE post_title LIKE '%".$this->con->real_escape_string($term)."%'";
                $result = $this->con->query($query);
                return $result;
            }
        }
    }

?>
