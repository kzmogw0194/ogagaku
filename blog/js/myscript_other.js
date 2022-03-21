jQuery(function(){
  var fix    = jQuery(".ly_sidebar .bl_share_wrap");             //メニューオブジェクトを格納
  var fixTop = fix.offset().top;             //メニューの縦座標を格納
  var fixspace = fixTop - 1000;
  jQuery(window).scroll(function () {             //スクロールが発生したら開始
    if(jQuery(window).scrollTop() >= fixspace) {    //スクロール時の縦座標がメニューの縦座標以上なら…
      fix.css("position","fixed");           //メニューに position:fixed 付与
      fix.css("top","80px");                    //メニューに top:0 付与
      fix.css("width","324px"); 
    } else {
      fix.css("position","");                //メニューの position を空に
      fix.css("top","");                     //メニューの top を空に
    }
  });
});

jQuery(document).ready( function(){
  jQuery('.bl_share_twitter').mouseover( function(){
    jQuery('.bl_share_title').addClass('js_share_twitter');
  });
  jQuery('.bl_share_twitter').mouseout( function(){
    jQuery('.bl_share_title').removeClass('js_share_twitter');
  });
  jQuery('.bl_share_facebook').mouseover( function(){
    jQuery('.bl_share_title').addClass('js_share_facebook');
  });
  jQuery('.bl_share_facebook').mouseout( function(){
    jQuery('.bl_share_title').removeClass('js_share_facebook');
  });
  jQuery('.bl_share_line').mouseover( function(){
    jQuery('.bl_share_title').addClass('js_share_line');
  });
  jQuery('.bl_share_line').mouseout( function(){
    jQuery('.bl_share_title').removeClass('js_share_line');
  });
  jQuery('.bl_share_mail').mouseover( function(){
    jQuery('.bl_share_title').addClass('js_share_mail');
  });
  jQuery('.bl_share_mail').mouseout( function(){
    jQuery('.bl_share_title').removeClass('js_share_mail');
  });
})

jQuery(function(){
  var headerHeight = jQuery('header').outerHeight();
  var urlHash = location.hash;
  if(urlHash) {
    jQuery('body,html').stop().scrollTop(0);
    setTimeout(function(){
        var target = jQuery(urlHash);
        var position = target.offset().top - headerHeight;
        $('body,html').stop().animate({scrollTop:position}, 500);
    }, 100);
}
  jQuery('a[href^="#"]').click(function(){
    var speed = 1000;
    var href= jQuery(this).attr("href");
    var target = jQuery(href == "#" || href == "" ? 'html' : href);
    //ヘッダーの高さを取得
    var header = jQuery('header').height();
    //ヘッダーの高さを引く
    var position = target.offset().top - header;
    jQuery("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
});