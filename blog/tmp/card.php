

<a href="<?php echo esc_url(get_the_permalink()); ?>" class="bl_card_wrap" title="<?php echo esc_attr(get_the_title()); ?>">
  <article <?php post_class( array('post-'.get_the_ID(), 'bl_card') ); ?>>
    <figure class="bl_card_thumb">
      <?php echo get_thumb_mediumimg('m-size'); ?> 
    </figure>
    <div class="bl_card_content">
      <h2 class="bl_card_title"><?php the_title() ?></h2>
      <p class="bl_card_snipet">
        <?php
          $remove_array = ["\r\n", "\r", "\n", " ", "　"];
          $content = wp_trim_words(strip_shortcodes(get_the_content()), 60, '…' );
          $content = str_replace($remove_array, '', $content);
          echo $content;
        ?>
      </p>
      <div class="bl_card_meta">
        <dl class="bl_card_author">
          <dt class="bl_card_authorIcon">
          <?php echo get_avatar( get_the_author_id(), 50 ); ?>
          </dt>
          <dd class="bl_card_authorName"><?php the_author(); ?></dd>
        </dl>
        <span class="bl_card_time"><?php echo get_the_date('Y.m.d'); ?></span>
      </div><!-- /.bl_card_meta -->
    </div><!-- /.bl_card_content -->
    <div class="bl_card_info">
      <p class="bl_card_category"><!-- リンク無しカテゴリ -->
        <?php $cat = get_the_category(); ?>
        <?php $cat = $cat[0]; ?>
        <?php echo get_cat_name($cat->term_id); ?>
      </p>
    </div><!-- /.bl_card_info -->
  </article>
</a>
