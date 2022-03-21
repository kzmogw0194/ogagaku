
<!-- サイドバー  -->
<?php if ( is_active_sidebar('main-sidebar') ) : ?>
<div class="ly_sidebar">
    <?php dynamic_sidebar('main-sidebar'); ?>

    <?php if ( !wp_is_mobile() && is_single() ) : ?>
    <?php //SNSボトムシェアボタンの表示
      get_template_part('tmp/sns-share-buttons');
    ?>
    <?php endif; ?>

</div><!-- /.ly_sidebar -->
<?php endif; ?>
