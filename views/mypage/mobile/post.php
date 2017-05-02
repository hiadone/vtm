<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap mypage">

    <section class="title02">
        <h2>내 정보</h2>
        <p><span>내 정보</span>를 확인&수정 하실 수 있습니다.</p>
    </section>
    
    <section class="myinfo">
        <figure>
            <img src="../assets/images/temp/user02.png" alt="user">
            <figcaption>
                <h2>
                    사용자 아이디
                </h2>
                <p><span>"사용자닉네임" 님 안녕하세요</span></p>
                <figure>
                    <img src="../assets/images/temp/level.png" alt="user">
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
                <td style="width:25%; padding:2% 0; box-sizing: border-box; " >
                    <a href="<?php echo site_url('mypage'); ?>">내 정보</a>
                </td>
                <td style="width:25%; padding:2% 0; box-sizing: border-box; " class="active">
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


    <!-- <section class="title02">
        <h2>나의 작성글</h2>
        <p><span>나의 작성글</span>를 확인 하실 수 있습니다.</p>
    </section> -->

    <!-- <ul class="table-top mb10">
        <li><a href="<?php echo site_url('mypage/post'); ?>" class="btn btn-warning btn-sm" title="원글">원글</a></li>
        <li><a href="<?php echo site_url('mypage/comment'); ?>" class="btn btn-success btn-sm" title="댓글">댓글</a></li>
    </ul> -->
    <section>
        <table class="table mb20">
            <thead>
                <tr>
                    <th>번호</th>
                    <!-- <th>이미지</th> -->
                    <th>제목</th>
                    <th>날짜</th>
                    <th>댓글</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (element('list', element('data', $view))) {
                foreach (element('list', element('data', $view)) as $result) {
            ?>
                <tr>
                    <td><?php echo element('num', $result); ?></td>
                    <!-- <td style="padding:0px"><?php if (element('thumb_url', $result)) { ?><img class="media-object" src="<?php echo element('thumb_url', $result); ?>" alt="<?php echo html_escape(element('post_title', $result)); ?>" title="<?php echo html_escape(element('post_title', $result)); ?>" style="width:50px;height:40px;" /><?php } ?></td> -->
                    <td><a href="<?php echo element('post_url', $result); ?>" target="new" title="<?php echo html_escape(element('post_title', $result)); ?>"><?php echo html_escape(element('post_title', $result)); ?></a>
        
                    </td>
                    <td><?php echo display_datetime(element('post_datetime', $result), 'full'); ?></td>
                    <td><?php if (element('post_comment_count', $result)) { ?><span class="label label-success"><?php echo element('post_comment_count', $result); ?> </span><?php } ?>
        <?php if (element('post_like', $result)) { ?><span class="label label-info">+ <?php echo element('post_like', $result); ?></span><?php } ?>
        <?php if (element('post_dislike', $result)) { ?><span class="label label-danger">- <?php echo element('post_dislike', $result); ?></span><?php } ?>
                    </td>
                </tr>
            <?php
                }
            }
            if ( ! element('list', element('data', $view))) {
            ?>
                <tr>
                    <td colspan="4" class="nopost">회원님이 작성하신 글이 없습니다</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </section>
    <nav><?php echo element('paging', $view); ?></nav>
    <section class="ad">
        <h4>ad</h4>
        <a href="http://cmy.secretvt.com/gotourl/banner/12" title="후기 배너 1">
            <img src="http://cmy.secretvt.com/uploads/banner/2017/04/7c37264e5f4bd915c7ebdb7e6a8b89c4.png" class="cb_banner" id="cb_banner_12" alt="후기 배너 1" title="후기 배너 1">
            </a>    
    </section>

    
</div>
