<?php 

    class Pagination {

        private $servername = "localhost";
        private $username   = "root";
        private $password   = "root";
        private $dbname     = "oop_database";
        public  $con;
        public $totalPages;

        function __construct() {
            try {
                $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        public function createPagination() {
            // How many records per page
            $rpp = 6;
            // Check for set page
            // isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 0;
            }
            // Check for page 1
            if ($page > 1) {
                $start = ($page * $rpp) - $rpp;
            } else {
                $start = 0;
            }
            // Query db for TOTAL records
            $resultSet = $this->con->query("SELECT id FROM posts");
            // Get total records
            $numRows = $resultSet->num_rows;
            // Get total number of pages
            $this->totalPages = $numRows / $rpp;
            $resultSet = $this->con->query("SELECT * FROM posts LIMIT $start, $rpp");
            return $resultSet;
        }
    }

?>