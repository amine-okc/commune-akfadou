<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Commune d'Akfadou - Site Officiel</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="icon" href="assets/img/favicon.png">

</head>

<body>

    <?php $IPATH = "assets/php/";
    include($IPATH . "navbar.php") ?>
    <br><br><br>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Vollkorn:wght@600&display=swap');



        .card-title {
            font-family: 'Merriweather Sans', sans-serif;
        }

        .card-text {
            font-family: 'Lora', serif;
        }
    </style>




    <div class="container">

        <div class="row index" style="margin-top: 4%">

            <div class="col-md-8">
                <br>
                <?php
                include("dbconn.php");
                $sql = "SELECT * from scroll where img = ''";
                $result = mysqli_query($connection, $sql);
                $string = "";
                while ($row = mysqli_fetch_array($result))
                    $string = $string . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['content'];
                ?>
                <?php if ($string != '') { ?>
                    <div class="alert card mb-5 shadow p-3 mb-5 bg-white rounded" data-aos="fade-down" data-aos-duration="1000" role="alert" style="padding : 0!important;margin : 0 auto!important;border-radius : 20px;border : 0">
                        <marquee class="shadow p-3" style="padding : 1rem;padding-bottom : 0rem!important; background-color : white; color:black!important;border-radius : 20px">
                            <p style="font-size: 15pt"><?php echo $string ?></p>
                        </marquee>
                    </div><br /><?php } ?>
                <div class="card shadow p-3 mb-5 bg-white rounded" style="padding : 0!important;height : 25rem;border : 0" data-aos="fade-up" data-aos-duration="1500">
                    <section id="carousel" style="border-radius : 20px;position : relative;width : 100%;height : 100%">
                        <div class="carousel slide" data-ride="carousel" id="carousel-1" style="position : relative;width : 100%;height : 100%" data-ride="carousel" data-pause="hover">
                            <div class="carousel-inner" role="listbox" style="border-radius : 20px;position : relative;width : 100%;height : 100%">
                                <div class="carousel-item active" style="position : relative;width : 100%;height : 100%">
                                    <div class="jumbotron pulse animated car1 carousel-hero" style="border-radius : 20px; position : relative;width : 100%;height : 100%; background-image : url(assets/img/car1.jpg)">
                                        <b>
                                            <h1 class="hero-title" style="font-size : 20pt;font-family: 'Vollkorn', serif; background-color: rgba(233, 233, 233, 0.94); padding : 2rem; border-radius : 20px;color : rgba(42, 42, 42, 0.96)">République Algérienne Démocratique et Populaire<br>
                                                Wilaya de Béjaïa<br><br>
                                                <div style="font-size : 25pt;font-family: 'Vollkorn', serif;">Commune d'Akfadou</div>
                                            </h1>
                                        </b><br><br><br>
                                    </div>
                                </div>
                                <?php
                                include("dbconn.php");
                                $sql = "SELECT * from scroll where img != ''";
                                $result = mysqli_query($connection, $sql);
                                ?>
                                <?php
                                $i = 2;


                                while ($row = mysqli_fetch_array($result)) {

                                ?>
                                    <div class="carousel-item" style="position : relative;width : 100%;height : 100%">
                                        <div class="jumbotron pulse animated car<?php echo $i ?> carousel-hero" style="background-image:url(assets/scroll/<?php echo $row['img'] ?>);border-radius : 20px;position : relative;width : 100%;height : 100%">
                                            <h1 class="hero-title"><?php echo $row['title'] ?></h1>
                                            <?php if ($row['content'] != '') { ?><p class="hero-subtitle"><?php echo $row['content'] ?></p><?php } ?>
                                        </div>
                                    </div>
                                <?php
                                    $i = $i + 1;
                                }
                                ?>
                            </div>
                            <div>
                                <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                                    <i class="fa fa-chevron-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                                    <i class="fa fa-chevron-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                                <?php
                                include("dbconn.php");
                                $sql = "SELECT * from scroll where img != ''";
                                $result = mysqli_query($connection, $sql);
                                $i = 2;
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <li data-target="#carousel-<?php echo $i - 1 ?>" data-slide-to="<?php echo $i - 1 ?>"></li>
                                <?php $i = $i + 1;
                                } ?>
                            </ol>

                        </div>
                    </section>
                </div>
                <div class="alert card mb-5 p-3 mb-5 bg-white rounded" data-aos="fade-down" data-aos-duration="1000" role="alert" style="padding : 0!important;margin : 0 auto!important;border-radius : 20px;border : 0">

                    <div class="card shadow p-3 bg-white rounded" style="background-image: url(assets/img/gallery.jpg); background-size : cover;width : 100%; height: 560px">
                        <a href="discover/gallery.php">
                            <center>
                                <h1 class="hero-title" style="  margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">GALERIE DE PHOTOS</h1>
                            </center>
                        </a>
                    </div>
                </div><br />

            </div>
            <?php include($IPATH . "sidebar.php"); ?>
            <style>
                .col-md-6 .card.shadow {
                    padding: 0 !important;
                    border: 0 !important;
                    position: relative;
                    width: 100%;
                    height: 100%;

                    background-size: cover;
                    width: 100%;
                    height: 400px;
                    margin-bottom: 2rem;
                }

                .button-flat {
                    margin: 2rem;
                }
            </style>

            <div class="col-md-6">
                <a href="./discover/presentation.php">
                    <div class="card shadow p-3 bg-white rounded" style="background-image: url(assets/img/presentation.jpg);">
                        <center>
                            <h1 class="hero-title" style="  margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">Présentation Générale</h1>
                        </center>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="./discover/history.php">
                    <div class="card shadow p-3 bg-white rounded" style="background-image: url(assets/img/histoire.jpg);">
                        <center>
                            <h1 class="hero-title" style="  margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">Histoire</h1>
                        </center>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="./services/etat-civil.php">
                    <div class="card shadow p-3 bg-white rounded" style="background-image: url(assets/img/etat-civil.jpg);">
                        <center>
                            <h1 class="hero-title" style="  margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">état civil</h1>
                        </center>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="./services/doc-biom.php">
                    <div class="card shadow p-3 bg-white rounded" style="background-image: url(assets/img/biometrie.jpg);">
                        <center>
                            <h1 class="hero-title" style="  margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">Documents biométriques</h1>
                        </center>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <style>
        .shadow {
            vertical-align: middle;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: transform;
            transition-property: transform;
        }

        .shadow:hover,
        .shadow:focus,
        .shadow:active {
            -webkit-transform: scale(1.05);
            transform: scale(1.05);
        }
    </style>


    <?php include($IPATH . "footer.php") ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>


</body>

</html>