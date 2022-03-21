<?php
  if (post_password_required()) {
     return;
   }
?>

<div class="bl_commentsArea">
   <?php if (have_comments()) :?>
   <h3 class="el_heading2"><?php echo get_comments_number().' 件のコメント'; ?></h3>

   <ul class="bl_comment">
     <?php wp_list_comments(array(
       'avatar_size'=>48,
       'style'=>'ul',
       'type'=>'comment',
       'callback'=>'mytheme_comments'
      )); ?>
   </ul>
   <?php if (get_comment_pages_count() > 1) : ?>
   <ul class="bl_commentNav">
     <li class="bl_commentNav_prev"><?php previous_comments_link('＜＜ 前のコメント'); ?></li>
     <li class="bl_commentNav_next"><?php next_comments_link('次のコメント ＞＞'); ?></li>
   </ul>
   <?php endif; ?>
  <?php endif; ?>


  <?php
     $comments_args = array(
       'fields' => array(
       'author' => '<p class="bl_commentForm_author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="bl_commentForm_required">*</span>' : '' ) . '</label>' .'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"></p>',
       'email' => '<p class="bl_commentForm_email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="bl_commentForm_required">*</span>' : '' ) . '</label> ' .'<input id="email" name="email" type="email"' . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '"></p>'
     ),
     'title_reply' => 'コメントはこちらから',
     'comment_notes_before' => '<p class="bl_commentForm_notes">メールアドレスは公開されませんのでご安心ください。また、<span class="bl_commentForm_required">*</span> が付いている欄は必須項目となります。</p>',
     'label_submit' => 'コメントを送信する',
   );
   comment_form($comments_args);
  ?>

</div><!-- /.bl_commentsArea -->

