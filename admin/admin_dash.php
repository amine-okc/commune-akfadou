<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
  header("location: index.php");
}
if (isset($_POST['logout'])) {
  session_destroy();
  header("location: index.php");
}
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
?>

<?php


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Compte Administrateur - <?php echo $_SESSION['AdminLoginId'] ?></title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a27d6ed1ca.js" crossorigin="anonymous"></script>
  <link href="../assets/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="icon" href="../assets/img/favicon.png">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400&display=swap" rel="stylesheet">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


  <script>
    $(document).ready(function() {
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if (activeTab) {
        $('#myTab2 a[href="' + activeTab + '"]').tab('show');
      }
    });
  </script>

</head>
<style>
  body {
    font-family: 'Nunito Sans', sans-serif;
  }

  *:focus {
    outline: none;
  }

  .accordion,
  #btn1,
  #btn2 {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
  }

  .accordion {
    width: 80%;
  }



  .accordion.active,
  .accordion:hover {
    background-color: #ccc;
    border-bottom-left-radius: 2px;
  }

  .accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
  }

  .accordion.active:after {
    content: "\2212";
  }

  .panel {
    padding: 0 18px;
    background-color: white;
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.2s ease-out;
    width: 80%;

  }

  .accordion.active+#btn1+#btn2+.panel {
    border: #eee solid 1px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top: none;
  }

  #btn1 #deletebtn {
    text-decoration: none;
    color: rgb(250, 74, 55);
  }

  #btn2 #replybtn {
    text-decoration: none;
    color: rgb(55, 139, 250);
  }

  #deletebtn:hover,
  #replybtn:hover {
    text-decoration: underline;
  }

  @media only screen and (max-width: 600px) {

    .panel {
      width: 120%;
    }

  }

  [data-toggle="collapse"]:after {
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    content: "\f054";
    transform: rotate(90deg);
    transition: all linear 0.25s;
    float: right;
  }

  [data-toggle="collapse"].collapsed:after {
    transform: rotate(0deg);
  }

  .col-sm-6 {
    border-radius: 20px !important;
  }
</style>

