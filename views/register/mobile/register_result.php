<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap final">
    <div class="table-box">
        <section class="title02">
            <h2>회원가입을 축하합니다</h2>
        </section>
        <div class="msg_content mt20" style="text-align:center;height:150px" >
        <b class="text-primary"><?php echo html_escape($this->session->flashdata('nickname')); ?></b>님의 회원가입을 진심으로 축하드립니다. <br />
            <?php echo $this->session->flashdata('email_auth_message'); ?>
            
        </div>
        <p class="btn_final">
                <a href="<?php echo site_url(); ?>" class="btn btn-danger" title="<?php echo html_escape($this->cbconfig->item('site_title'));?>">홈페이지로 이동</a>
            </p>
    </div>
</div>
