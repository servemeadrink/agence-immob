<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <?php 
       $annonce = $data['annonce'];
       $agence = $data['agence'];
     ?>
    <title> <?= $annonce['MAN_TITRE'] ?> </title>
    <link rel="stylesheet" type="text/css" href="/agence-immo/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/agence-immo/public/css/rcarousel.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/agence-immo/public/css/styles.css">
    <script type="text/javascript" src="/agence-immo/public/js/bootstrap.min.js"></script>
</head>

<body class="annonce">
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
       
        foreach ($data['photos'] as $photo) {
          $html = '<div id="" class="slide">
                    <div class="r_photo" style="background-image:url(\'photos/'.$photo['PHO_SRC'].'\')">
                  </div>';
            
          $html .='<div class="text">
                    <p>'.$photo['PHO_DESCR'].'</p>
                  </div>
                </div>';
          echo $html;
        }
      ?>
 
         
        </div>
        <a href="#" id="ui-carousel-next"><span></span></a>
        <a href="#" id="ui-carousel-prev"><span></span></a>
        <div id="pages" class="clearfix hidden"></div>
      </div>




<div id="annonce">
      
      <h2><?= $annonce['MAN_TITRE'] ?> <span class="price pull-right"><?= $annonce['MAN_TARIF'] ?> &euro;</span></h2>
      <hr>
      <div class="agency-contacts clearfix">
        <span><i>Réf: <span><?= $annonce['MAN_REF'] ?></span></i>, <?= $annonce['MAN_VEN_LOC']==0?'vente':'location' ?></span>
        <div class="annonce-descr">
          <h5 class="small-title">Description</h5>
          <p><?= $annonce['MAN_DESCR'] ?></p>
        </div>
        <div class="annonce-contact">
          <h5 class="small-title">Contact</h5>
          <p>
            <span class="clearfix"><b>Tel. </b><?= $agence['AGE_TEL'] ?></span>
            <span class="clearfix"><b>Fax. </b><?= $agence['AGE_FAX'] ?></span>
            <span class="clearfix"><b>Mel. </b><?= $agence['AGE_MAIL'] ?></span>
          </p>
        </div>
        <div class="annonce-address">
          <h5 class="small-title">Adresse</h5>
          <p>
            <span class="clearfix"><b><?= $annonce['MAN_REG_LIB'] ?> </b><?= $annonce['MAN_ADR1'] ?></span>
          </p>
        </div>
        <div class="annonce-equipment">
          <h5 class="small-title">Équipements</h5>
          <table class="table stripped">
            <tr><th>Equipement</th><th>Disponibilité</th></tr>
            <tr><td>Gaz</td><td></td></tr>
            <tr><td>Eau</td><td></td></tr>
            <tr><td>Electricité</td><td></td></tr>
            <tr><td>Transports</td><td></td></tr>
            <tr><td>Chauffage</td><td></td></tr>
            <tr><td>Charges</td><td></td></tr>
          </table>
        </div>

      </div>

    </div>
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
            visible: 1,
            step: 1,
            speed: 500,
            auto: {
              enabled: true,
              interval: <?= $carouselSpeed ?>
            },
            width: 440,
            height: 470,
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