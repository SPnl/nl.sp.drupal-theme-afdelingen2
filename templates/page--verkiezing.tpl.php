<?php
/**
 *  page--verkiezing.tpl.php
 *  Special page for verkiezingen content type.
 */

  // Get node
  $groepref = $node->field_verk_groep['und'][0]['tid'];
  

  // Custom styling
  $theme_path = drupal_get_path('theme', 'afdelingen');
  drupal_add_css($theme_path . '/css/gr2014.css');
  drupal_add_js($theme_path  . '/js/gr2014.js');

  // Optional tabs
  // Standpunten
  $standpunten = views_get_view('verkiezingsstandpunten');
  $standpunten->init_display();
  $standpunten->pre_execute();
  $standpunten->execute();
  if (!empty($standpunten->result[0]->_field_data)) $standpunt = TRUE;
  // Redenen
  $redenen = views_get_view('verkiezingsredenen');
  $redenen->init_display();
  $redenen->pre_execute();
  $redenen->execute();
  if (!empty($redenen->result[0]->_field_data)) $reden = TRUE;
  // Nieuws
  $nieuws = views_get_view('verkiezingsnieuws');
  $nieuws->init_display();
  $nieuws->pre_execute();
  $nieuws->execute();
  if (!empty($nieuws->result[0]->_field_data)) $nieuws = TRUE;
  // Agenda
  $agenda = views_get_view('verkiezingsagenda');
  $agenda->init_display();
  $agenda->pre_execute();
  $agenda->execute();
  if (!empty($agenda->result[0]->_field_data)) $agendaitem = TRUE;

  // Get link to afdelingen site
  if ($is_front) {
    $linkto = '/nieuws';
  }
  else {
    $linkto = $front_page;
  }
  global $base_url;

?>

<?php print render($tabs); ?>

