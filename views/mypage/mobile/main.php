<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap mypage">
    <section class="title02">
        <h2>내 정보</h2>
        <p><span>내 정보</span>를 확인&수정 하실 수 있습니다.</p>
    </section>
    
    <section class="myinfo">
        <figure>
            <img src="<?php echo base_url('assets/images/temp/user02.png') ?>" alt="user">
            <figcaption>
                <h2>
                    <?php echo html_escape($this->member->item('mem_userid')); ?>
                </h2>
                <p><span>"<?php echo html_escape($this->member->item('mem_nickname')); ?>" 님 안녕하세요</span></p>
                <figure>
                    <img src="<?php echo base_url('assets/images/temp/level.png') ?>" alt="user">
                    <figcaption>
                        Level <?php echo html_escape($this->member->item('mem_level')); ?>
                    </figcaption>
                </figure>
            </figcaption>
        </figure>

        <button>
            <a href="<?php echo site_url('membermodify'); ?>">
                정보수정
            </a>
        </button>
    </section>


    <section class="title">
        <table style="width:90%;">
            <tr>
                <td style="width:25%; padding:2% 0; box-sizing: border-box; " class="active">
                    <a href="<?php echo site_url('mypage'); ?>">내 정보</a>
                </td>
                <td style="width:25%; padding:2% 0; box-sizing: border-box; ">
                    <a href="<?php echo site_url('mypage/post'); ?>">나의 작성글</a>
                </td>
                <td style="width:25%; padding:2% 0; box-sizing: border-box; ">
                    <a href="<?php echo site_url('membermodify'); ?>">정보수정</a>
                </td>
                <td style="width:25%; padding:2% 0; box-sizing: border-box; ">
                   <a href="<?php echo site_url('membermodify/memberleave'); ?>">탈퇴하기</a>
                </td>
            </tr>
        </table>
    </section>
    
    <section class="myinfo_02">
        <ul>
            <li><span>이메일</span> <p><?php echo html_escape($this->member->item('mem_email')); ?></p></li>
            <li><span>닉 네 임 </span> <p><?php echo html_escape($this->member->item('mem_nickname')); ?></p></li>
            <li><span>가 입 일</span> <p><?php echo display_datetime($this->member->item('mem_register_datetime'), 'full'); ?></p></li>
            <li><span>최근 로그인</span> <p><?php echo display_datetime($this->member->item('mem_lastlogin_datetime'), 'full'); ?></p></li>
        </ul>
    </section>

    <section class="ad">
        <h4>ad</h4>
        <?php echo banner("mypage_banner_1") ?>
    </section>

</div>
