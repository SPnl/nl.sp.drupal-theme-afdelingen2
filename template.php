<?php

/* Custom settings */

function get_custom_settings() {

  $type = theme_get_setting('afdelingen_type');
  $out = array();
  switch($type) {

  case 'rood-jong':
    $out['naam']  = 'ROOD, jong in de SP';
    $out['type']  = 'rood-jong';
    $out['title'] = 'ROOD';
  break;

  case 'steun':
    $out['naam']  = 'SP steunpunt';
    $out['type']  = 'steun';
    $out['title'] = 'SP';
  break;

  case 'international':
    $out['naam']  = 'SP - English language international section';
    $out['type']  = 'international';
    $out['title'] = 'SP';
  break;


  default:
    $out['naam']  = 'SP afdeling';
    $out['type']  = 'afdeling';
    $out['title'] = 'SP';
  break;
  }
  return $out;
}

/**
 *  TEMPLATE PREPROCESSING
 */

function afdelingen2_preprocess(&$variables, $hook) {
 $variables['afdelingen'] = get_custom_settings();
}

/**
 *  HTML Preprocess
 */

function afdelingen2_preprocess_html(&$variables) {

  // Add type to body classes
  $variables['classes_array'][] = $variables['afdelingen']['type'];

  // Add SP or ROOD to <head>><title>
  $titleSite = check_plain(variable_get('site_name', 'SP'));
  $nodeTitle = strip_tags(drupal_get_title());

  if($variables['afdelingen']['type'] !== 'rood-jong') {
    $titleSite = "SP ".$titleSite;
    if ($nodeTitle) {
      $title = $nodeTitle." :: ".$titleSite;
    } else {
      $title = $titleSite; // SP Juinen
    }
  } else {
    $title = "ROOD, jong in de SP";
    if ($nodeTitle) {
      $title = $nodeTitle. " :: ROOD";
    }
  }
  $variables['head_title'] = $title;
}

/**
 *  PAGE Preprocess
 */

function afdelingen2_preprocess_page(&$variables) {
  /* Adding theme path to JS, for MyFonts */
  drupal_add_js('jQuery.extend(Drupal.settings, { "pathToTheme": "' .base_path().drupal_get_path('theme', 'afdelingen2'). '" });', 'inline');

  // get the logo from planet SP
  $variables['branding'] = array(
    '#type' => 'markup',
    '#markup' => '<h1 id="site-branding">'
               . '<a href="http://www.sp.nl" target="_blank" class="site-logo">'
               . '<img src="https://planet.sp.nl/splogo141.gif" width="141" height="72" alt="SP" class="sp-logo" />'
               . '</a>'
               . '<a href="'.$variables['base_path'].'" class="site-name">'.$variables['site_name'].'</a>'
               . '</h1>',
   );

  // Breadcrumb seperator above content
  if($variables['is_front']) {
    $afdelingen_slogan = variable_get('site_slogan', '');
    if(!empty($afdelingen_slogan)) {
      $seperator_text = $afdelingen_slogan;
    } else {
      $seperator_text = $variables['afdelingen']['title'].' '.$variables['site_name'];
    }
  } else {
    // shorten title to last word before max number of characters
    $seperator_text = strip_tags(drupal_get_title());
    $title_length = 33;
    if (strlen($seperator_text) >= $title_length) {
      $seperator_text = substr( $seperator_text, 0, strrpos( substr($seperator_text, 0, $title_length), ' ' ) ).'&hellip;';
    }

    $seperator_text .= ' &rsaquo; <a href="'.$variables['front_page'].'">';
    if($variables['afdelingen']['type'] == 'rood-jong') {
      $seperator_text .= $variables['site_name'].'</a>';
    } else {
      $seperator_text .= $variables['afdelingen']['title'].' '.$variables['site_name'].'</a>';
    }
  }

  $variables['afdelingen_seperator'] = '<h3 class="title seperator-title">'.$seperator_text.'</h3>';

    // Add per content type pages
    if (isset($variables['node']->type)) {
      // For "type_name", it will pickup "page--type-name.tpl.php".
        $variables['theme_hook_suggestions'][]='page__'.$variables['node']->type;
    }
  }

/**
 *  NODE preprocess
 */

function afdelingen2_preprocess_node(&$variables) {

  // Read more and blog-links are removed for content links
  unset($variables['content']['links']['node']);
  unset($variables['content']['links']['blog']);
  unset($variables['content']['links']['comment']);

  $variables['content']['body']['#weight'] = -10; // unless stated otherwise, content goes first
  $variables['content']['links']['#weight'] = 5;

  // Read more link
 if($variables['teaser']) {
    $variables['content']['read_more'] = array(
      '#type' 	=> 'markup',
      '#markup' => '<span class="read-more"><a href="'.$variables['node_url'].'">' . t("Read more") . '</a></span>',
      '#weight' => 0, // read more after content
    );
  }

  // Special Date format
  if ($variables['afdelingen']['type'] == 'international') {
    $afd_date = format_date($variables['node']->created, 'custom', 'j M Y');
  }
  else {
    $afd_date = format_date($variables['node']->created, 'custom', 'j F Y');
  }
  $variables['afd_date'] = $afd_date;
  $variables['classes_array'][] = 'view-mode-'.$variables['view_mode'];

// Body field alterations
if(isset($variables['content']['body'])) {
    // Correct HTML in teaser
    if($variables['view_mode'] == 'teaser') {
      if (!empty($variables['content']['body'][0]['#markup'])) {
        $variables['content']['body'][0]['#markup'] = _filter_htmlcorrector($variables['content']['body'][0]['#markup']);
      }
    }
    // Inline Date in markup
    if($variables['display_submitted'] == TRUE) {
      if (!empty($variables['content']['body'][0]['#markup'])) {
        $variables['content']['body'][0]['#markup'] = inline_date($variables['content']['body'][0]['#markup'],$afd_date);
      }
    }
  }
}

