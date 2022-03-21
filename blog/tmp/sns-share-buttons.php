
<div class="bl_share_wrap">
  <h3 class="bl_share_title el-heading3">share this</h3>
  <ul class="bl_share">

    <?php if(get_option('checkbox1')): ?>
    <li class="bl_share_sns bl_share_twitter">
      <a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>&hashtags=ogagaku%20@ogawa_kazuma_gb" rel="nofollow" class="sns-icon icon-twitter" target="_blank" rel="noopener noreferrer"></a>
    </li>
    <?php endif; ?>

    <?php if(get_option('checkbox2')): ?>
    <li class="bl_share_sns bl_share_facebook">
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"></a>
    </li>
    <?php endif; ?>

    <?php if(get_option('checkbox3')): ?>
    <li class="bl_share_sns bl_share_line">
      <a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer"></a>
    </li>
    <?php endif; ?>

    <?php if(get_option('checkbox4')): ?>
    <li class="bl_share_sns bl_share_mail">
      <a href="mailto:?subject=<?php the_title(); ?> | ogagaku&amp;body=<?php the_title(); ?>%0A<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"></a>
    </li>
    <?php endif; ?>
  </ul>
</div>
