
<article id="post-<?php the_ID(); ?>" <?php post_class('bl_article') ?> itemscope="itemscope" itemprop="blogPost" itemtype="https://schema.org/BlogPosting">
  <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post(); 
  ?>

  <?php //固定ページタイトル上ウイジェット
    if ( is_page() && is_active_sidebar( 'above-page-content-title' ) ): ?>
      <?php dynamic_sidebar( 'above-page-content-title' ); ?>
  <?php endif; ?>

  <div class="bl_article_head">
    <h1 class="bl_article_title el-heading1" itemprop="headline">
      <?php the_title(); ?>
    </h1>
    <?php if ( is_single() ) : ?>
    <time class="bl_article_time">
      <span>公開日 <?php echo get_the_date('Y.m.d'); ?></span>
      <span>最終更新日 <?php the_modified_date('Y.m.d') ?></span>
    </time>
    <?php endif; ?>
    <?php //本文上のカテゴリー・タグ
      get_template_part('tmp/categories-tags');
    ?>
    <?php if ( is_single() ) : ?>
    <figure class="bl_article_thumb el_img">
      <?php echo get_thumb_img('thumbnail'); ?> 
    </figure>
    <?php endif; ?>
  </div><!-- /.bl_article_head -->

  <div class="bl_article_content" itemprop="mainEntityOfPage">
    <?php the_content(); ?>
  </div><!-- /.bl_article_content -->

  <div class="bl_article_bottom">
    
    <?php if ( is_single() ) : ?>
    <?php //SNSボトムシェアボタンの表示
      get_template_part('tmp/sns-share-buttons');
    ?>
    <?php endif; ?>

    <?php //SNSフォローボタン
      get_template_part('tmp/sns-follow-buttons');
    ?>
    
    </div><!-- /.bl_article_bottom -->

    <?php
    } // end while
  } //have_posts end if ?>
</article>
