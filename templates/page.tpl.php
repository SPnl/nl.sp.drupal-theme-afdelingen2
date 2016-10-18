<?php
/**
 *  page.tpl.php
 *  IMPORTANT: SP Super elements (cross-domain navigation, fourth sidebar) variables are added by module 'Afd super items'.
 */
?>
<!-- HEADER-->
 <?php /* print render($page['super_navigatie']); */ ?>
  <div id="header">
  <?php print render($page['header']);
	print render($branding);
	if($page['header_banner']): ?>
	  <div id="banner">
	    <?php print render($page['header_banner']); ?>
	  </div>
	<?php endif; ?>
  </div>
  <!--HAMBURGER-->
  <div id="hamburger">h</div>
  <!--LEFT SIDEBAR-->
  <?php if ($page['sidebar_first']): ?>
  <div id="sidebar-left" class="sidebar">
    <?php print render($page['sidebar_first']); ?>
  </div>
  <?php endif; ?>
  <!--PRIMARY CONTENT-->
  <div id="primary" class="content">
    <div class="seperator"><?php print $afdelingen_seperator;?></div>
    <?php print render($page['help']); ?>

    <?php if (!empty($tabs['#primary']) || !empty($messages)) : ?>
    <div class="interface">
      <?php print render($tabs); ?>
      <?php print $messages; ?>
    </div>
    <?php endif; ?>

    <?php
      $type = theme_get_setting('afdelingen_type');
      if ($type == 'international') {
        $rs_alttext = 'Listen to this article using Readspeaker';
        $countrycode = 'en_uk';
      }
      else {
        $rs_alttext = 'Laat de tekst voorlezen door Readspeaker';
        $countrycode = 'nl_nl';
      }
    ?>
    <?php if ((!empty($variables['node']->type) && in_array($variables['node']->type, array('nieuwsitem','page','standpunt'))) || drupal_is_front_page()) : ?>
      <?php $front = drupal_is_front_page() ? ' rs_frontpage' : ' rs_nofrontpage'; ?>
      <div id="readspeaker_button1" class="rs_skip<?php print $front; ?>">
        <a accesskey="L" href="https://app-eu.readspeaker.com/cgi-bin/rsent?customerid=5359&amp;lang=<?php print $countrycode; ?>&amp;url=<?php global $base_root; print urlencode($base_root . request_uri()); ?>" target="_blank" onclick="readspeaker(this.href+'&amp;selectedhtml='+escape(selectedString), 'rs_1'); return false;">
         <img style="border-style: none;" src="https://planet.sp.nl/listen_<?php print $countrycode; ?>_red.gif" alt="<?php print $rs_alttext; ?>" title="<?php print $rs_alttext; ?>" />
        </a>
      </div>
      <div id='rs_1'></div>
    <?php endif; ?>

    <!-- RSPEAK_START -->

    <?php if (isset($variables['book_top_node']) && isset($variables['node']->book) && $variables['node']->book['nid'] !== $variables['node']->book['bid']) : ?> 
      <h5 class="book-title">
        <a href="/<?php print drupal_get_path_alias('node/' . $variables['book_top_node']->nid); ?>"><?php print $variables['book_top_node']->title; ?></a>
      </h5>
    <?php endif; ?>

    <?php  /* Title */
      print render($title_prefix);
      if ($title) { print '<h2 class="page-title">'.$title.'</h2>'; }
      print render($title_suffix);
    ?>

    <?php print render($page['content']); ?>

    <!-- RSPEAK_STOP -->

    <div id="extra">
    <?php print render($page['extra']); ?>
    </div>


    <?php print $breadcrumb; ?>
  </div>

  <!-- RIGHT SIDEBAR-->
  <?php if ($page['sidebar_second']): ?>
    <div id="sidebar-right" class="sidebar"><?php print render($page['sidebar_second']); ?></div>
  <?php endif; ?>

<!-- CAMPAGNE SIDEBAR-->
<?php /* if (!in_array($type,array('international','rood-jong'))): */ ?>
  <?php /*  print render($page['super_campagnes']); */ ?>
<?php /* endif; */ ?>

<!-- FOOTER -->
<div id="footer">
  <?php print render($page['footer']); ?>
  <?php if ($type !== 'international'): ?>
    <?php print render($page['super_footer']); ?>
  <?php else : ?>
    <?php print render($page['super_footer_international']); ?>
  <?php endif; ?>
</div>
