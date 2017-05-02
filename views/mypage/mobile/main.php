<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap mypage">
    <section class="title02">
        <h2>내 정보</h2>
        <p><span>내 정보</span>를 확인&수정 하실 수 있습니다.</p>
    </section>
    
    <section class="myinfo">
        <figure>
            <img src="assets/images/temp/user02.png" alt="user">
            <figcaption>
                <h2>
                    사용자 아이디
                </h2>
                <p><span>"사용자닉네임" 님 안녕하세요</span></p>
                <figure>
                    <img src="assets/images/temp/level.png" alt="user">
                    <figcaption>
                        Level 01
                    </figcaption>
                </figure>
            </figcaption>
        </figure>

        <button>
            <a href="http://dev.secretvt.com/membermodify">
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
            <li><span>이메일 주소</span> <p>abdcdccdc@naver.com</p></li>
            <li><span>닉 네 임 </span> <p>abdcdccdc</p></li>
            <li><span>가 입 일</span> <p>2017.00.00 00:00:00</p></li>
            <li><span>최근 로그인</span> <p>2017.00.00 00:00:00</p></li>
        </ul>
    </section>

    <section class="ad">
        <h4>ad</h4>
        <a href="http://cmy.secretvt.com/gotourl/banner/12" title="후기 배너 1">
            <img src="http://cmy.secretvt.com/uploads/banner/2017/04/7c37264e5f4bd915c7ebdb7e6a8b89c4.png" class="cb_banner" id="cb_banner_12" alt="후기 배너 1" title="후기 배너 1">
            </a>    
    </section>

</div>
