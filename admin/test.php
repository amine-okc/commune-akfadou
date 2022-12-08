<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="generator" content="Codeply" />
  <title>Codeply simple HTML/CSS/JS preview</title>
  <base target="_self"> 

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />  
  

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" />

  <style>/* CSS used here will be applied after bootstrap.css */
.ekko-lightbox-nav-overlay a {
    color: goldenrod;
}
.gallery-title {
    text-align: center;
	font-weight: 500;
	border-bottom: 1px dotted orange;
	margin-top: 1em;
}
</style>
</head>
<body >
  <div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Projects</h1>
        <h3 class="gallery-title">Gallery 1</h3>
        <div class="row">
            <a href="https://unsplash.it/1200/768.jpg?image=251" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3">
                <img src="https://unsplash.it/600.jpg?image=251" class="img-fluid card">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=252" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3">
                <img src="https://unsplash.it/600.jpg?image=252" class="img-fluid card">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=253" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3">
                <img src="https://unsplash.it/600.jpg?image=253" class="img-fluid card">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3">
                <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid card">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3">
                <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid card">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="example-gallery" class="col-lg-3 col-md-4 col-6 my-3">
                <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid card">
            </a>
        </div>
    </div>
</div>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>

  <script>
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({alwaysShowClose: true});
});
  </script>
  
</body>
</html>
" class="fill-height grey lighten-1" srcid="IFtAZ3Frr6"></iframe>