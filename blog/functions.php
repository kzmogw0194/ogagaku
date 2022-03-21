<?php
add_theme_support( 'block-templates' );
//-------------------------------------------------------
//　アイキャッチ画像
//-------------------------------------------------------
add_theme_support('post-thumbnails');
add_image_size( 'm-size', 450, 236, true );
function get_thumb_img($size = 'thumbnail') {
  
	$thumb_id = get_post_thumbnail_id();                         // アイキャッチ画像のIDを取得
	
	$thumb_img = wp_get_attachment_image_src($thumb_id, $size);  // $sizeサイズの画像内容を取得
	
	$thumb_src = $thumb_img[0];    // 画像のurlだけ取得
	
	$thumb_alt = get_the_title();  //alt属性に入れるもの（記事のタイトルにしています）
  
	return '<img src="'.$thumb_src.'" alt="'.$thumb_alt.'" width = "1025" height = "auto"">';
  }

  function get_thumb_mediumimg($size = 'm-size') {
  
	$thumb_id = get_post_thumbnail_id();                         // アイキャッチ画像のIDを取得
	
	$thumb_img = wp_get_attachment_image_src($thumb_id, $size);  // $sizeサイズの画像内容を取得
	
	$thumb_src = $thumb_img[0];    // 画像のurlだけ取得
	
	$thumb_alt = get_the_title();  //alt属性に入れるもの（記事のタイトルにしています）
  
	return '<img src="'.$thumb_src.'" alt="'.$thumb_alt.'" width = "450" height = "auto"">';
  }


//-------------------------------------------------------
//　css 読み込み
//-------------------------------------------------------
function add_stylesheet() {
	wp_register_style(
		'fontawesome', 
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', // CSSのパス
		array(), // これより先に読むCSSはないので空の配列
		'6.0',
		false // headタグ内に出力
	);
	wp_register_style(
		'reset', // ★resetという別名をつけた(リセット用CSSだったので)
		get_template_directory_uri().'/css/reset.css', // CSSのパス
		array('fontawesome'), 
		'1.0',
		false // headタグ内に出力
	);
	wp_enqueue_style(
		'main',
		get_template_directory_uri().'/css/style.css',
		array('fontawesome', 'reset'), // ★の名前を配列に指定=style.cssより先に読み込む
		'1.0',
		false
	);
  }
  add_action('wp_enqueue_scripts', 'add_stylesheet');

//-------------------------------------------------------
//　js 読み込み
//-------------------------------------------------------

function add_script(){
	if(is_admin()) return; //管理画面ではスクリプトは読み込まない
    wp_deregister_script( 'jquery'); //デフォルトの jQuery は読み込まない
	wp_register_script(
		'first',
		'https://code.jquery.com/jquery-3.4.1.min.js',
		array(),
		'3.4.1',
		true // trueでbody閉じタグ前に出力
	);
	if (is_home() || is_front_page()){
		wp_register_script(
			'second',
			'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js',
			array('first'),
			'1.4.1',
			true // trueでbody閉じタグ前に出力
		);
		wp_enqueue_script(
			'third',
			get_template_directory_uri().'/js/myscript_front.js',
			array('first', 'second'),
			'1.0',
			true
		);
	}else{
		wp_enqueue_script(
			'forth',
			get_template_directory_uri().'/js/myscript_other.js',
			array('first'),
			'1.0',
			true
		);
	}
}	  
  add_action('wp_enqueue_scripts','add_script');

  function defer_parsing_of_js( $url ) {
	if ( is_user_logged_in() ) return $url; //don't break WP Admin
	if ( FALSE === strpos( $url, '.js' ) ) return $url;
	if ( strpos( $url, 'jquery.js' ) ) return $url;
	return str_replace( ' src', ' defer src', $url );
}
	add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );

  function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );    
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );    
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emojis' );

//-------------------------------------------------------
//　カスタムメニュー
//-------------------------------------------------------
register_nav_menus(array(
	'header-navigation'    => 'ヘッダーナビゲーション',
	'bottom-navigation'    => 'ボトムナビゲーション',
	'category-navigation'  => 'カテゴリーリスト',
	'footer'    => 'フッターナビゲーション',
));



