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
        <h2>회원 비밀번호 변경</h2>
    </section>

    <div class="mt20">
        <?php
        echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
        echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
        echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
        echo show_alert_message(element('info', $view), '<div class="alert alert-info">', '</div>');
        $attributes = array('class' => 'form-horizontal', 'name' => 'fchangepassword', 'id' => 'fchangepassword');
        echo form_open(current_url(), $attributes);
        ?>
            <ol class="change_password">
                <li>
                    <span>아이디</span>
                    <div class="form-text"><strong><?php echo $this->member->item('mem_userid'); ?></strong></div>
                </li>
                <li>
                    <span>현재비밀번호</span>
                    <div class="group">
                        <input type="password" class="input" id="cur_password" name="cur_password" />
                    </div>
                </li>
                <li>
                    <span>새로운비밀번호</span>
                    <div class="group">
                        <input type="password" class="input" id="new_password" name="new_password" />
                    </div>
                </li>
                <li>
                    <span>재입력</span>
                    <div class="group">
                        <input type="password" class="input" id="new_password_re" name="new_password_re" />
                    </div>
                </li>
                <li style="text-align:right">
                    <button type="submit" class="btn btn-success">수정하기</button>
                </li>
            </ol>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fchangepassword').validate({
        rules: {
            cur_password : { required:true },
            new_password : { required:true, minlength:<?php echo element('password_length', $view); ?> },
            new_password_re : { required:true, minlength:<?php echo element('password_length', $view); ?>, equalTo: '#new_password' }
        }
    });
});
//]]>
</script>
