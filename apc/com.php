<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Communiqués - Commune d'Akfadou</title>
    <link rel="stylesheet" href="../assets/css/modern-business.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://kit.fontawesome.com/a27d6ed1ca.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../assets/img/favicon.png">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');

    .row.offers {
        font-family: 'Questrial', sans-serif;
    }

    .card-title {
        font-family: 'Merriweather Sans', sans-serif;
    }

    .card-text {
        font-family: 'Lora', serif;
    }
</style>

<body>
    <?php
    $IPATH =  "../assets/php/";
    include($IPATH . "navbar.php");

    ?>
    <div class="container">

        <div class="row offers" style="margin-top: 4%">
            <?php
            include("../dbconn.php");
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            } ?>
            <div class="col-md-8">
                <?php
                $no_of_records_per_page = 10;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM com";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                ?>
                    <div class="card mb-4 pagetitle p-3 rounded">
                        <h1 class="page-title">&nbsp;&nbsp;&nbsp;&nbsp;Communiqués</h1>
                    </div>
                <?php if ($pageno <= $total_pages) { ?><label class="float-right" style="color : grey">Page <?php echo $pageno ?></label><br><br>
                <?php }


                $sql = "SELECT * , DATE_FORMAT(date, \"%d/%m/%Y - %H:%i\") AS date  FROM `com` ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                $result = mysqli_query($connection, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>

                    <!-- Featured blog post-->
                    <div class="card mb-4 shadow p-3 bg-white rounded " data-aos="fade-up">
                        <div class="card-body">
                            <div class="small text-muted float-right"><?php echo $row['date'] ?></div>
                            <h2 class="card-title"><?php echo $row['title'] ?></h2>
                            <p class="card-text"><?php echo $row['content']; ?></p>
                            <?php if ($row['img'] != '') { ?><a style="text-decoration : none;color : rgb(13,110,253)!important;" href="../assets/com/<?php echo $row['img'] ?>" target="_blank">Détails &nbsp; <i class="fas fa-file-alt"></i></a><?php } ?>
                        </div>
                    </div><br>
                    <!-- Nested row for non-featured blog posts-->

                <?php } ?>
                <?php if ($total_pages > 1) { ?>
                    <style>
                        .pagination .page-link.first {
                            border-top-left-radius: 10px;
                            border-bottom-left-radius: 10px;
                        }

                        .pagination .page-link.last {
                            border-top-right-radius: 10px;
                            border-bottom-right-radius: 10px;
                        }
                    </style>
                    <nav style="position : absolute;margin : 0 auto">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link first" href="?pageno=1" style="<?php if ($pageno == 1) {
                                                                                                            echo " background-color : rgb(13,110,253); color : white";
                                                                                                        }  ?>">1</a></li>
                            <li class="page-item"><a class="page-link" href="#" style="display : <?php if ($pageno <= 2 || $pageno - 1 == 2) echo "none" ?>">...</a></li>
                            <li class="page-item" style="display : <?php if ($pageno <= 2) echo "none" ?>">
                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo "?pageno=" . ($pageno - 1);
                                                            } ?>"><?php echo $pageno - 1 ?></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" style="background-color : rgb(13,110,253); color : white; <?php if ($pageno == 1 || $pageno == $total_pages) echo "display : none" ?>"><?php echo $pageno ?></a>
                            </li>
                            <li class="page-item" style="display : <?php if ($pageno >= $total_pages - 1) echo "none" ?>">
                                <a class="page-link" href="<?php if ($pageno == $total_pages) {
                                                                echo '#';
                                                            } else {
                                                                echo "?pageno=" . ($pageno + 1);
                                                            } ?>"><?php echo $pageno + 1 ?></a>
                            </li>
                            <li class="page-item" style="display : <?php if ($pageno >= $total_pages - 1 || $pageno + 1 == $total_pages - 1) echo "none" ?>">
                                <a class="page-link" href="#"><?php echo "..." ?></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link last" href="?pageno=<?php echo $total_pages; ?>" style="<?php if ($pageno == $total_pages) {
                                                                                                                echo " background-color : rgb(13,110,253); color : white";
                                                                                                            } ?>"><?php echo $total_pages ?></a>
                            </li>
                        </ul>
                    </nav><?php } ?>
            </div>
            <?php include($IPATH . "sidebar.php"); ?>
        </div>
    </div>
    <br><br>
    <hr>
    <?php include($IPATH . "footer.php"); ?>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>

</html>