//-------------------------------------------------------
//　カスタムヘッダー
//-------------------------------------------------------
$custom_header_defaults = array(
	// デフォルトで表示するヘッダー画像(画像のURLを入力)
	'default-image' => get_template_directory_uri() . '/images/logo.png',
	// ヘッダー画像の横幅
	'width' => 200,
	// ヘッダー画像の縦幅
	'height' => 60,
	'random-default' => false,
	'flex-width' => false,
	'flex-height' => false,
	'uploads' => true,
	'header-text' => true
);
add_theme_support( 'custom-header', $custom_header_defaults );


// ヘッダーのテキストカラーを自由に選べるようにする
function wphead_cb() {
	echo '<style type="text/css">';
	echo '.bl_headerConts_nav a { color: #'.get_header_textcolor().' }';
	echo '</style>';
}
 
$custom_header_args = array(
	'default-text-color' => '000',
	'wp-head-callback' => 'wphead_cb'
);
add_theme_support( 'custom-header', $custom_header_args );



//-------------------------------------------------------
//　ウィジェット追加
//-------------------------------------------------------
function my_theme_widgets_init() {
  register_sidebar( array(
    'name' => 'Main Sidebar',
    'id' => 'main-sidebar',
		'before_widget' => '<aside class="bl_widgets">',
    'after_widget' => '</aside>',
  ) );
}
add_action( 'widgets_init', 'my_theme_widgets_init' );

