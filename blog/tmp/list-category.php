
<h2 class="bl_cardList_head">
  <span class="bl_cardList_title"><?php single_cat_title(); ?>の記事一覧</span>
</h2>

<?php
   $cat = get_the_category();
   $cat_name = $cat[0]->cat_name; // カテゴリー名
   $cat_slug  = $cat[0]->category_nicename; // カテゴリースラッグ
   $paged = get_query_var('paged');
   $args = array(
    'post_type' => 'post',//投稿を表示
    'posts_per_page' => 15, //表示する件数
    'category_name' => $cat_slug, 
    'paged' => $paged,
   );
    $the_query = new WP_Query( $args );
  ?>

<div class="bl_cardList">
  <?php
  ////////////////////////////
  //一覧の繰り返し処理
  ////////////////////////////
    if ( $the_query->have_posts() ) : // WordPress ループ
      while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <?php //カテゴリーリスト
      get_template_part('tmp/entrycard'); ?>

    <?php endwhile; // 繰り返し処理終了 ?>

    <?php else : // ここから記事が見つからなかった場合の処理
      get_template_part('tmp/list-not-found-posts');
    endif;
    ?>
</div><!-- .bl_cardList -->
