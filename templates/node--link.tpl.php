<?php

/**
 *  node--nieuwsitem.tpl.php - beta 1.0
 *  See: http://api.drupal.org/api/drupal/modules--node--node.tpl.php/7
 */
 
?>

<div id="nieuws-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
	
	<?php print render($title_prefix); ?>
		<?php if (!$page): ?>
			<h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title;  ?></a></h2>
		<?php endif; ?>  
	<?php print render($title_suffix); ?>	
	
		<div class="node-content clearfix"<?php print $content_attributes; ?>> 
			
			<?php 
		
			hide($content['comments']);
			hide($content['sp_share']);
			hide($content['field_weblink']);
			hide($content['field_dossier']);
			hide($content['field_bestand']);
			
			print render($content);  
                          
                        ?>

			<?php if(!$teaser) : ?>
                          <?php if (isset($content['field_dossier']['#items']) || isset($content['field_bestand']) || isset($content['field_weblink'])) : ?>
			    <div class="zie-ook">
                            <strong><?php print t('See also:'); ?></strong>
			    <ul>
			      <?php print '<li>' . render($content['field_bestand']) . '</li>'; ?>
			      <?php print '<li>' . render($content['field_weblink']) . '</li>'; ?>
			      <?php foreach ($content['field_dossier']['#items'] as $values) : ?>
				<?php
				  $tid = $values['tid'];
				  $term = taxonomy_term_load($tid); // load term object
				  $term_uri = taxonomy_term_uri($term); // get array with path
				  $path = drupal_get_path_alias($term_uri['path']);
				?>
                                <li><a href="/<?php print $path; ?>"><?php print t('Dossier:') . ' ' . $values['taxonomy_term']->name; ?></a></li>
			      <?php endforeach ?>
			    </ul>
			    </div>
                          <?php endif ?>
			<?php endif ?>
		</div>

		<?php if(!$teaser) { print render($content['sp_share']); } ?>
		
		<?php print render($content['comments']); ?>
</div>
