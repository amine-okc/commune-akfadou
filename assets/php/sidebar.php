<style>
  .list-group-item:hover .titre {
    color: #125e3a !important;
    font-weight: bolder;
  }

  .list-group-item:hover .date {
    color: black;
  }
</style>


<?php 


$query = "SELECT *  FROM `news` ORDER BY id DESC LIMIT 5"; 
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) != 0){

?>

<div class="col-md-4">
  <br>
  <div class="card md-4 shadow p-3" data-aos="fade-left" data-aos-duration="2500">
    <h5 class="card-header">Dernières Actualités</h5>
    <div class="card-body ">
      <div class="list-group">
        <?php
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        
        
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <a class="list-group-item list-group-item-action flex-column align-items-start" href="/news/details.php?pid=<?php echo htmlentities($row['id']) ?>" style="padding : 20px 20px;">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="titre mb-1"><?php echo htmlentities($row['title']); ?></h6>
              <small class="date"><?php echo strftime('%d %h %Y', strtotime($row['date'])) ?></small>
            </div>
          </a>
        <?php } ?>
      </div>
    </div>
  </div><br><br>
        <?php } ?>
  <div class="card md-4 shadow p-3" data-aos="fade-left" data-aos-duration="2500">
    <div class="card-body ">
    <a class="weatherwidget-io" href="https://forecast7.com/fr/36d634d62/akfadou/" data-label_1="AKFADOU" data-label_2="Météo" data-font="Noto Sans" data-icons="Climacons Animated" data-days="5" data-theme="pure" >AKFADOU Météo</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
    </div>
  </div><br><br>

</div>
