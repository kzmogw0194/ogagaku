

<header class="ly_header">
  <div class="ly_header_inner">
    <div class="bl_header">
      <div class="bl_logo">
        <h1 class="bl_logo_img">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/header-logo.png" alt="logo">
          </a>
        </h1>
      </div>

      <?php 
        wp_nav_menu( array( 
          'theme_location' => 'header-navigation',
          'container'       => 'nav',
          'container_class' => 'bl_headerNav',
          'menu_class'      => 'bl_headerNav_menu',
        ) ); 
      ?>

      <?php 
        wp_nav_menu( array( 
          'theme_location' => 'bottom-navigation',
          'container'       => 'nav',
          'container_class' => 'bl_bottomNav',
          'menu_class'      => 'bl_bottomNav_menu',
        ) ); 
      ?>

      <nav class="bl_gNav">
        <div class="bl_gNav_inner">
          <input id="bl_gNav_input" type="checkbox">
          <label class="bl_gNav_open" for="bl_gNav_input">
            <span class="bl_gNav_line"></span>
            <span class="bl_gNav_caption">カテゴリー</span>
          </label>

          <?php 
            wp_nav_menu( array( 
              'theme_location' => 'category-navigation',
              'container'       => 'div',
              'container_class' => 'bl_categoryNav',
              'menu_class'      => 'bl_categoryNav_menu',
            ) ); 
          ?>

        </div><!-- /.bl_gNav_inner -->
      </nav>

    </div><!-- /.bl_header -->
  </div><!-- /.ly_header_inner -->
</header>

  <div class="ly_content">

    <div class="ly_content_inner">

      <main class="main">

      <?php //投稿パンくずリストがメイン手前の場合
      if (is_single()){
        get_template_part('tmp/breadcrumbs');
      } ?>

      <?php //固定ページパンくずリストがメイン手前の場合
      if (is_page()){
        get_template_part('tmp/breadcrumbs-page');
      } ?>
