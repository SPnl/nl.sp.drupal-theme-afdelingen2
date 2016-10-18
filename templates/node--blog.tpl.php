<?php

/**
 *  node--blog.tpl.php - 2.0
 *  See: http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 */

?>

<div id="blog-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="profile">
    <?php print render($content['field_blog_categorie']);?>
    <?php
      if ($user = user_load($uid)) {  
	if (!empty($user->realname)) {
	  $displayname = $user->realname;
          if(module_load_include('inc','pathauto','pathauto') !== FALSE) {
            if (function_exists('pathauto_cleanstring')) {
              $urlname = pathauto_cleanstring($displayname);
            }
          }
	}
      }
    ?>
    <?php if (!empty($urlname)) : ?>
    <span class="name">Blog: <a href="/blog/alle/<?php print $urlname; ?>"><?php print $displayname; ?></a></span>
    <?php endif; ?>
  </div>
  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title;  ?></a></h2>
  <?php endif; ?>
    <?php print render($title_suffix); ?>
    <div class="node-content clearfix"<?php print $content_attributes; ?>>
      <?php
        hide($content['comments']);
        hide($content['sp_share']);
        hide($content['read_more']);
        print render($content);
      ?>

      <?php if(!$teaser) : ?>
      <?php if (!empty($urlname)) : ?>
        <div class="zie-ook">
        <strong><?php print t('See also:'); ?></strong>
          <ul>
            <li><?php print t('Who is <a href="@url">@name</a>?', array('@url' => '/onze-mensen/' . $urlname, '@name' => $displayname)); ?></li>
          </ul>
        </div>
      <?php endif; ?>
      <?php endif; ?>
    </div>


  <?php if(!$teaser) { print render($content['sp_share']); } else {
    print render($content['read_more']); } ?>
<?php print render($content['comments']); ?>
</div>
