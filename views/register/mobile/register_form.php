<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap02">

    <section class="title02">
            <h2>회원가입</h2>
            <p><span>*</span>는 필수입력 사항 입니다.</p>
    </section>

<section class="my_info01">
            <h4>회원가입 영역</h4>
            <table>
                <tbody><tr>
                    <td><span>*</span> 아이디</td>
                    <td>
                        <input type="text" value="3자 이상 7자 이하의 영문 과 숫자" onclick="if(this.value=='3자 이상 7자 이하의 영문 과 숫자'){this.value=''}"> 
                    </td>   
                </tr>

                <tr>
                    <td><span>*</span> 닉네임</td>
                    <td>
                        <input type="text" value="3자 이상 7자 이하의 한글 과 영문" onclick="if(this.value=='3자 이상 7자 이하의 한글 과 영문'){this.value=''}">
                    </td>   
                </tr>

                <tr>
                    <td><span>*</span> 비밀번호</td>
                    <td>
                        <input type="text" value="6자 이상 20자 이하의 영문 과 숫자" onclick="if(this.value=='6자 이상 20자 이하의 영문 과 숫자'){this.value=''}">
                    </td>   
                </tr>

                <tr>
                    <td><span>*</span> 비밀번호<br>확인</td>
                    <td>
                        <input type="text" value="비밀번호를 다시 한 번 입력" onclick="if(this.value=='비밀번호를 다시 한 번 입력'){this.value=''}">
                    </td>   
                </tr>

                <tr>
                    <td><span>*</span> 이메일</td>
                    <td>
                        <input type="text" value="이메일 주소를 입력해 주세요" style="margin-bottom:3%;" onclick="if(this.value=='이메일 주소를 입력해 주세요'){this.value=''}">
                        ※비밀번호 찾기 등에 이용되니 정확한<br>  이메일을 입력해 주세요.
                    </td>   
                </tr>
            </tbody></table>
            <button>회 원 가 입</button>
</section>
<section class="ad">
        <h4>ad</h4>
        <a href="https://dev.secretvt.com/gotourl/banner/15" title="가라오케 리스트 배너2"><img src="https://dev.secretvt.com/uploads/banner/2017/04/e1db3906bbf9b42353d10ed4c7ded3b3.png" class="cb_banner" id="cb_banner_15" alt="가라오케 리스트 배너2" title="가라오케 리스트 배너2"></a>
</section>

</div>

<?php
$this->managelayout->add_css(base_url('assets/css/datepicker3.css'));
$this->managelayout->add_js('http://dmaps.daum.net/map_js_init/postcode.v2.js');
$this->managelayout->add_js(base_url('assets/js/bootstrap-datepicker.js'));
$this->managelayout->add_js(base_url('assets/js/bootstrap-datepicker.kr.js'));
$this->managelayout->add_js(base_url('assets/js/member_register.js'));
if ($this->cbconfig->item('use_recaptcha')) {
    $this->managelayout->add_js(base_url('assets/js/recaptcha.js'));
} else {
    $this->managelayout->add_js(base_url('assets/js/captcha.js'));
}
?>

<script type="text/javascript">
//<![CDATA[
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    language: 'kr',
    autoclose: true,
    todayHighlight: true
});
$(function() {
    $('#fregisterform').validate({
        onkeyup: false,
        onclick: false,
        rules: {
            mem_userid: {required :true, minlength:3, maxlength:20, is_userid_available:true},
            mem_email: {required :true, email:true, is_email_available:true},
            mem_password: {required :true, is_password_available:true},
            mem_password_re : {required: true, equalTo : '#mem_password' },
            mem_nickname: {required :true, is_nickname_available:true}
            <?php if ($this->cbconfig->item('use_recaptcha')) { ?>
                , recaptcha : {recaptchaKey:true}
            <?php } else { ?>
                , captcha_key : {required: false, captchaKey:true}
            <?php } ?>
        },
        messages: {
            recaptcha: '',
            captcha_key: '자동등록방지용 코드가 올바르지 않습니다.'
        }
    });
});
//]]>
</script>