//*** 最近のコメント（リッチ）ウイジェット　ここから ***//
class RecentCommentsWidgetItem extends WP_Widget {
  function __construct() {
     parent::__construct(
      'recent_comments',
      '最近のコメント（カスタム）',//ウイジェット名
      array('description' => '最近投稿されたを表示します。')
    );
  }
  function widget($args, $instance) {
    extract( $args );
    //タイトル名を取得
    $title = apply_filters( 'widget_recent_comment_title', $instance['title'] );
    //表示数
    $count = apply_filters( 'widget_recent_comment_count', $instance['count'] );
    //文字数
    $str_count = apply_filters( 'widget_recent_comment_str_count', $instance['str_count'] );
    //管理者除外するか
    $author_not_in = apply_filters( 'widget_recent_comment_author_not_in', $instance['author_not_in'] );
 
     ?>
      <?php //classにwidgetと一意となるクラス名を追加する ?>
      <?php echo $args['before_widget']; ?>
        <?php
        echo $args['before_title'];
        if ($title) {
          echo $title;//タイトルが設定されている場合は使用する
        } else {
          echo '最近のコメント';
        }
        echo $args['after_title'];
        ?>
        <dl class="bl_comment_wrap">
          <?php
          $comments_args = array(
            'author__not_in' => $author_not_in ? 1 : 0, // 管理者は除外
            'number' => $count, // 取得する数
            'status' => 'approve', // 承認済みのみ取得
            'type' => 'comment' // 取得タイプを指定。トラックバックとピンバックは除外
          );
          //クエリの取得
          $comments_query = new WP_Comment_Query;
          $comments = $comments_query->query( $comments_args );
          //ループ
          if ( $comments ) {
            foreach ( $comments as $comment ) {
              $url = get_permalink($comment->comment_post_ID);
 
              echo '<ul class="bl_comment">';
              echo '<li class="bl_comment_item">';
							
							echo '<div class="bl_comment_info">';
							echo '<figure class="bl_comment_img">';
              echo get_avatar( $comment, '38' );
							echo '</figure>';
 
							echo '<div class="bl_comment_meta">';
							echo '<div class="bl_comment_author">';
              comment_author($comment->comment_ID);
              echo '</div>';

							echo '<div class="bl_comment_date">';
              echo comment_date( 'Y.n.d', $comment->comment_ID);
              echo '</div>';
							echo '</div>';
							echo '</div>';
              
              echo '<div class="bl_comment_content">';
              $my_pre_comment_content = strip_tags($comment->comment_content);
               if(mb_strlen($my_pre_comment_content,"UTF-8") > $str_count) {
                $my_comment_content = mb_substr($my_pre_comment_content, 0, $str_count) ; echo $my_comment_content. '...' ;
              } else {
                echo $comment->comment_content;
              };
              echo '</div>';
 
              echo '<div class="bl_comment_title">';
              echo '&#128172;<a href="'.get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID.'">'.$comment->post_title.'</a>';
              echo '</div>';
 
							echo '</li>';
              echo '</ul>';
            }
          } else {
            echo 'なし';
          }
          ?>
        </dl>
      <?php echo $args['after_widget']; ?>
    <?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['count'] = $new_instance['count'];
    $instance['str_count'] = $new_instance['str_count'];
    $instance['author_not_in'] = $new_instance['author_not_in'];
    return $instance;
  }
  function form($instance) {
    if(empty($instance)){//notice回避
      $instance = array(
        'title' => null,
        'count' => 5,
        'str_count' => 100,
        'author_not_in' => false,
      );
    }
    $title = esc_attr($instance['title']);
    $count = esc_attr($instance['count']);
    $str_count = esc_attr($instance['str_count']);
    $author_not_in = esc_attr($instance['author_not_in']);
    ?>
    <?php //タイトル入力フォーム ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">
      タイトル
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php //表示する数 ?>
    <p>
      <label for="<?php echo $this->get_field_id('count'); ?>">
        表示する数
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" min="3" max="30" value="<?php echo $count; ?>" />
    </p>
    <?php //文字数 ?>
    <p>
      <label for="<?php echo $this->get_field_id('str_count'); ?>">
        文字数
      </label>
      <input class="widefat" id="<?php echo $this->get_field_id('str_count'); ?>" name="<?php echo $this->get_field_name('str_count'); ?>" type="number" min="30" value="<?php echo $str_count; ?>" />
    </p>
    <?php //管理者の除外 ?>
    <p>
      <label for="<?php echo $this->get_field_id('author_not_in'); ?>">
        管理者の除外
      </label><br />
      <input class="widefat" id="<?php echo $this->get_field_id('author_not_in'); ?>" name="<?php echo $this->get_field_name('author_not_in'); ?>" type="checkbox" value="on"<?php echo ($author_not_in ? ' checked="checked"' : ''); ?> />管理者のを表示しない
    </p>
    <?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("RecentCommentsWidgetItem");'));
//*** 最近のコメント（リッチ）ウイジェット　ここまで ***//


//-------------------------------------------------------
//　タグのリンクを表示
//-------------------------------------------------------
function the_tags_view(){
	$tags = get_the_tags();
	if( $tags ){
		$count = count( $tags );
		usort( $tags , 'sort_tags_by_count' );
		echo '（ ';
		for( $i=0; $i < $count; $i++ ){
			$tag = $tags[ $i ];
			echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a>';
			if( $i != $count - 1 ){
				echo ' , ';
			}
		}
		echo " ）";
	}
}

function sort_tags_by_count( $a , $b ){
	if( $a->count == $b->count ){
		return 0;
	}
	return ($a->count > $b->count) ? -1 :1;
}

//-------------------------------------------------------
//　投稿数表示タグクラウドウィジェット
//-------------------------------------------------------
class ArticleCntTagCloudWidget extends WP_Widget {

	function ArticleCntTagCloudWidget() {
		parent::WP_Widget(
			false,
			$name = '[t] 投稿数表示タグクラウド',
			array( 'description' => '投稿数を表示するタグクラウドです', )
		);
	}

	function widget( $args, $instance ) {
		extract( $args );
		
		if($instance['title'] != ''){
			$title = apply_filters('widget_title', $instance['title']);
		}
		echo $before_widget;
		if( $title ){ echo $before_title . $title . $after_title; }
		
		echo '<ul class="count-tag-cloud clearfix">';
		$tags = get_tags();
		foreach( $tags as $tag ){
			$tag_link = get_tag_link( $tag->term_id );
			echo '<li><a href="' . $tag_link . '">' . $tag->name . '<span>'. $tag->count .'</span></a></li>';
		}
		echo '</ul>';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
	<?php
	}

}
add_action( 'widgets_init',function(){ register_widget( 'ArticleCntTagCloudWidget'); });

//-------------------------------------------------------
//　オリジナルメニュー
//-------------------------------------------------------
add_action('admin_menu', 'custom_menu_page');
  function custom_menu_page(){
    add_menu_page('テーマ設定画面', 'テーマ設定', 'manage_options', 'custom_menu_page', 'add_custom_menu_page', 'dashicons-admin-generic', 4);
  }
  function add_custom_menu_page(){
	 ?>
		<div class="wrap">
			<h2>テーマ設定画面</h2>
		</div>
		<?php
	}

	add_action('admin_menu', 'add_custom_submenu_page');
	function add_custom_submenu_page()
	{
			add_submenu_page('custom_menu_page', 'SNSシェア管理画面', 'SNSシェア管理', 'manage_options', 'custom_submenu_page_1', 'add_custom_menu_page_1', 1);
			add_submenu_page('custom_menu_page', 'SNSフォロー設定画面', 'SNSフォロー設定', 'manage_options', 'custom_submenu_page_2', 'add_custom_menu_page_2', 2);
			add_action('admin_init', 'register_custom_setting');
	}
	 
	function add_custom_menu_page_1()
	{
			?>
	<div class="wrap">
			<h2>SNSシェア管理画面</h2>
			<form method="post" action="options.php" enctype="multipart/form-data" encoding="multipart/form-data">
			<?php
			settings_fields('custom-menu-group');
			do_settings_sections('custom-menu-group'); ?>
    	<div class="metabox-holder">
				<div class="postbox ">
					<h3 class='hndle'><span>SNSシェア</span></h3>
					<div class="inside">
						<div class="main">
							<p class="setting_description">表示するSNSシェアをチェックしてください。</p>
							<h4>SNS一覧</h4>
							<label><input name="checkbox1" id="checkbox1" type="checkbox" value="1" <?php checked(1, get_option('checkbox1')); ?> />Twitter</label><br>
							<label><input name="checkbox2" id="checkbox2" type="checkbox" value="2" <?php checked(2, get_option('checkbox2')); ?> />FaceBook</label><br>
							<label><input name="checkbox3" id="checkbox3" type="checkbox" value="3" <?php checked(3, get_option('checkbox3')); ?> />Line</label><br>
							<label><input name="checkbox4" id="checkbox4" type="checkbox" value="4" <?php checked(4, get_option('checkbox4')); ?> />Mail</label>
						</div>
					</div>
				</div>
				<div class="postbox ">
        <h3 class='hndle'><span>トップページOGP画像</span></h3>
        <div class="inside">
          <div class="main">
            <p class="setting_description">画像URLを入力してください。</p>
            <h4>URL</h4>
            <p><input type="text" id="text" name="text" value="<?php echo get_option('text'); ?>"></p>
          </div>
        </div>
      </div>
			</div>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
	}
	function register_custom_setting()
	{
    register_setting('custom-menu-group', 'checkbox1');
		register_setting('custom-menu-group', 'checkbox2');
		register_setting('custom-menu-group', 'checkbox3');
		register_setting('custom-menu-group', 'checkbox4');
		register_setting('custom-menu-group', 'text');
	}

	function add_custom_menu_page_2()
	{
			?>
	<div class="wrap">
			<h2>SNSフォロー設定画面</h2>
	</div>
	<?php
	}

//-------------------------------------------------------
//　テーマカスタマイザー
//　Google AnalyticsのトラッキングIDを保存
//-------------------------------------------------------
function takeroot_ga_setting_customizer( $wp_customize ) {
	
	// セクションの設定
	// analytics_sectionというセクションを追加
	$wp_customize->add_section( 'analytics_section' , array(
		'title' => 'Google Analytics', 
		'priority' => 999, 
		'description' => 'Google AnalyticsのトラッキングIDを設定してください',
	));
	
	// セクションの動作
	// universal_analytics_tracking_codeに設定値を保存
	$wp_customize->add_setting(	'universal_analytics_tracking_code' , array(
        'type'           => 'option',
	));
	
	//コントロール設定
	$wp_customize->add_control( 'universal_analytics_tracking_code', array(
        'label' => 'トラッキングID [ UA-xxxxxxxx-x ]',
        'section' => 'analytics_section',
        'settings' => 'universal_analytics_tracking_code',
        'type'=> 'text',
    ));

	// セクションの動作
	// google_analytics_tracking_codeに設定値を保存
	$wp_customize->add_setting(	'google_analytics_tracking_code' , array(
        'type'           => 'option',
	));
	
	//コントロール設定
	$wp_customize->add_control( 'google_analytics_tracking_code', array(
        'label' => 'トラッキングID [ G-xxxxxxxx ]',
        'section' => 'analytics_section',
        'settings' => 'google_analytics_tracking_code',
        'type'=> 'text',
    ));

	// セクションの動作
	// google_tag_manager_tracking_codeに設定値を保存
	$wp_customize->add_setting(	'google_tag_manager_tracking_code' , array(
        'type'           => 'option',
	));
	
	//コントロール設定
	$wp_customize->add_control( 'google_tag_manager_tracking_code', array(
        'label' => 'トラッキングID [ GTM-xxxxxxxx ]',
        'section' => 'analytics_section',
        'settings' => 'google_tag_manager_tracking_code',
        'type'=> 'text',
    ));

	// セクションの動作
	// google_tag_manager_tracking_codeに設定値を保存
	$wp_customize->add_setting(	'google_search_console_tracking_code' , array(
        'type'           => 'option',
	));
	
	//コントロール設定
	$wp_customize->add_control( 'google_search_console_tracking_code', array(
        'label' => '確認コード',
        'section' => 'analytics_section',
        'settings' => 'google_search_console_tracking_code',
        'type'=> 'textarea',
    ));
}

//カスタマイザーに登録
add_action( 'customize_register', 'takeroot_ga_setting_customizer' );

function get_ga_tracking_id(){
	return esc_html( get_option( 'analytics_tracking_code' ));
}


/*  存在しないページを指定された場合は 404 ページを表示する  */
function redirect_404() {
	//メインページ・シングルページ・アーカイブ（月別）・固定ページ 以外の指定の場合 404 ページを表示する
	if(is_home() || is_single() || is_category() || is_page() || is_search()) return;
	include(TEMPLATEPATH . '/404.php');
	exit;
  }
  add_action('template_redirect', 'redirect_404');




// アーカイブオン
function post_has_archive( $args, $post_type ) {

if ( 'post' == $post_type ) {
$args['rewrite'] = true;
$args['has_archive'] = 'news'; //任意のスラッグ名
}
return $args;

}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );


// keywords description
add_action('admin_menu', 'add_custom_fields');
add_action('save_post', 'save_custom_fields');

// 記事ページと固定ページでカスタムフィールドを表示
function add_custom_fields() {
  add_meta_box( 'my_sectionid', 'カスタムフィールド', 'my_custom_fields', 'post');
  add_meta_box( 'my_sectionid', 'カスタムフィールド', 'my_custom_fields', 'page');
}
function my_custom_fields() {
  global $post;
  $description = get_post_meta($post->ID,'description',true);
  echo '<p>ページの説明（description）160文字以内<br>';
  echo '<input type="text" style="width: 600px;height: 40px;" name="description" value="'.esc_html($description).'" maxlength="160"></p>';
}

// カスタムフィールドの値を保存
function save_custom_fields( $post_id ) {
  if(!empty($_POST['description'])){
    update_post_meta($post_id, 'description', $_POST['description'] );
  }else{
    delete_post_meta($post_id, 'description');
  }
}


function get_meta_description() {
	global $post;
	$description = "";
	if ( is_home() ) {
	  // ホームでは、ブログの説明文を取得
	  $description = get_bloginfo( 'description' );
	}
	elseif ( is_category() ) {
	  // カテゴリーページでは、カテゴリーの説明文を取得
	  $description = category_description();
	}
	elseif ( is_single() ) {
	  if ($post->post_excerpt) {
		// 記事ページでは、記事本文から抜粋を取得
		$description = $post->post_excerpt;
	  } else {
		// post_excerpt で取れない時は、自力で記事の冒頭100文字を抜粋して取得
		$description = strip_tags($post->post_content);
		$description = str_replace("\n", "", $description);
		$description = str_replace("\r", "", $description);
		$description = mb_substr($description, 0, 100) . "...";
	  }
	} else {
	  ;
	}
   
	return $description;
  }
   
