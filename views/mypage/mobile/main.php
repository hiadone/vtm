<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap mypage">
    <section class="title">
        <table>
            <tr>
                <td style="width:25%;" class="active">
                    <a href="<?php echo site_url('mypage'); ?>">내 정보</a>
                </td>
                <td style="width:25%;">
                    <a href="<?php echo site_url('mypage/post'); ?>">나의 작성글</a>
                </td>
                <td style="width:25%;">
                    <a href="<?php echo site_url('membermodify'); ?>">정보수정</a>
                </td>
                <td style="width:25%;">
                   <a href="<?php echo site_url('membermodify/memberleave'); ?>">탈퇴하기</a>
                </td>
            </tr>
        </table>
    </section>
    
    <section class="title02">
        <h2>내 정보</h2>
        <p><span>내 정보</span>를 확인&수정 하실 수 있습니다.</p>
    </section>

    

    <ol class="mypagemain">
        <li>
            <span>아이디</span>
            <div class="form-text"><?php echo html_escape($this->member->item('mem_userid')); ?></div>
        </li>
        <li>
            <span>이메일 주소</span>
            <div class="form-text"><?php echo html_escape($this->member->item('mem_email')); ?></div>
        </li>
        <?php if (element('use', element('mem_username', element('memberform', $view)))) { ?>
            <li>
                <span>이름</span>
                <div class="form-text"><?php echo html_escape($this->member->item('mem_username')); ?></div>
            </li>
        <?php } ?>
        <li>
            <span>닉네임</span>
            <div class="form-text"><?php echo html_escape($this->member->item('mem_nickname')); ?></div>
        </li>
        <?php if (element('use', element('mem_homepage', element('memberform', $view)))) { ?>
            <li>
                <span>홈페이지</span>
                <div class="form-text"><?php echo $this->member->item('mem_homepage') ? html_escape($this->member->item('mem_homepage')) : '미등록'; ?></div>
            </li>
        <?php } ?>
        <?php if (element('use', element('mem_birthday', element('memberform', $view)))) { ?>
            <li>
                <span>생일</span>
                <div class="form-text"><?php echo html_escape($this->member->item('mem_birthday')); ?></div>
            </li>
        <?php } ?>
        <li>
            <span>가입일</span>
            <div class="form-text"><?php echo display_datetime($this->member->item('mem_register_datetime'), 'full'); ?></div>
        </li>
        <li>
            <span>최근 로그인</span>
            <div class="form-text"><?php echo display_datetime($this->member->item('mem_lastlogin_datetime'), 'full'); ?></div>
        </li>
        <li class="mt20">
            <span></span>
            <div class="group" style="text-align:right">
                <a href="<?php echo site_url('membermodify'); ?>" class="btn btn-default btn-sm"  title="회원정보 변경">회원정보 변경</a>
            </div>
        </li>
    </ol>
</div>