<!-- HEADER-->
  <div id="header">
    <h1 class="site-name"><a class="name-text" href="<?php print $linkto; ?>" target="_blank"><?php print $site_name; ?></a></a></h1>
    <h2 class="slogan">100% sociaal</h2>
  </div>
  <!--PRIMARY CONTENT-->
  <div id="primary" class="content">
    <?php print render($page['help']); ?>

    <ul class="nav-tabs">
      <li class="active"><a href="#tab-overzicht">Overzicht</a></li>
      <li><a href="#tab-kandidaten">Kandidaten</a></li>
      <?php if ($standpunt) print '<li><a href="#tab-standpunten">Standpunten</a></li>'; ?>
      <?php if ($reden) print '<li><a href="#tab-redenen">Waarom SP?</a></li>'; ?>
      <li><a href="#tab-programma">Programma</a></li>
      <li><a href="#tab-doemee">Doe mee</a></li>
    </ul>

    <?php if (!empty($messages)) : ?>
      <div class="interface">
        <?php print $messages; ?>
      </div>
      <?php endif; ?>
    <div class="content-tabs">
      <!--OVERZICHT-->
      <div id="tab-overzicht" class="content-tab">
        <div id="introductie" class="section">
          <?php print render(field_view_field('node', $node, 'field_intro_verk_algemeen','default')); ?>
        </div>

        <div id="lijsttrekker" class="section">
          <?php if (!empty($node->field_verk_foto_lijsttrekker['und'][0]['uri'])) : ?>
            <div class="kandidaat">
              <div class="profielfoto">
                <?php print render(field_view_field('node', $node, 'field_verk_foto_lijsttrekker','afd_portret')); ?>
              </div>
              <h2 class="naam">Lijsttrekker: <?php print $node->field_verk_naam_lijsttrekker['und'][0]['safe_value']; ?></h2>
              <?php print render(field_view_field('node', $node, 'field_verk_tekst_lijsttrekker', array('label' => 'hidden'))); ?>
            </div>
          <?php else : ?>
            <?php if (empty($node->field_verk_groep)) : ?>
              <?php print views_embed_view('verkiezingskandidaten','lijsttrekker'); ?>
            <?php else: ?>
              <?php print views_embed_view('verkiezingen_onze_mensen','lijsttrekker', $groepref); ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <div id="nieuws" class="section">
          <div id="nieuws-titels">
            <h3>Laatste nieuws</h3>
            <?php if ($nieuws) : ?>
              <?php print views_embed_view('verkiezingsnieuws', 'attachment_1'); ?>
            <?php endif; ?>
          </div>
          <div id="nieuws-berichten">
            <?php if ($nieuws) : ?>
              <?php print views_embed_view('verkiezingsnieuws', 'attachment_2'); ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!--KANDIDATEN-->
      <div id="tab-kandidaten" class="content-tab">
      <?php if (empty($node->field_verk_groep)) : ?>
        <?php print views_embed_view('verkiezingskandidaten','top10'); ?>
        <?php print views_embed_view('verkiezingskandidaten','lijst'); ?>
        <?php print views_embed_view('verkiezingskandidaten','achtergrondinformatie'); ?>
      <?php else: ?>
        <?php print views_embed_view('verkiezingen_onze_mensen','top10', $groepref); ?>
        <?php print views_embed_view('verkiezingen_onze_mensen','lijst', $groepref); ?>
      <?php endif; ?>
      </div>

      <!--STANDPUNTEN-->
      <?php if ($standpunt) : ?>
        <div id="tab-standpunten" class="content-tab">
          <?php print $standpunten->preview('default'); ?>
        </div>
      <?php endif; ?> 

      <!--REDENEN-->
      <div id="tab-redenen" class="content-tab">
        <?php if ($reden) : ?>
          <?php print views_embed_view('verkiezingsredenen'); ?>
        <?php endif; ?>
        <!-- <h3>Waarom stem jij SP?</h3> -->
        <?php //print drupal_render(drupal_get_form('afd_verkiezing_redenstemmen')); ?>
      </div>

      <!--PROGRAMMA-->
      <div id="tab-programma" class="content-tab">
        <div id="programma-index">
          <h4>Inhoudsopgave:</h4>
          <?php print views_embed_view('verkiezingsprogramma','index'); ?>
        </div>
        <div id="programma-chapters">
          <?php print views_embed_view('verkiezingsprogramma','chapters'); ?>
        </div>
      </div>

      <!-- NIEUWS -->
      <div id="tab-nieuws" class="content-tab">
        <?php if ($nieuws) : ?>
          <?php print views_embed_view('verkiezingsnieuws'); ?>
        <?php endif; ?>
      </div>

      <!--DOE MEE / AGENDA-->
      <div id="tab-doemee" class="content-tab">
        <?php if ($agendaitem) : ?>
          <div class="section">
            <h3>Agenda</h3>
            <?php print $agenda->preview('default'); ?>
          </div>
        <hr/>
        <?php endif; ?>
        <div class="section">
          <h3>Doe mee</h3>
          <?php print render(field_view_field('node', $node, 'field_intro_verk_doemee','default')); ?>
          <?php print drupal_render(drupal_get_form('verkiezing_doemee')); ?>
        </div>
        <hr/>
        <div class="section">
          <h3>Meld je aan</h3>
          <?php print drupal_render(drupal_get_form('afd_verkiezing_doemee')); ?>
        </div>
      </div>

    </div>

  </div>
<!-- TOP -->
<div id="to-top">
  <a href="#top">Terug naar boven</a>
</div >
<?php if ($is_front) : ?>
  <div id="to-normal">
    <a href="<?php print $linkto; ?>" target="_blank">Normale website</a>
  </div>
<?php endif; ?>
<div id="footer">
  <div class="menu"><p>
    <a href="http://www.sp.nl/" target="_blank">www.sp.nl</a>
    <a href="http://www.sp.nl/partij/"target="_blank">Partij</a>
    <a href="http://www.sp.nl/service/links/" target="_blank">Afdelingen</a>
    <a href="http://www.sp.nl/nieuws/" target="_blank">Nieuws</a>
    <a href="http://www.sp.nl/nieuws/agenda/" target="_blank">Agenda</a>
    <a href="http://www.sp.nl/publicaties/" target="_blank">Publicaties</a>
    <a href="http://www.sp.nl/shop/" target="_blank">Shop</a>
    <a href="http://www.sp.nl/programma/" target="_blank">Programma</a>
    <a href="http://www.sp.nl/interact/contact/" target="_blank">Contact</a>
    <a href="http://www.sp.nl/interact/word_lid/" target="_blank">Lid worden</a>
    <a href="http://www.sp.nl/interact/opzeggen/" target="_blank">Opzeggen</a>
  </p>
</div>
  <div class="copyright">SP &copy 1996-<?php print date('Y'); ?></div>
</div>
