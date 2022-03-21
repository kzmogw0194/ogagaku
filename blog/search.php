<?php get_header(); ?>

<?php if (have_posts()): ?>
  <p>
  <?php
    if (isset($_GET['s']) && empty($_GET['s'])) {
      echo '検索キーワードが未入力です'; // 検索キーワードが未入力の場合のテキストを指定
    } else {
      echo '“'.$_GET['s'] .'”の検索結果：'.$wp_query->found_posts .'件'; // 検索キーワードと該当件数を表示
    }
  ?>
  </p>
<ul>
  <?php while(have_posts()): the_post(); ?>
  <li>
    <?php //カテゴリーリスト
      get_template_part('tmp/entrycard'); ?>
  </li>
  <?php endwhile; ?>
</ul>
<?php else: ?>
  <p>検索されたキーワードにマッチする記事はありませんでした</p>
<?php endif; ?>

<?php get_footer(); ?>
