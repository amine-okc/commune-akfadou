<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Actualités - Commune d'Akfadou</title>
    <link rel="stylesheet" href="../assets/css/modern-business.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://kit.fontawesome.com/a27d6ed1ca.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.min.css">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
</style>

<body>
    <?php
    $IPATH ="../assets/php/";
    include($IPATH . "navbar.php");
    ?>
    <style>
        .readmore:hover{
            display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-transition-duration: 0.1s;
  transition-duration: 0.1s;
        }
        .fa-arrow-right{
            -webkit-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-transition-duration: 0.1s;
  transition-duration: 0.1s;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
        }
        .readmore:hover .fa-arrow-right, .readmore:focus .fa-arrow-right, .readmore:active .fa-arrow-right {
  -webkit-transform: translateX(4px);
  transform: translateX(4px);
}
    </style>

    <div class="container">

        <div class="row news" style="margin-top: 4%">
            <?php
            include("../dbconn.php");
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            } ?>
            <?php
            $no_of_records_per_page = 5;
            $offset = ($pageno - 1) * $no_of_records_per_page;

            $total_pages_sql = "SELECT COUNT(*) FROM news";
            $result = mysqli_query($connection, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            ?>
            <div class="col-md-8">
                    <div class="card mb-4 pagetitle p-3 rounded">
                        <h1 class="page-title">&nbsp;&nbsp;&nbsp;Actualités</h1>
                    </div>
                <?php if ($pageno <= $total_pages) { ?><label class="float-right" style="color : grey">Page <?php echo $pageno ?></label><br><br>

                <?php }
                if ($pageno > $total_pages) { ?>
                    <div class="card mb-4 shadow p-3 bg-white rounded" style="padding : 0!important;">
                        <div class="card-body">
                            <center>
                                <H3 style="font-family: 'Rubik', sans-serif; ">Page non existante</H5>
                            </center>

                        </div>
                    </div><br>
                    <?php } else {

                    $sql = "SELECT * , DATE_FORMAT(date, \"%d/%m/%Y - %H:%i\") AS date  FROM `news` ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                    $result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <!-- Featured blog post-->
                        <div class="card mb-4 shadow p-3 bg-white rounded" style="padding : 0!important;">
                            <?php if ($row['img'] != "") { ?> <a href="details.php?pid=<?php echo htmlentities($row['id']) ?>"><img class="card-img-top" src="../assets/news/<?php echo $row['img'] ?>" alt="<?php echo $row['title'] ?>" title="<?php echo $row['title'] ?>" style="width : 100%; height : 30rem;border-top-left-radius : 20px;border-top-right-radius : 20px;" /></a> <?php } ?>
                            <div class="card-body">
                                <div class="small text-muted float-right"><?php echo $row['date'] ?></div>
                                <h2 class="card-title" style="color :rgb(13,110,253);"><?php echo $row['title'] ?></h2>
                                <p class="card-text"><?php echo mb_strimwidth($row['content'], 0, 300, "..."); ?></p>
                                <a class="btn btn-primary readmore" style="border-radius: 10px;background-color : rgb(13,110,253)!important;" href="details.php?pid=<?php echo htmlentities($row['id']) ?>">Lire l'article&nbsp; <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div><br>
                        <!-- Nested row for non-featured blog posts-->

                <?php }
                } include($IPATH."pagination.php") ?>
                
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