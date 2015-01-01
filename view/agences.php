<!DOCTYPE html>
<html lang="fr">
<head>
   	<meta charset="utf-8">
   	<title> Bienvenue </title>
    <link rel="stylesheet" type="text/css" href="/agence-immo/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/agence-immo/public/css/rcarousel.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/agence-immo/public/css/styles.css">
    <script type="text/javascript" src="/agence-immo/public/js/bootstrap.min.js"></script>
</head>

<body>
      <?php 
      $carouselSpeed = 700;
      if(isset($_GET['speed']) && !empty($_GET['speed']))
        $carouselSpeed = intval($_GET['speed']);
    ?>

  <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
      <div class="navbar-header">

        <a href="index.php?speed=<?= $carouselSpeed?>" class="navbar-brand">Immo</a>
      </div>
    </div>
  </header>

<div id="">
  <div id="content2">
    <div id="carousel">
      <?php
        $model = new Model();
        foreach ($data['annonces'] as $annonce) {
          $html = '<div id="" class="slide">
                  <a href="index.php?speed='.$carouselSpeed.'&page=annonce&man_id='.$annonce['MAN_ID'].'">
                    <div class="r_photo" style="background-image:url(\'photos/'.$model->getImmoMandatImg($annonce['MAN_ID']).'\')">
                  </div>';
            
          $html .='<div class="text">
                    <h1>'.substr($annonce['MAN_TITRE'], 0, 20).'...</h1>
                    <p>'.substr($annonce['MAN_DESCR'], 0, 80).'...</p>
                    <span class="location">'.$annonce['MAN_REG_LIB'].'</span>
                    <span class="price">'.$annonce['MAN_TARIF'].' &euro;</span>
                  </div></a>
                </div>';
          echo $html;
        }
      ?>
 
         
        </div>
        <a href="#" id="ui-carousel-next"><span></span></a>
        <a href="#" id="ui-carousel-prev"><span></span></a>
        <div id="pages" class="clearfix hidden"></div>
      </div>

  </div>
      <div id="agences">
      <h2>Filtrer par agence</h2>
      <hr/>
      <?php
        foreach ($data['agences'] as $agence) {
          $html = "<div class='media'>";
          $html .= "<a class='pull-left' href='index.php?speed=".$carouselSpeed."&page=agence&id=".$agence['AGE_ID']."'>
                    <img class='media-object' src='./img/".$agence['AGE_PHOTO']."' style='width: 96px; height: 96px;'>
                  </a>";
          $html .="<div class='media-body'>
                    <h4 class='media-heading'>".$agence['AGE_NOM']."</h4>
                    <span class='address'>".$agence['AGE_RUE'].", ".$agence['AGE_VILLE']." ".$agence['AGE_CP']."</span>
                    ".$agence['AGE_DESCR']."
                  </div>";

          $html .="<a class='agence-details btn btn-primary btn-small' href='index.php?speed=".$carouselSpeed."&page=agence&id=".$agence['AGE_ID']."'>détails de l'agence</a></div>";
          echo $html;
                    
        }
      ?>
    
    </div>

 <script type="text/javascript" src="/agence-immo/public/js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="/agence-immo/public/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="/agence-immo/public/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/agence-immo/public/js/jquery.ui.rcarousel.js"></script>
    <script type="text/javascript">
      jQuery(function($) {

        function generatePages() {
          var _total, i, _link;
          
          _total = $( "#carousel" ).rcarousel( "getTotalPages" );
          
          for ( i = 0; i < _total; i++ ) {
            _link = $( "<a href='#'></a>" );
            
            $(_link)
              .bind("click", {page: i},
                function( event ) {
                  $( "#carousel" ).rcarousel( "goToPage", event.data.page );
                  event.preventDefault();
                }
              )
              .addClass( "bullet off" )
              .appendTo( "#pages" );
          }
          
          // mark first page as active
          $( "a:eq(0)", "#pages" )
            .removeClass( "off" )
            .addClass( "on" );

        }

        function pageLoaded( event, data ) {
          $( "a.on", "#pages" )
            .removeClass( "on" );

          $( "a", "#pages" )
            .eq( data.page )
            .addClass( "on" );
        }
        
        $("#carousel").rcarousel(
          {
            visible: 3,
            step: 1,
            speed: 500,
            auto: {
              enabled: true,
              interval: <?= $carouselSpeed ?>
            },
            width: 328,
            height: 120,
            start: generatePages,
            pageLoaded: pageLoaded
          }
        );
        
        $( "#ui-carousel-next" )
          .add( "#ui-carousel-prev" )
          .add( ".bullet" )
          .hover(
            function() {
              $( this ).css( "opacity", 0.7 );
            },
            function() {
              $( this ).css( "opacity", 1.0 );
            }
          );
      });
      
    </script>
</body>
</html>