<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Projets à venir - Commune d'Akfadou</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body>

    <?php $IPATH =  "../assets/php/";
    include($IPATH . "navbar.php") ?>

    <?php include("../dbconn.php"); ?>
    <br><br><br>
    <!-- write here -->
		                <center>
                    <div class="card mb-4 pagetitle shadow p-3 bg-white rounded">
                        <h1 class="page-title">Projets à venir</h1>
                    </div>
                </center>
    <div class="album py-5">
        <div class="container">
            <div class="row">
                <?php
                include("../dbconn.php");
                $sql = "SELECT *, DATE_FORMAT(date, \"%M - %Y\") AS date from `projects`  where stat = 'future' ORDER BY id desc";
                $result = mysqli_query($connection, $sql);
                $dir = "../assets/projects";
                if (mysqli_num_rows($result) == 0) { ?>
                    <br><br><br><br>
                    <hr>
                    <center>
                        <?php echo "<br/><br/>" ?><h1 class="empty-title" style="font-size: 60pt;"><b>Aucun Projet<?php echo "<br/><br/>" ?></b></h1>
                    </center>
                    <hr><br><br>
                    <?php } else {
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="col-md-4">
                        <div class="card mb-4 box-shadow shadow p-3 bg-white rounded" style="padding : 0!important; border-radius : 20px!important;">
                                <?php if ($row['img'] != "") { ?>
                                    <img class="card-img-top" src="../assets/projects/<?php echo $row['img'] ?>" alt="<?php echo $row['title'] ?>" style="border-top-right-radius : 20px!important;border-top-left-radius : 20px!important;"> <?php }?>
                                                       
                            <div class="card-body">
                                <p class="card-text"><?php echo $row['content'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                </div>
                                <div class="small text-muted float-right"><?php echo $row['date'] ?></div>
                            </div>
                            </div>
                        </div>
                    <?php }} ?>
            </div>
        </div>
    </div>

    <!-- end -->


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <?php include($IPATH . "footer.php") ?>
</body>

</html>