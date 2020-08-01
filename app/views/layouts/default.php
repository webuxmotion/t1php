<?php
    $dir    = WWW . '/dist';
    $files = array_diff(scandir($dir, 1), array('..', '.'));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Rubik:wght@300;500&display=swap" rel="stylesheet">

    <?php load($files, 'css')?>
    
    <?=$this->getMeta()?>

  </head>
  <body>

  <?=$this->block('Header')?>

  <?=$content;?>

  <?=$this->block('Footer')?>

  <?php load($files, 'js')?>

  </body>
</html>
