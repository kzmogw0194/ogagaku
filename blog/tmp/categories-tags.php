
<div class="bl_cat">
  <div class="bl_cat_category"><?php the_category(); ?></div>
  <?php if (get_the_tags()): ?>
  <div class="bl_cat_tags"><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?></div>
  <?php endif; ?>
</div>
