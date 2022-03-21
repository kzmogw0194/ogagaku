

<a href="<?php echo esc_url(get_the_permalink()); ?>" class="bl_entryCard_wrap" title="<?php echo esc_attr(get_the_title()); ?>">
  <article <?php post_class( array('post-'.get_the_ID(), 'bl_entryCard') ); ?>>
    <figure class="bl_entryCard_thumb">
      <?php echo get_thumb_mediumimg('m-size'); ?> 
    </figure>
    <div class="bl_entryCard_content">
      <h2 class="bl_entryCard_title"><?php the_title() ?></h2>
      <div class="bl_entryCard_meta">
        <dl class="bl_entryCard_author">
          <dt class="bl_entryCard_authorIcon">
          <?php echo get_avatar( get_the_author_id(), 50 ); ?>
          </dt>
          <dd class="bl_entryCard_authorName"><?php the_author(); ?></dd>
        </dl>
        <span class="bl_entryCard_time"><?php echo get_the_date('Y.m.d'); ?></span>
      </div><!-- /.bl_card_meta -->
    </div><!-- /.bl_card_content -->
    <div class="bl_entryCard_banner">
      <p class="bl_entryCard_snipet">
        <?php
          $remove_array = ["\r\n", "\r", "\n", " ", "　"];
          $content = wp_trim_words(strip_shortcodes(get_the_content()), 200, '…' );
          $content = str_replace($remove_array, '', $content);
          echo $content;
        ?>
      </p>
    </div>
  </article>
</a>