/**
 * COMMENT preprocess
 */

function afdelingen2_preprocess_comment(&$variables) {
  $comment = $variables['elements']['#comment'];
  if ($variables['afdelingen']['type'] == 'international') {
    $variables['created_date'] = format_date($comment->created,'custom', 'j M Y');
  }
  else {
    $variables['created_date'] = format_date($comment->created,'custom', 'd-m-Y');
  }
  $variables['created_time'] = format_date($comment->created,'custom', 'H:i');
}

/**
 * SEARCH-RESULT preprocess
 */

function afdelingen2_preprocess_search_result(&$variables) {
  $result = $variables['result'];
  // Show node created date in search results via $variable['info'] (search-result.tpl.php - default)
  // Default variable content is still available for theming via the $variable['info_split']
  if (!empty($result['node']->created)) {
    if ($variables['afdelingen']['type'] == 'international') {
      $variables['info'] ="Published ".format_date($result['node']->created, 'custom', 'j M Y');
    }
    else {
      $variables['info'] ="Geschreven op: ".format_date($result['node']->created, 'custom', 'd-m-Y');
    }
  }
}

/**
 * Aggregator block
 */

function afdelingen2_aggregator_block_item($variables) {
  // Display the external link to the item.
  $time = format_date($variables['item']->timestamp,'custom', 'd F Y');
  return '<a href="' . check_url($variables['item']->link) . '">' . check_plain($variables['item']->title) ."</a><span class=\"feed-time\">$time</span>\n";
}

function inline_date($string,$date) {
  // Fix cc div.
  $string = preg_replace('/<p>(<div class="cc-image[^>]*><img[^>]*><div class="license-info"[^>]*>.*?<\/div><\/div>)/', '$1<p>', $string);
  preg_match('/<div class="cc-image[^>]*><img[^>]*><div class="license-info"[^>]*>.*?<\/div><\/div>/', $string, $matches);
  if (!empty($matches[0])) {
    $clean = trim(strip_tags(str_replace($matches[0], '', $string)));
  }
  else {
    $clean = trim(strip_tags($string));
  }
  $words = preg_split('/\s+/',$clean);
  if (empty($words[0])) {
    $pos = 0;
  }
  else {
    $pos   = strpos($string,$words[0]);
  }
  return substr_replace($string,'<span class="inline-date">'.$date.'</span><span class="inline-date-seperator">&bull;</span>', $pos, 0);
}

function afdelingen2_print_pdf_tcpdf_footer2($vars) {
  $pdf = $vars['pdf'];
  $pdf->SetPrintHeader(false);
  return $pdf;
}

function afdelingen2_print_pdf_tcpdf_header($vars) {
  $pdf = $vars['pdf'];
  $pdf->SetPrintHeader(false);

  return $pdf;
}

function afdelingen2_print_pdf_tcpdf_page($vars) {
  $pdf = $vars['pdf'];
  // set margins
  $pdf->SetMargins(10, 10, 10);
  // set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, 15);
  // set image scale factor
  $pdf->setImageScale(1);
  // set image compression quality
  $pdf->setJPEGQuality(100);
  return $pdf;
}

/**
 * Output customized node preview on node edit and add forms.
 */
function afdelingen2_node_preview($variables) {
  if ($variables['node']->type == 'poster') {
    $node = $variables['node'];
    $elements = node_view($node, 'full');
    $full = drupal_render($elements);
    $output = '<div class="preview">';
    $output .= $full;
    $output .= "</div>\n";
    return $output;
  }
  else {
    $node = $variables['node'];

    $output = '<div class="preview">';

    $preview_trimmed_version = FALSE;

    $elements = node_view(clone $node, 'teaser');
    $trimmed = drupal_render($elements);
    $elements = node_view($node, 'full');
    $full = drupal_render($elements);

    // Do we need to preview trimmed version of post as well as full version?
    if ($trimmed != $full) {
      drupal_set_message(t('The trimmed version of your post shows what your post looks like when promoted to the main page or when exported for syndication.<span class="no-js"> You can insert the delimiter "&lt;!--break--&gt;" (without the quotes) to fine-tune where your post gets split.</span>'));
      $output .= '<h3>' . t('Preview trimmed version') . '</h3>';
      $output .= $trimmed;
      $output .= '<h3>' . t('Preview full version') . '</h3>';
      $output .= $full;
    }
    else {
      $output .= $full;
    }
    $output .= "</div>\n";

    return $output;
  }
}
