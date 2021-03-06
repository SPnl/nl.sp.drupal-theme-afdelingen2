<?php
/**
 *  html.tpl.php - beta 2.1
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="nl"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="nl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="author" content="Socialistische Partij">
  <meta name="google-site-verification" content="_Ci3443QcEuyTVHxUUCR2XKKbYqLsTs09A44ztEJF1M" />
  <meta name="viewport" content="width=device-width">
  <link rel="shortcut icon" href="https://planet.sp.nl/tomaat.ico" type="image/vnd.microsoft.icon" />
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="hidden">
      <?php print t('Skip to main content'); ?></a>
  </div>
  <!-- Site structure container -->
  <div id="container" >
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
  </div>
</body>
</html>
