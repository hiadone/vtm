<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<?php echo $this->managelayout->display_css(); ?>
<?php echo $this->managelayout->display_js(); ?>
</head>
<body <?php echo isset($view) ? element('body_script', $view) : ''; ?>>





    <!-- main start -->
    <div >
        <!-- 본문 시작 -->
        <?php if (isset($yield))echo $yield; ?>
        <!-- 본문 끝 -->
    </div>
    <!-- main end -->

    <!-- footer start -->
  
<?php 

//print_r(element('board_list', $view));
 ?>
<script type="text/javascript">


$(document).ready(function(){

    //지역선택하기 
    var select = $("#region");
    select.change(function(){
         //var select_name = $(this).children("option:selected").html();
         //$("header h1 span label").html(select_name);
        // $("label").css("color" , "#231b26");


    Cookies.set('region',$(this).children('option:selected').index(), { expires: 1 },cb_cookie_domain);
       // set_cookie("region", '11', 0, cb_cookie_domain);     
//       alert(js_mem_link[curnetIndex]);   
       location.href=$(this).val()+"/main?curentContents="+curnetIndex;
    });

    $("header .mainmenu ul li").click(function(){

        $('div.c').eq($(this).index()).click();        

      //  setTimeout( "reload_rg('"+js_swipe_contents[$(this).index()]+"')", 500);
    });

    // // 메인메뉴 의 높이가 자동 설정
    // var hei = $('.wrap > header .mainmenu ul').height() - 2;

    // $('.wrap > header .mainmenu ul ').css('height' , hei);

    //선택된 메인메뉴 설정 

  //  $('.wrap > header .mainmenu div').css('left' , '11.5%');

//     //로딩후 서브메뉴의 선택 설정 
//     $('.submenu li:nth-child(1)').css('background-color' , '#efd0de');

// //서브메뉴 클릭시 색상 변경
//     $('.submenu li').click(function(){
//         $('.submenu li').css('background-color' , '#fff');
//         $(this).css('background-color' , '#efd0de');
//     });

});
</script>

</body>
</html>
