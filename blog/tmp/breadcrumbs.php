
<div class="bl_breadcrumb_wrap">
  <ul class="bl_breadcrumb">
    <li class="bl_breadcrumb_item">
      <a href="<?php echo home_url(); ?>">
        <span class="bl_breadcrumb_caption">Home</span>
      </a>
    </li>
    <li class="bl_breadcrumb_item">
      <?php
        $category = get_the_category();
        echo '<a href="'.get_category_link($category[0]->term_id).'"><span class="bl_breadcrumb_caption">'.$category[0]->name.'</span></a>';
      ?>
    </li>
    <li class="bl_breadcrumb_item">
      <a href="<?php echo home_url(); ?>">
        <span class="bl_breadcrumb_caption"><?php the_title(); ?></span>
      </a>
    </li>
  </ul>
</div><!-- .bl_breadcrumb -->
