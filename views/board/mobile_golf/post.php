<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php    $this->managelayout->add_js(base_url('plugin/zeroclipboard/ZeroClipboard.js')); ?>

<?php 
$menuName="";

$board_key_arr=explode("_",element('board_key', $view));
if(count($board_key_arr) > 1) $menu_key=$board_key_arr[0]."_".$board_key_arr[1];
else $menu_key=element('board_key', $view);
$i=0;
$curentContents="";
if (element('menu', $layout)) {
                $menu = element('menu', $layout);
                if (element(0, $menu)) {
                    foreach (element(0, $menu) as $mkey => $mval) {
                        if(strpos($mval['men_link'],$menu_key) !==false) {
                            $menuName=html_escape(element('men_name', $mval));
                            $curentContents=$i;
                        }
                        $i++;
                    }
                }
            }
            

if (element('syntax_highlighter', element('board', $view)) OR element('comment_syntax_highlighter', element('board', $view))) {
    $this->managelayout->add_css(base_url('assets/js/syntaxhighlighter/styles/shCore.css'));
    $this->managelayout->add_css(base_url('assets/js/syntaxhighlighter/styles/shThemeMidnight.css'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shCore.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushJScript.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushPhp.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushCss.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushXml.js'));
?>
    <script type="text/javascript">
    SyntaxHighlighter.config.clipboardSwf = '<?php echo base_url('assets/js/syntaxhighlighter/scripts/clipboard.swf'); ?>';
    var is_SyntaxHighlighter = true;
    SyntaxHighlighter.all();
    </script>
<?php } ?>

<?php echo element('headercontent', element('board', $view)); ?>

<div class="wrap">
    <?php echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>'); ?>
   <!--  <h3>
        <?php if (element('category', element('post', $view))) { ?>[<?php echo html_escape(element('bca_value', element('category', element('post', $view)))); ?>] <?php } ?>
        <?php echo html_escape(element('post_title', element('post', $view))); ?>
    </h3> -->
    

    <?php if (element('extra_content', $view)) {
                foreach (element('extra_content', $view) as $key => $value) { 
                        if($value['field_name'] == 'tel1') $tel1=$value['output'];
                        
                } 
              
    }
    ?>
    <section class="title">
        <h2 class="bottom_02">[<?php echo "업소정보";//$menuName ?>] <?php echo element('post_title', element('post',$view)) ?></h2>
        <table>
            <tr>
                <td style="width:25%;" class="active">
                    <a href="<?php echo element('post_url', $view); ?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu12.png')?>" alt="sub01"> 
                        업소정보
                    </a>
                </td>
                <td style="width:25%;">
                    <a href="<?php echo base_url('document/map/'.element('post_id', element('post', $view))); ?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu10.png')?>" alt="sub02">
                        위치확인
                    </a>
                </td>
                <td style="width:25%;">
                    <a href="<?php echo base_url('/board/vtn_review?post_parent='.element('post_id', element('post', $view)))?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu13.png')?>" alt="sub03">
                        업소후기
                    </a>
                </td>
                <td style="width:25%;">
                   <a href="tel:<?php echo $tel1 ?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu11.png')?>" alt="sub04">
                        전화걸기
                    </a>
                </td>
            </tr>
        </table>
    </section>
    <section class="store">
        <div class="contents-view">
            <!-- <div class="contents-view-img">
                <?php
                if (element('file_image', $view)) {
                    foreach (element('file_image', $view) as $key => $value) {
                ?>
                    <img src="<?php echo element('thumb_image_url', $value); ?>" alt="<?php echo html_escape(element('pfi_originname', $value)); ?>" title="<?php echo html_escape(element('pfi_originname', $value)); ?>" class="view_full_image" data-origin-image-url="<?php echo element('origin_image_url', $value); ?>" style="max-width:100%;" />
                <?php
                    }
                }
                ?>
            </div> -->

            <!-- 본문 내용 시작 -->
            <div id="post-content"><?php echo element('content', element('post', $view)); ?></div>
            <!-- 본문 내용 끝 -->
        </div>
    </section>
   
    <?php if ( ! element('post_del', element('post', $view)) && (element('use_post_like', element('board', $view)) OR element('use_post_dislike', element('board', $view)))) { ?>
        <div class="recommand">
            <?php if (element('use_post_like', element('board', $view))) { ?>
                <a class="good" href="javascript:;" id="btn-post-like" onClick="post_like('<?php echo element('post_id', element('post', $view)); ?>', '1', 'post-like');" title="추천하기"><span class="post-like"><?php echo number_format(element('post_like', element('post', $view))); ?></span><br /><i class="fa fa-thumbs-o-up fa-lg"></i></a>
            <?php } ?>
            <?php if (element('use_post_dislike', element('board', $view))) { ?>
                <a class="bad" href="javascript:;" id="btn-post-dislike" onClick="post_like('<?php echo element('post_id', element('post', $view)); ?>', '2', 'post-dislike');" title="비추하기"><span class="post-dislike"><?php echo number_format(element('post_dislike', element('post', $view))); ?></span><br /><i class="fa fa-thumbs-o-down fa-lg"></i></a>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="pull-right ">
        <?php if ( ! element('post_del', element('post', $view)) && element('use_scrap', element('board', $view))) { ?>
            <button type="button" class="btn btn-black" id="btn-scrap" onClick="post_scrap('<?php echo element('post_id', element('post', $view)); ?>', 'post-scrap');">스크랩 <span class="post-scrap"><?php echo element('scrap_count', element('post', $view)) ? '+' . number_format(element('scrap_count', element('post', $view))) : ''; ?></span></button>
        <?php } ?>
        <?php if ( ! element('post_del', element('post', $view)) && element('use_blame', element('board', $view)) && ( ! element('blame_blind_count', element('board', $view)) OR element('post_blame', element('post', $view)) < element('blame_blind_count', element('board', $view)))) { ?>
            <button type="button" class="btn btn-black" id="btn-blame" onClick="post_blame('<?php echo element('post_id', element('post', $view)); ?>', 'post-blame');">신고 <span class="post-blame"><?php echo element('post_blame', element('post', $view)) ? '+' . number_format(element('post_blame', element('post', $view))) : ''; ?></span></button>
        <?php } ?>

        <?php if ( ! element('post_del', element('post', $view)) && element('is_admin', $view)) { ?>
            <button type="button" class="btn btn-default btn-sm admin-manage-post"><i class="fa fa-cog big-fa"></i>관리</button>
            <div class="btn-admin-manage-layer admin-manage-post-layer">
                <?php if (element('is_admin', $view) === 'super') { ?>
                    <div class="item" onClick="post_copy('copy', '<?php echo element('post_id', element('post', $view)); ?>');"><i class="fa fa-files-o"></i> 복사하기</div>
                    <div class="item" onClick="post_copy('move', '<?php echo element('post_id', element('post', $view)); ?>');"><i class="fa fa-arrow-right"></i> 이동하기</div>
                <?php if (element('use_category', element('board', $view))) { ?>
                    <div class="item" onClick="post_change_category('<?php echo element('post_id', element('post', $view)); ?>');"><i class="fa fa-tags"></i> 카테고리변경</div>
                <?php
                    }
                }
                if (element('use_post_secret', element('board', $view))) {
                    if (element('post_secret', element('post', $view))) {
                ?>
                    <div class="item" onClick="post_action('post_secret', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="fa fa-unlock"></i> 비밀글해제</div>
                <?php } else { ?>
                    <div class="item" onClick="post_action('post_secret', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="fa fa-lock"></i> 비밀글로</div>
                <?php
                    }
                }
                if (element('use_comment', element('board', $view))) {
                    if (element('post_hide_comment', element('post', $view))) {
                    ?>
                        <div class="item" onClick="post_action('post_hide_comment', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="fa fa-comments"></i> 댓글감춤해제</div>
                    <?php } else { ?>
                        <div class="item" onClick="post_action('post_hide_comment', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="fa fa-comments"></i> 댓글감춤</div>
                    <?php } 
                }
                ?>
                <?php if (element('post_notice', element('post', $view))) { ?>
                    <div class="item" onClick="post_action('post_notice', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="fa fa-bullhorn"></i> 공지내림</div>
                <?php } else { ?>
                    <div class="item" onClick="post_action('post_notice', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="fa fa-bullhorn"></i> 공지올림</div>
                <?php } ?>
                <?php if (element('post_blame', element('post', $view)) >= element('blame_blind_count', element('board', $view))) { ?>
                    <div class="item" onClick="post_action('post_blame_blind', '<?php echo element('post_id', element('post', $view)); ?>', '0');"><i class="fa fa-exclamation-circle"></i> 블라인드해제</div>
                <?php } else { ?>
                    <div class="item" onClick="post_action('post_blame_blind', '<?php echo element('post_id', element('post', $view)); ?>', '1');"><i class="fa fa-exclamation-circle"></i> 블라인드처리</div>
                <?php } ?>
                <div class="item" onClick="post_action('post_trash', '<?php echo element('post_id', element('post', $view)); ?>', '', '이 글을 휴지통으로 이동하시겠습니까?');"><i class="fa fa-trash"></i> 휴지통으로</div>
            </div>
        <?php } ?>
    </div>

    <?php
    if (element('use_sns_button', $view)) {
        $this->managelayout->add_js(base_url('assets/js/sns.js'));
        if ($this->cbconfig->item('kakao_apikey')) {
            $this->managelayout->add_js('https://developers.kakao.com/sdk/js/kakao.min.js');
    ?>
        <script type="text/javascript">Kakao.init('<?php echo $this->cbconfig->item('kakao_apikey'); ?>');</script>
    <?php } ?>
        <div class="sns_button">
            <a href="javascript:;" onClick="sendSns('facebook', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 페이스북으로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_facebook.png" width="22" height="22" alt="이 글을 페이스북으로 퍼가기" title="이 글을 페이스북으로 퍼가기" /></a>
            <a href="javascript:;" onClick="sendSns('twitter', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 트위터로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_twitter.png" width="22" height="22" alt="이 글을 트위터로 퍼가기" title="이 글을 트위터로 퍼가기" /></a>
            <?php if ($this->cbconfig->item('kakao_apikey')) { ?>
                <a href="javascript:;" onClick="kakaolink_send('<?php echo html_escape(element('post_title', element('post', $view)));?>', '<?php echo element('short_url', $view); ?>');" title="이 글을 카카오톡으로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_kakaotalk.png" width="22" height="22" alt="이 글을 카카오톡으로 퍼가기" title="이 글을 카카오톡으로 퍼가기" /></a>
            <?php } ?>
            <a href="javascript:;" onClick="sendSns('kakaostory', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 카카오스토리로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_kakaostory.png" width="22" height="22" alt="이 글을 카카오스토리로 퍼가기" title="이 글을 카카오스토리로 퍼가기" /></a>
            <a href="javascript:;" onClick="sendSns('band', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 밴드로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_band.png" width="22" height="22" alt="이 글을 밴드로 퍼가기" title="이 글을 밴드로 퍼가기" /></a>
        </div>
    <?php } ?>

    <div class="clearfix"></div>

    
    
    <div class="border_button mt20 mb20">
        <div class="btn-group pull-left" role="group" aria-label="...">
            <?php if (element('modify_url', $view)) { ?>
                <a href="<?php echo element('modify_url', $view); ?>" class="btn btn-default btn-sm">수정</a>
            <?php } ?>
            <?php    if (element('delete_url', $view)) { ?>
                <button type="button" class="btn btn-default btn-sm btn-one-delete" data-one-delete-url="<?php echo element('delete_url', $view); ?>">삭제</button>
            <?php } ?>
                <a href="<?php echo site_url('main').'?curentContents='.$curentContents ?>" class="btn btn-default btn-sm">목록</a>
            <?php if (element('search_list_url', $view)) { ?>
                    <a href="<?php echo element('search_list_url', $view); ?>" class="btn btn-default btn-sm">검색목록</a>
            <?php } ?>
            <?php if (element('reply_url', $view)) { ?>
                <a href="<?php echo element('reply_url', $view); ?>" class="btn btn-default btn-sm">답변</a>
            <?php } ?>
            <?php if (element('prev_post', $view)) { ?>
                <a href="<?php echo element('url', element('prev_post', $view)); ?>" class="btn btn-default btn-sm">이전글</a>
            <?php } ?>
            <?php if (element('next_post', $view)) { ?>
                <a href="<?php echo element('url', element('next_post', $view)); ?>" class="btn btn-default btn-sm">다음글</a>
            <?php } ?>
        </div>
        <?php if (element('write_url', $view)) { ?>
            <div class="pull-right">
                <a href="<?php echo element('write_url', $view); ?>" class="btn btn-success btn-sm">글쓰기</a>
            </div>
        <?php } ?>
    </div>

     <?php
    if (element('use_comment', element('board', $view))) {
        if ( ! element('post_hide_comment', element('post', $view))) {
        ?>
        <section>
            <div id="viewcomment"></div>
        </section>
        <?php
            $this->load->view(element('view_skin_path', $layout) . '/comment_write');
        }
    }
    ?>
    <section class="ad">
        <h4>ad</h4>
        <?php echo banner("karaoke_post_banner_1") ?>
    </section>
</div>

<?php echo element('footercontent', element('board', $view)); ?>

<?php if (element('target_blank', element('board', $view))) { ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $("#post-content a[href^='http']").attr('target', '_blank');
});
//]]>
</script>
<?php } ?>

<script type="text/javascript">
//<![CDATA[
var client = new ZeroClipboard($('.copy_post_url'));
client.on('ready', function( readyEvent ) {
    client.on('aftercopy', function( event ) {
        alert('게시글 주소가 복사되었습니다. \'Ctrl+V\'를 눌러 붙여넣기 해주세요.');
    });
});
//]]>
</script>
<?php
if (element('highlight_keyword', $view)) {
    $this->managelayout->add_js(base_url('assets/js/jquery.highlight.js')); ?>
<script type="text/javascript">
//<![CDATA[
$('#post-content').highlight([<?php echo element('highlight_keyword', $view);?>]);
//]]>
</script>
<?php } ?>