<body>
  <?php
  include("../dbconn.php");
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM `admins` where id = '$id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_array($result);
  $ProfileImg = '../assets/admins/' . $row['img'];
  $user = $row['username'];
  $func = $row['function'];
  if ($ProfileImg == "../assets/admins/")
    $ProfileImg = '../assets/admins/admin-pic.svg';
  ?>

  <nav class="navbar navbar-expand navbar-light fixed-top" style="background-color: #FFFFFF;">
    <a class="navbar-brand mx-auto" href="#"></a>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
          <?php echo $user . " | " . $func ?>&nbsp;&nbsp;&nbsp;<img style="width : 3rem; height : 3rem; border-radius : 50%; border : grey 1px solid;" src="<?php echo $ProfileImg ?>"> <b class="caret"></b>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="/index.php"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Page d'acceuil</a>
          <a class="dropdown-item" onclick="changeTab()" href="#settings"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;Paramètres</a>
          <div class="dropdown-divider"></div>
          <form class="form-inline my-2 my-lg-0" method="POST">
            <button class="btn btn-outline-danger my-2 my-sm-0" name="logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Déconnexion</button>
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <script>
    function changeTab() {
      setting = document.getElementById("setting-tab");
      setting.setAttribute("aria-selected", "true");
      x = document.getElementById("Delete-tab");
      x.setAttribute("aria-selected", "false");
      x = document.getElementById("add-tab");
      x.setAttribute("aria-selected", "false");
      x = document.getElementById("messages-tab");
      x.setAttribute("aria-selected", "false");
      setting.classList.add("active")
      x = document.getElementById("Delete-tab");
      x.classList.remove("active");
      x = document.getElementById("add-tab");
      x.classList.remove("active");
      x = document.getElementById("messages-tab");
      x.classList.remove("active");

      setting = document.getElementById("settings");
      setting.classList.add("show")
      x = document.getElementById("Delete");
      x.classList.remove("show");
      x = document.getElementById("add");
      x.classList.remove("show");
      x = document.getElementById("messages");
      x.classList.remove("show");
      setting.classList.add("active")
      x = document.getElementById("Delete");
      x.classList.remove("active");
      x = document.getElementById("add");
      x.classList.remove("active");
      x = document.getElementById("messages");
      x.classList.remove("active");
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');

    body {
      font-family: 'Nunito Sans', sans-serif;
      background-color: #f4f4f4;
      background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M9 0h2v20H9V0zm25.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm-20 20l1.732 1-10 17.32-1.732-1 10-17.32zM58.16 4.134l1 1.732-17.32 10-1-1.732 17.32-10zm-40 40l1 1.732-17.32 10-1-1.732 17.32-10zM80 9v2H60V9h20zM20 69v2H0v-2h20zm79.32-55l-1 1.732-17.32-10L82 4l17.32 10zm-80 80l-1 1.732-17.32-10L2 84l17.32 10zm96.546-75.84l-1.732 1-10-17.32 1.732-1 10 17.32zm-100 100l-1.732 1-10-17.32 1.732-1 10 17.32zM38.16 24.134l1 1.732-17.32 10-1-1.732 17.32-10zM60 29v2H40v-2h20zm19.32 5l-1 1.732-17.32-10L62 24l17.32 10zm16.546 4.16l-1.732 1-10-17.32 1.732-1 10 17.32zM111 40h-2V20h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zM40 49v2H20v-2h20zm19.32 5l-1 1.732-17.32-10L42 44l17.32 10zm16.546 4.16l-1.732 1-10-17.32 1.732-1 10 17.32zM91 60h-2V40h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm24.026 3.294l1 1.732-17.32 10-1-1.732 17.32-10zM39.32 74l-1 1.732-17.32-10L22 64l17.32 10zm16.546 4.16l-1.732 1-10-17.32 1.732-1 10 17.32zM71 80h-2V60h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm24.026 3.294l1 1.732-17.32 10-1-1.732 17.32-10zM120 89v2h-20v-2h20zm-84.134 9.16l-1.732 1-10-17.32 1.732-1 10 17.32zM51 100h-2V80h2v20zm3.134.84l1.732 1-10 17.32-1.732-1 10-17.32zm24.026 3.294l1 1.732-17.32 10-1-1.732 17.32-10zM100 109v2H80v-2h20zm19.32 5l-1 1.732-17.32-10 1-1.732 17.32 10zM31 120h-2v-20h2v20z' fill='%2380b49b' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");

    }
  </style>

  <style>
    .dropdown-item {
      padding: 10px 10px;
      margin: 0 auto;
    }

    .dropdown-item a {
      text-align: center !important;
    }

    .dropdown-menu .btn {
      margin: 0 auto
    }
  </style>



  <br><br><br>
  <div class="container py-5">

    <div class="p-5 bg-white rounded shadow mb-5" style="border-radius : 20px!important;">
      <!-- Lined tabs-->
      <ul id="myTab2" role="tablist" class="nav nav-tabs nav-pills with-arrow lined flex-column flex-sm-row text-center">

        <li class="nav-item flex-sm-fill">
          <a id="Delete-tab" data-toggle="tab" href="#Delete" role="tab" aria-controls="Delete" aria-selected="true" class="nav-link text-uppercase font-weight-bold rounded-0 active"><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;&nbsp;Supprimer</a>
        </li>
        <li class="nav-item flex-sm-fill">
          <a id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ajouter</a>
        </li>
        <li class="nav-item flex-sm-fill">
          <a id="elu-tab" data-toggle="tab" href="#elu" role="tab" aria-controls="elu" aria-selected="false" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0"><i class="fas fa-user-tie"></i>&nbsp;&nbsp;&nbsp;&nbsp;élus</a>
        </li>
        <li class="nav-item flex-sm-fill">
          <a id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0"><i class="fas fa-inbox"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a>
        </li>
        <li class="nav-item flex-sm-fill">
          <a id="setting-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;&nbsp;&nbsp;Paramètres</a>
        </li>

      </ul>





      <div id="myTab2Content" class="tab-content">

        <div id="Delete" role="tabpanel" aria-labelledby="Delete-tab" class="tab-pane fade px-4 py-5 show active row justify-content-center">

          <form class="col-sm-6" method="GET" onsubmit="return submitDelete()" action="result.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;">

            <!--  Choisir la rubrique  -->

            <div class="form-floating mb-4">
              <select name="selectedDelete" class="form-select" id="floatingSelectDelete" aria-label="Floating label select" onchange="selectForDelete()">
                <option selected value="" disabled>Sélectionner..</option>
                <option value="news">Actualités</option>
                <option value="projects">Projets</option>
                <option value="scroll">Infos défilées</option>
                <option value="gallery">Gallerie</option>
                <option value="com">Communiqués</option>
                <option value="appels">Appels d'offre</option>
              </select>
              <label for="floatingSelect">Rubrique</label>
            </div>

            <div class="form-group mb-4" id="Projectstat" hidden>
              <label class="radio-inline">
                <input type="radio" name="radio" value="achieved" checked> Achevé
              </label> &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
                <input type="radio" value="pending" name="radio"> En cours
              </label> &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
                <input type="radio" value="future" name="radio"> A venir
              </label>
            </div><br><br>
            <div class="form mb-4">
              <button type="submit" class="btn btn-primary">Afficher</button>
            </div>
          </form>


        </div>

        <div id="add" role="tabpanel" aria-labelledby="add-tab" class="tab-pane fade px-4 py-5 show">


          <form class="col-sm-6" method="POST" action="add.php" onsubmit="return verifyAdd()" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;">

            <!--  Choisir la rubrique  -->

            <div class="form-floating mb-4">
              <select name="selected" class="form-select" id="floatingSelect" aria-label="Floating label select example" onchange="select()">
                <option selected value="" disabled>Sélectionner..</option>
                <option value="news">Actualités</option>
                <option value="projects">Projets</option>
                <option value="scroll">Infos défilées</option>
                <option value="gallery">Gallerie</option>
                <option value="com">Communiqués</option>
                <option value="appels">Appels d'offre</option>
              </select>
              <label for="floatingSelect">Rubrique</label>
            </div>

            <div class="form-group mb-4" id="ProjectStat" style="display : none;">
              <label class="radio-inline">
                <input type="radio" name="radio" value="achieved" checked> Achevé
              </label> &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
                <input type="radio" value="pending" name="radio"> En cours
              </label> &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="radio-inline">
                <input type="radio" value="future" name="radio"> A venir
              </label>
            </div>

            <div class="form-floating mb-4 ">
              <input type="text" class="form-control" name="title" id="floatingTitle" placeholder="Titre">
              <label for="floatingTitle">Titre</label>
            </div>

            <div class="form-floating mb-4" hidden>
              <input type="text" class="form-control" name="author" id="floatingAuthor" placeholder="Auteur" value="<?php echo $_SESSION['id'] ?>">
              <label for="floatingAuthor">Auteur</label>
            </div>

            <div class="form mb-4">
              <input type="file" class="form-control" id="floatingBrowse" name="image[]" accept="image/*, .pdf">
            </div>
            <div class="form mb-4" id="date_exp">
              <label>Date d'expiration</label>
              <input placeholder="Select date" type="date" name="date_exp" class="form-control">
            </div>
            <div class="form mb-4" id="date">
              <label>Date</label>
              <input placeholder="Select date" type="date" name="date" class="form-control">
            </div>

        <div class="form-floating mb-4">
          <textarea class="form-control" name="content" placeholder="Article" id="floatingContent" rows="10" style=" height: 15em;"></textarea>
          <label for="floatingContent">Article</label>
          <small class="form-text text-warning" id="errormsg3" style="display: none;"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<small id="nbleft0">256 caractères restants</small><small id="nbleft"></small></small>

        </div>

        <div class="form mb-4">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        </form>

        <br><br>
      </div>


      <div id="elu" role="tabpanel" aria-labelledby="elu-tab" class="tab-pane fade px-4 py-5 row justify-content-center">

        <form class="col-sm-6" method="POST" action="elu.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;">
          <div class="form mb-4">
            <input type="file" class="form-control" id="floatingBrowse3" name="file" accept="image/*, .pdf">
          </div>
          <br><br>
          <div class="form mb-4">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
          </div>
        </form>
      </div>



      <div id="messages" role="tabpanel" aria-labelledby="messages-tab" class="tab-pane fade px-4 py-5">
        <?php
        include("../dbconn.php");
        if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
        } else {
          $pageno = 1;
        } ?>
        <?php
        $no_of_records_per_page = 10;
        $offset = ($pageno - 1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM contact where admin = '{$_SESSION['id']}'";
        $result = mysqli_query($connection, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $query = "SELECT *  FROM `contact` where admin = '{$_SESSION['id']}'  ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 0) {
          echo "<center><H3 style=\"font-family: 'Rubik', sans-serif; \">Messagerie vide</H5></center>";
        } else {
        ?> <div class="float-right"><a onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les messages ?')" href="deleteAllMsgs.php?user=<?php echo $id ?>" style="color : red; text-decoration : none;"><i class="fas fa-trash-alt"></i>&nbsp;Supprimer tout</a></div><br>
          <hr><br>
          <?php while ($row = mysqli_fetch_array($result)) { ?>
            <button class="accordion" onclick="audio.play()" style="border-radius: 10px; "><?php echo $row['nom'] ?> &nbsp;
              <?php echo $row['prenom'] ?>&nbsp;</button>
            <a id="btn1" onclick="audio.play(); return confirm('Êtes-vous sûr de vouloir supprimer le message ?')" style="border-radius: 10px;" title="Supprimer" href="deleteMsg.php?id=<?php echo $row['id']; ?>"><small><label id="deletebtn"><i class="fas fa-trash-alt"></i>&nbsp;</label></small></a>
            <a id="btn2" onclick="audio.play()" style="border-radius: 10px;" title="Répondre" href="replyMsg.php?email=<?php echo $row['email']; ?>"><small><label id="replybtn"><i class="fas fa-reply"></i>&nbsp;</label></small></a>

            <div class="panel" style="padding : 10px;">
              <br>
              <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp; <?php echo $row['email'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp; <?php echo strftime('%d %h %Y', strtotime($row['date'])) ?><br>
              <hr>
              <p><?php echo ($row['message']) ?></p>
              <hr>
            </div>
            <br>
        <?php
          }
        }
        include("../assets/php/pagination.php");
        ?>

      </div>




      <div id="settings" role="tabpanel" aria-labelledby="settings-tab" class="tab-pane fade px-4 py-5">

        <style>
          .coll a {
            text-decoration: none;
          }

          .card {
            border-radius: 20px !important;
          }

          .card.acc .card-header {
            padding: 10px 10px;
            margin: 2rem;
            background-color: transparent;
            border-bottom: transparent;
          }
        </style>


        <div id="accordion" role="tablist">
          <div class="card acc">
            <div class="card-header" role="tab" id="headingOne">
              <h5 class="mb-0 coll">
                <a class="collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  <i class="fas fa-user-edit"></i>&nbsp;&nbsp;&nbsp;&nbsp;Modifier le profil
                </a>
              </h5>
            </div>
            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <?php $id = $_SESSION['id']; ?>
                <form class="col-sm-6" method="POST" action="editProfile.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;">
                  <div class="form-floating mb-4 ">
                    <input type="text" class="form-control" name="id" id="floatingID" placeholder="Numéro ID" value="<?php echo $id ?>" disabled>
                    <label for="floatingID">Numéro ID</label>
                  </div>
                  <div class="form-floating mb-4 ">
                    <input type="text" class="form-control" name="name" id="floatingName" placeholder="Nom Complet" value="<?php echo $user ?>">
                    <label for="floatingName">Nom Complet <i style="color : red">*</i></label>
                  </div>

                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="function" id="floatingFunction" placeholder="Fonction" value="<?php echo $func ?>">
                    <label for="floatingFunction">Fonction <i style="color : red">*</i></label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="deleteImage" type="checkbox" value="1" id="deleteImage" onchange="checkBox()">
                    <label class="form-check-label" for="deleteImage">
                      Supprimer la photo de profil
                    </label>
                  </div><br>
                  <div class="form mb-4">
                    <input type="file" class="form-control" id="floatingBrowse2" name="image[]" accept="image/*">
                  </div>
                  <div class="form-floating mb-4" style="display : none;">
                    <input type="text" name="id" placeholder="Fonction" value="<?php echo $id ?>">
                  </div>

                  <div class="form mb-4">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
                  <div class="form mb-4" style="color: red">
                    <small>(<i>*</i> ) : Champ obligatoire</small>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <hr>
          <div class="card acc">
            <div class="card-header" role="tab" id="headingTwo">
              <h5 class="mb-0 coll">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <i class="fas fa-user-lock"></i>&nbsp;&nbsp;&nbsp;&nbsp;Changer le mot de passe
                </a>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
              <?php $id = $_SESSION['id']; ?>
              <form class="col-sm-6" method="POST" action="resetPassword.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;" onsubmit="">

                <div class="form-floating mb-4 ">
                  <input type="password" class="form-control" name="oldPass" id="oldPass" placeholder="Ancien mot de passe">
                  <label for="oldPass">Ancien mot de passe <i style="color : red">*</i></label>
                </div>

                <div class="form-floating mb-4">
                  <input type="password" class="form-control" name="newPass" id="newPass" placeholder="Nouveau mot de passe">
                  <label for="newPass">Nouveau mot de passe <i style="color : red">*</i></label>
                </div>
                <div class="form-floating mb-4">
                  <input type="password" class="form-control" name="newPassConf" id="newPassConf" placeholder="Confirmation du nouveau mot de passe" oninput="verifyPass('newPass', 'newPassConf', 'errormsg', 'successmsg')">
                  <label for="password">Confirmation du mot de passe <i style="color : red">*</i></label>
                  <small class="form-text text-danger" id="errormsg" style="display: none;"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Les deux mots de passe ne correspondent pas.</small>
                  <small class="form-text text-success" id="successmsg" style="display: none;"><i class="fas fa-check"></i>&nbsp;&nbsp;Vous avez bien saisi le mot de passe !</small>
                </div>
                <div class="form-floating mb-4" style="display : none;">
                  <input type="text" name="id" placeholder="Fonction" value="<?php echo $id ?>">
                </div>

                <div class="form mb-4">
                  <button type="submit" class="btn btn-primary">Confirmer</button>
                </div>
                <div class="form mb-4" style="color: red">
                  <small>(<i>*</i> ) : Champ obligatoire</small>
                </div>
              </form><br>


            </div>
          </div>

          <?php include("../dbconn.php");
          $query = "SELECT su FROM `admins` where id = '{$_SESSION['id']}'";
          $result = mysqli_query($connection, $query);
          while ($row = mysqli_fetch_array($result))
            $val = $row['su'];
          if ($val >= 1) {
          ?>
            <hr>
            <div class="card acc">
              <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0 coll">
                  <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;Créer un nouvel utilisateur
                  </a>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  <form class="col-sm-6" method="POST" action="createAdmin.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;" onsubmit="return addUser()">

                    <!--  Choisir la rubrique  -->

                    <div class="form-floating mb-4">
                      <div class="form-floating mb-4 ">
                        <input type="text" class="form-control" name="username" id="floatingUser" placeholder="Nom d'utilisateur">
                        <label for="floatingUser">Nom Complet <i style="color : red">*</i></label>
                      </div>

                      <div class="form-floating mb-4">
                        <input type="text" class="form-control" name="function" id="floatingFunc" placeholder="Fonction">
                        <label for="floatingFunc">Fonction <i style="color : red">*</i></label>
                      </div>
                      <div class="form-floating mb-4">
                        <input type="password" class="form-control" name="password" id="floatingPass" placeholder="Mot de passe">
                        <label for="floatingPass">Mot de passe <i style="color : red">*</i></label>
                      </div>
                      <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="floatingPassConf" placeholder="Confirmation mot de passe" oninput="verifyPass('floatingPass', 'floatingPassConf', 'errormsg1', 'successmsg1')">
                        <label for="floatingPassConf">Confirmation mot de passe <i style="color : red">*</i></label>
                        <small class="form-text text-danger" id="errormsg1" style="display: none;"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Les deux mots de passe ne correspondent pas.</small>
                        <small class="form-text text-success" id="successmsg1" style="display: none;"><i class="fas fa-check"></i>&nbsp;&nbsp;Vous avez bien saisi le mot de passe !</small>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" name="superUser" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Super Administrateur
                        </label>
                      </div><br>

                      <div class="form mb-4">
                        <input type="file" class="form-control" id="floatingImageBrowse" name="image[]" accept="image/*">
                        <style>
                          #floatingImageBrowse::-webkit-file-upload-button {
                            visibility: hidden;
                          }

                          #floatingImageBrowse::before {
                            content: 'Choisir une photo de profil';
                            display: inline-block;
                            background: linear-gradient(top, #f9f9f9, #e3e3e3);
                            border: none;
                            padding: 5px 8px;
                            outline: none;
                            white-space: nowrap;
                            cursor: pointer;
                            text-shadow: 1px 1px #fff;
                            font-size: 10pt;
                          }
                        </style>
                      </div>

                      <div class="form mb-4">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                      </div>
                      <div class="form mb-4" style="color: red">
                        <small>(<i>*</i> ) : Champ obligatoire</small>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <hr>
            <div class="card acc">
              <div class="card-header" role="tab" id="headingFour">
                <h5 class="mb-0 coll">
                  <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <i class="fas fa-user-minus"></i>&nbsp;&nbsp;&nbsp;&nbsp;Supprimer un utilisateur
                  </a>
                </h5>
              </div>
              <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                  <form class="col-sm-6" method="GET" action="deleteUser.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;">


                    <div class="form-floating mb-4">
                      <select class="form-select" id="floatingSelectDelete2" aria-label="Floating label select" data-live-search="true" onchange="selectForDelete()" name="user">
                        <option selected disabled>Sélectionner..</option>
                        <?php include("../dbconn.php");
                        $sql = "SELECT id, username, function, su from `admins`";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                          if ($row['su'] < 1 || $row['id'] == $_SESSION['id']) { ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['function'] . " - " . $row['username'];
                                                                      if ($row['id'] == $_SESSION['id']) echo " (Vous)" ?></option>
                        <?php }
                        } ?>

                      </select>
                      <label for="floatingSelectDelete2">Utilisateur</label>
                    </div>
                    <br><br>
                    <div class="form mb-4">
                      <button type="submit" class="btn btn-primary">Supprimer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <hr>
            <div class="card acc">
              <div class="card-header" role="tab" id="headingFive">
                <h5 class="mb-0 coll">
                  <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <i class="fas fa-user-shield"></i>&nbsp;&nbsp;&nbsp;&nbsp;Droits utilisateur
                  </a>
                </h5>
              </div>

              <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
                <div class="card-body">
                  <form class="col-sm-6" method="POST" action="userRight.php" enctype="multipart/form-data" style="margin : 0 auto; padding : 20px 20px; border : solid 1px rgb(227, 227, 227); border-radius : 5px;">


                    <div class="form-floating mb-4">
                      <select class="form-select" id="UserSelect" aria-label="Floating label select" data-live-search="true" name="userSU">
                        <option selected disabled>Sélectionner..</option>
                        <?php include("../dbconn.php");
                        $sql = "SELECT id, username, function from `admins`";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                          if ($row['id'] != $_SESSION['id']) { ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['function'] . " - " . $row['username'] ?></option>
                        <?php }
                        } ?>

                      </select>
                      <label for="UserSelect">Utilisateur</label>
                    </div>
                    <div class="form-group mb-4" id="UserSU">
                      <label class="radio-inline">
                        <input type="radio" name="superUserChange" value="0" checked> Administrateur
                      </label> &nbsp;&nbsp;&nbsp;&nbsp;
                      <label class="radio-inline">
                        <input type="radio" value="1" name="superUserChange"> Super Administrateur
                      </label> &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <br><br>
                    <div class="form mb-4">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir changer les droits utilisateurs ?');">Appliquer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <hr>
            <div class="card acc">
              <div class="card-header" role="tab" id="headingSix">
                <h5 class="mb-0 coll">
                  <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;Afficher tous les utilisateurs
                  </a>
                </h5>
              </div>
              <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion">
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">ID</th>
                        <th scope="col">Nom Complet</th>
                        <th scope="col">Fonction</th>
                        <th scope="col">Droits</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include("../dbconn.php");
                      $sql = "SELECT * from admins ORDER BY su DESC";
                      $result = mysqli_query($connection, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                      ?>
                        <tr>
                          <td class="align-middle"><img src="../assets/admins/<?php if ($row['img'] == '') echo "admin-pic.svg";
                                                                            else echo $row['img'];  ?>" style="border-radius : 50%; width : 50px; height : 50px; margin-right : 10px;"></td>
                          <th scope="row" class="align-middle"><?php echo $row['id'] ?></th>
                          <td class="align-middle"><?php echo $row['username'];
                                                    if ($row['id'] == $_SESSION['id']) echo " (Vous)"; ?></td>
                          <td class="align-middle"><?php echo $row['function'] ?></td>
                          <td class="align-middle"><?php $su = $row['su'];
                                                    if ($su == "0") echo "Administrateur";
                                                    if ($su == "1") echo "Super Administrateur"; ?></td>
                        </tr><?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>




    <!-- write here -->


    <script>
      var audio = new Audio("../assets/sound/click.mp3");
      audio.loop = false;
    </script>
    <script>
      AOS.init();
    </script>

    <script>
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var panel = this.nextElementSibling.nextElementSibling.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
          }
        });
      }
    </script>


    <script>
      document.getElementById("date_exp").hidden = true;
      document.getElementById("date").hidden = true;
      function select() {
        document.getElementById("date").hidden = true;
        document.getElementById("floatingAuthor").readOnly = false;
        document.getElementById("floatingContent").readOnly = false;
        selected = document.getElementById("floatingSelect").value;
        document.getElementById("nbleft0").hidden = true;
        document.getElementById("nbleft").hidden = true;
        document.getElementById("date_exp").hidden = true;
        document.getElementById("errormsg3").style.display = "none";
        document.getElementById("floatingBrowse").removeAttribute("multiple");
        if (selected != "projects")
          document.getElementById("ProjectStat").style.display = "none";

        if (selected == "projects") {
          document.getElementById("date").hidden = false;
          document.getElementById("ProjectStat").style.display = "inline";
          document.getElementById("floatingAuthor").readOnly = true;

        } else if (selected == "scroll") {
          document.getElementById("errormsg3").style.display = "inline";
          document.getElementById("nbleft0").hidden = false;
          $('#floatingContent').keyup(countdown);
          $('#floatingContent').keydown(countdown);
          document.getElementById("floatingAuthor").readOnly = true;
          document.getElementById("floatingContent").setAttribute("maxlength", "256");
          document.getElementById("errormsg3").style.display = "inline";
        } else if (selected == "gallery") {
          document.getElementById("floatingAuthor").readOnly = true;
          document.getElementById("floatingContent").readOnly = true;
          $('#floatingBrowse').attr('multiple', '');

        } else if (selected == "com") {
          document.getElementById("floatingAuthor").readOnly = true;

        } else if (selected == "appels") {
          document.getElementById("floatingAuthor").readOnly = true;
          document.getElementById("date_exp").hidden = false;
        }
      }

      function submitDelete() {
        x = document.getElementById("floatingSelectDelete").value;
        if (x == "") {
          alert("Veuillez choisir la rubrique.");
          return false;
        } else
          return true;
      }
    </script>

    <script>
      function selectForDelete() {
        x = document.getElementById("floatingSelectDelete").value;
        if (x == "projects")
          document.getElementById("Projectstat").hidden = false;
        else
          document.getElementById("Projectstat").hidden = true;

      }

      function verifyPass(id1, id2, id3, id4) {
        if (document.getElementById(id1).value.localeCompare(document.getElementById(id2).value) == 0) {
          document.getElementById(id3).style.display = "none";
          document.getElementById(id4).style.display = "inline";
          return true;
        } else {
          document.getElementById(id3).style.display = "inline";
          document.getElementById(id4).style.display = "none";
          return false;
        }
      }

      function addUser() {
        username = document.getElementById("floatingUser").value;
        func = document.getElementById("floatingFunc").value;
        pass = document.getElementById("floatingPass").value;
        passconf = document.getElementById("floatingPassConf").value;
        if (username != "" && func != "" && pass != "" && passconf != "" && (verifyPass("floatingPass", "floatingPassConf", "errormsg1", "successmsg1")))
          return true;
        else {
          alert("Veuillez remplir les champs obligatoires");
          return false;
        }
      }

      function checkBox() {
        checked = false;
        if (document.querySelector('#deleteImage:checked')) {
          checked = true;
        }
        if (checked == true)
          document.getElementById("floatingBrowse2").style.display = "none";
        else
          document.getElementById("floatingBrowse2").style.display = "inline";

      }
      max = 256;

      function countdown() {
        document.getElementById("nbleft0").hidden = true;
        document.getElementById("nbleft").hidden = false;
        len = document.getElementById("floatingContent").value.length;
        var cs = [max - $(this).val().length] + " caractères restants";
        $('#nbleft').text(cs);
      }

      function verifyAdd() {
        title = document.getElementById("floatingTitle").value;
        select = document.getElementById("floatingSelect").value;
        if (title == '') {
          alert("Veuillez remplir les champs obligatoires.");
          return false;
        }
        if (select == ""){
          alert("Veuillez choisir une rubrique.");
          return false;
        }
        return true;
      }
    </script>



    <script src="../assets/bootstrap-5.0.0-beta3-dist/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

</body>

</html>