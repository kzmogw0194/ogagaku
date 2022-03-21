
<?php if ( is_front_page() && is_home() ){
  //トップページリスト
  get_template_part('tmp/list-index'); 

} elseif ( is_category() ) {
  //カテゴリーリスト
  get_template_part('tmp/list-category'); 

}  
?>
