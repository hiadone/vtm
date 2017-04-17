<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap mypage">
    <section class="title">
        <table>
            <tr>
                <td style="width:25%;" >
                    <a href="<?php echo site_url('mypage'); ?>">내 정보</a>
                </td>
                <td style="width:25%;">
                    <a href="<?php echo site_url('mypage/post'); ?>">나의 작성글</a>
                </td>
                <td style="width:25%;" class="active">
                    <a href="<?php echo site_url('membermodify'); ?>" >정보수정</a>
                </td>
                <td style="width:25%;">
                   <a href="<?php echo site_url('membermodify/memberleave'); ?>">탈퇴하기</a>
                </td>
            </tr>
        </table>
    </section>

     <section class="title02">
        <h2>회원 정보 수정</h2>
    </section>

    <div class="final">
        <div class="table-box">
            <div class="table-body">
                <div class="msg_content">
                    <?php echo element('result_message', $view); ?>
                    <p class="btn_final">
                        <a href="<?php echo site_url(); ?>" class="btn btn-danger" title="<?php echo html_escape($this->cbconfig->item('site_title'));?>">홈페이지로 이동</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