  // echo meta description tag
  function echo_meta_description_tag() {
	if ( is_home() || is_category() || is_single() ) {
	  echo '<meta name="description" content="' . get_meta_description() . '" />' . "\n";
	}
  }

//タグメタディスクリプション用の説明文を取得
function get_meta_description_from_tag(){
	$cate_desc = trim( strip_tags( tag_description() ) );
	if ( $cate_desc ) {//カテゴリ設定に説明がある場合はそれを返す
	  return $cate_desc;
	}
	$cate_desc = '' ;
	return $cate_desc;
  }



/**********************
OGP設定
*********************/
function my_meta_ogp()
{
if (is_front_page() || is_home() || is_singular()) {
 
/*初期設定*/
 
// 画像 （アイキャッチ画像が無い時に使用する代替画像URL）
$ogp_image = get_option('text');
// Twitterのアカウント名 (@xxx)
$twitter_site = '@ogawa_kazuma_gb';
// Twitterカードの種類（summary_large_image または summary を指定）
$twitter_card = 'summary_large_image';
// Facebook APP ID
$facebook_app_id = '707010380004368';
 
/*初期設定 ここまで*/
 
global $post;
$ogp_title = '';
$ogp_description = '';
$ogp_url = '';
$html = '';
if (is_singular()) {
// 記事＆固定ページ
setup_postdata($post);
$ogp_title = $post->post_title;
$ogp_description = mb_substr(get_the_excerpt(), 0, 100);
$ogp_url = get_permalink();
wp_reset_postdata();
} elseif (is_front_page() || is_home()) {
// トップページ
$ogp_title = get_bloginfo('name');
$ogp_description = get_bloginfo('description');
$ogp_url = home_url();
}
 
// og:type
$ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';
 
// og:image
if (is_singular() && has_post_thumbnail()) {
$ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$ogp_image = $ps_thumb[0];
}
 
// 出力するOGPタグをまとめる
$html = "\n";
$html .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '">' . "\n";
$html .= '<meta property="og:description" content="' . esc_attr($ogp_description) . '">' . "\n";
$html .= '<meta property="og:type" content="' . $ogp_type . '">' . "\n";
$html .= '<meta property="og:url" content="' . esc_url($ogp_url) . '">' . "\n";
$html .= '<meta property="og:image" content="' . esc_url($ogp_image) . '">' . "\n";
$html .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
$html .= '<meta name="twitter:card" content="' . $twitter_card . '">' . "\n";
$html .= '<meta name="twitter:site" content="' . $twitter_site . '">' . "\n";
$html .= '<meta property="og:locale" content="ja_JP">' . "\n";
 
if ($facebook_app_id != "") {
$html .= '<meta property="fb:app_id" content="' . $facebook_app_id . '">' . "\n";
}
 
echo $html;
}
}
// headタグ内にOGPを出力する
add_action('wp_head', 'my_meta_ogp');


///////////////////////////////////////
// 自前でプロフィール画像の設定
///////////////////////////////////////
//プロフィール画面で設定したプロフィール画像
if ( !function_exists( 'get_the_author_upladed_avatar_url_demo' ) ):
	function get_the_author_upladed_avatar_url_demo($user_id){
	  if (!$user_id) {
		$user_id = get_the_posts_author_id();
	  }
	  return esc_html(get_the_author_meta('upladed_avatar', $user_id));
	}
	endif;
	//ユーザー情報追加
	add_action('show_user_profile', 'add_avatar_to_user_profile_demo');
	add_action('edit_user_profile', 'add_avatar_to_user_profile_demo');
	if ( !function_exists( 'add_avatar_to_user_profile_demo' ) ):
	function add_avatar_to_user_profile_demo($user) {
	?>
	  <h3>プロフィール画像</h3>
	  <table class="form-table">
		<tr>
		  <th>
			<label for="avatar">プロフィール画像URL</label>
		  </th>
		  <td>
			  <input type="text" name="upladed_avatar" size="70" value="<?php echo get_the_author_upladed_avatar_url_demo($user->ID); ?>" placeholder="画像URLを入力してください">
		   <p class="description">Gravatarよりこちらのプロフィール画像が優先されます。240×240pxの正方形の画像がお勧めです。</p>
		  </td>
		</tr>
	  </table>
	<?php
	}
	endif;
	//入力した値を保存する
	add_action('personal_options_update', 'update_avatar_to_user_profile_demo');
	if ( !function_exists( 'update_avatar_to_user_profile_demo' ) ):
	function update_avatar_to_user_profile_demo($user_id) {
	  if ( current_user_can('edit_user',$user_id) ){
		update_user_meta($user_id, 'upladed_avatar', $_POST['upladed_avatar']);
	  }
	}
	endif;
	//プロフィール画像を変更する
	add_filter( 'get_avatar' , 'get_uploaded_user_profile_avatar_demo' , 1 , 5 );
	if ( !function_exists( 'get_uploaded_user_profile_avatar_demo' ) ):
	function get_uploaded_user_profile_avatar_demo( $avatar, $id_or_email, $size, $default, $alt ) {
	  if ( is_numeric( $id_or_email ) )
		$user_id = (int) $id_or_email;
	  elseif ( is_string( $id_or_email ) && ( $user = get_user_by( 'email', $id_or_email ) ) )
		$user_id = $user->ID;
	  elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) )
		$user_id = (int) $id_or_email->user_id;
	  if ( empty( $user_id ) )
		return $avatar;
	  if (get_the_author_upladed_avatar_url_demo($user_id)) {
		$alt = !empty($alt) ? $alt : get_the_author_meta( 'display_name', $user_id );;
		$author_class = is_author( $user_id ) ? ' current-author' : '' ;
		$avatar = "<img alt='" . esc_attr( $alt ) . "' src='" . esc_url( get_the_author_upladed_avatar_url_demo($user_id) ) . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
	  }
	  return $avatar;
	}
	endif;



	//コメント機能
	function mytheme_comments($comment, $args, $depth){
		$GLOBALS['comment'] = $comment; ?>
		<li class="bl_comment_item <?php comment_class(); ?>" id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="bl_comment_wrapper">
				<div class="bl_comment_info">
				<?php echo get_avatar( $comment, $args['avatar_size']) ?>
					<ul class="bl_comment_meta">
						<li class="bl_comment_author">
						<?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?>
						</li>
						<li class="bl_comment_title">
						<?php
							$commentID_parent = $comment->comment_parent;
							if( $commentID_parent != 0 ):
						?>
							<a href="<?php echo htmlspecialchars( get_comment_link( $commentID_parent ) ) ?>"><?php echo get_comment_author($commentID_parent); ?>さんへの返信</a>
						<?php else: ?>
							<a href="#top">「<?php the_title(); ?>」へのコメント</a>
						<?php endif; ?>
						<?php 
							if ($comment->comment_approved == '0') {
								echo '<span class="comments-approval">このコメントは承認待ちです。</span>';
							}
						?>
						</li>
						<li class="bl_comment_date">
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
							<?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a>
	<span><?php edit_comment_link('（編集する）','','') ?></span>
						</li>
					</ul>
				</div><!-- bl_comment_info -->
				<div class="bl_comment_content">
					<?php comment_text() ?>
				</div>
				<div class="bl_comments_reply">
					<?php comment_reply_link(array_merge( $args, array(
						 'reply_text'=>'返信する', 
						 'add_below' =>$add_below, 
						 'depth' =>$depth, 
						 'max_depth' =>$args['max_depth']))) 
					?>
				</div>
			</div>
			<!-- comment-comment_ID -->
		<?php
 }

