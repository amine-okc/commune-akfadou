

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Galerie - Commune d'Akfadou</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/hover.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>


    <?php $IPATH =  "../assets/php/";
    include($IPATH . "navbar.php") ?>


    <br><br><br>
    <!-- write here -->

    <div class="container">
        <div class="row gallery">
            <div class="col-12">
                <br>
                <?php
                include("../dbconn.php");
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                } ?>
                <?php
                $no_of_records_per_page = 12;
                $offset = ($pageno - 1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM gallery";
                $result = mysqli_query($connection, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                ?>
                <center>
                    <div class="card mb-4 pagetitle shadow p-3 bg-white rounded">
                        <h1 class="page-title">GALERIE</h1>
                    </div>
                </center>
                <?php if ($pageno <= $total_pages) { ?><label class="float-right" style="color : grey">Page <?php echo $pageno ?></label><br><br>
                <?php }
                ?>
                <div class="row">

                    <?php
                    include("../dbconn.php");
                    $delay = 0;
                    $sql = "SELECT * from gallery ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                    $result = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($result) != 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <a href="../assets/gallery/<?php echo $row['img'] ?>" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3 animate__animated animate__backInDown " style="text-decoration : none; color : black;">
                                <img src="../assets/gallery/<?php echo $row['img'] ?>" class="img-fluid card shadow p-3 rounded " style="border-radius : 20px!important; padding : 0!important; margin-bottom : 1rem;">
                                <center><i><label><?php echo $row['title'] ?></label></i></center>
                            </a>
                        <?php $delay = $delay + 1;
                        }
                    } else { ?>
                    <br><br><br><br>
                    <hr>
                    <center>
                        <h1 class="empty-title" style="font-size: 60pt;"><b>Galerie Vide</b></h1>
                    </center>
                    <hr><br><br>
                    <?php } ?>
                </div>
                <?php include("../assets/php/pagination.php") ?>
            </div>
        </div>
    </div>


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>

    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    </script>
    <?php include($IPATH . "footer.php") ?>
</body>

</html>