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
                <td style="width:25%;" <?php if (uri_string() === 'membermodify') { ?>class="active" <?php } ?>>
                    <a href="<?php echo site_url('membermodify'); ?>" >정보수정</a>
                </td>
                <td style="width:25%;" <?php if (uri_string() === 'membermodify/memberleave') { ?>class="active" <?php } ?> >
                   <a href="<?php echo site_url('membermodify/memberleave'); ?>">탈퇴하기</a>
                </td>
            </tr>
        </table>
    </section>

    <section class="title02">
        <h2>회원 비밀번호 확인</h2>
    </section>

    
    <?php
    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
    echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
    $attributes = array('name' => 'fconfirmpassword', 'id' => 'fconfirmpassword');
    echo form_open(current_url(), $attributes);
    ?>
        <ol class="askpassword">
            <li>
                <span>아이디</span>
                <div class="form-text"><strong><?php echo $this->member->item('mem_userid'); ?></strong></div>
            </li>
            <li>
                <span>비밀번호</span>
                <div class="group">
                    <input type="password" class="input px100" id="mem_password" name="mem_password" />
                    <button class="btn btn-primary" type="submit">확인</button>
                </div>
            </li>
            <li>
                <div>
                    <span class="fa fa-exclamation-circle"></span>
                    외부로부터 회원님의 정보를 안전하게 보호하기 위해 비밀번호를 확인하셔야 합니다.
                </div>
            </li>
        </ol>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fconfirmpassword').validate({
        rules: {
            mem_password : { required:true, minlength:4 }
        }
    });
});
//]]>
</script>