///////////////////////////////////////
// 吹き出し表示用ショートコード
///////////////////////////////////////
function ogagaku_speech_balloon( $atts, $content = '' ) {
	$atts = shortcode_atts(
			array(
					'image' => '',
					'alt'   => '',
					'type'  => 'r',
					'name'  => '',
			),
			$atts
	);

	if ( '' == $atts['image'] && '' == $content ) {
			return '';
	}
	if ( 'r' != $atts['type'] && 'l' != $atts['type'] ) {
			$atts['type'] = 'r';
	}
	
	$image = esc_url_raw( $atts['image'] );
	$type  = esc_attr( $atts['type'] );
	$name  = esc_html( $atts['name'] );
	$alt   = esc_attr( $atts['alt'] );
	if ( $name ) {
			$name = '<p class="bl_speechBalloon_authorName">' . $name . '</p>';
	}

	$content = wp_filter_post_kses( $content );
	if ( has_filter( 'the_content', 'wpautop' ) ) {
			
			$content = wpautop( $content );
	} else {
			$content = nl2br( $content );
	}

	$html = <<<EOD
<div class="bl_speechBalloon bl_speechBalloon_type_${type}">
	<figure class="bl_speechBalloon_authorImage">
		<img src="${image}" alt="${alt}">
	</figure>			
	<div class="bl_speechBalloon_wrap">
		${name}
	 	<div class="bl_speechBalloon_authorText">
			<p>${content}</p>
		</div>
	</div>
</div>
EOD;

	return $html;
}
add_shortcode( 'ogagaku_speech_balloon', 'ogagaku_speech_balloon' );




