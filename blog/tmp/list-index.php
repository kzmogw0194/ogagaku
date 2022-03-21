
<h2 class="bl_cardList_head">
  <span class="bl_cardList_title">web制作一覧</span>
</h2>

<?php
  $my_query = new WP_Query( array(
    'post_type' => 'post', // 投稿タイプ
    'category_name' => 'work',
    'posts_per_page' => '10',
    'orderby' => 'date',
    'order' => 'DESC'
  ));
?>

<div class="bl_cardList">
  <?php
  ////////////////////////////
  //一覧の繰り返し処理
  ////////////////////////////
    if( $my_query->have_posts() ) : // WordPress ループ
      while( $my_query->have_posts() ) : $my_query->the_post(); ?>

    <?php //トップページリスト
      get_template_part('tmp/card'); ?>

    <?php endwhile; // 繰り返し処理終了 ?>

    <?php else : // ここから記事が見つからなかった場合の処理
      get_template_part('tmp/list-not-found-posts');
    endif;
    ?>
</div><!-- .bl_cardList -->
