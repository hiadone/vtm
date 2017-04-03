$(document).ready(function(){

    //로딩시 항상 Scroll top  에 위치 
      $('html,body').animate({scrollTop : 0});
      
    //로그인 클릭시 로그인 팝업창 
      $('header ul li:first-child').click(function(){
        $('#popup_layer').css('display', 'block');
        $('.overlay').css('display', 'block');
      });

    // 로그인 팝업창 위치
      var top =$('#popup_layer').height()/2
      var left =$('.overlay').width()/2 - $('#popup_layer').width()/2 - 11
      $('#popup_layer').css('top', top);
      $('#popup_layer').css('left', left);  

    //팝업창 닫기 
      $('.close').click(function(){
      $('#popup_layer').css('display', 'none');
      $('.overlay').css('display', 'none');
      });

    //로딩후 첫번째 서브메뉴 배경색상 변경
      $('.title table tr td:first-child').css('background-color' , 'rgb(239, 208, 222)');
    
    // 서브메뉴 클릭시 배경 색상 변경 
      $('.title table tr td').click(function(){
        $('.title table tr td').css('background-color' , '#fff');
        $(this).css('background-color' , 'rgb(239, 208, 222)');
    });
    
    // 로딩시 자동차의 배경색상 지정
    $('.method table tr td:first-child ').css('background-color' , 'rgb(239, 208, 222)');
    
  // 클릭시 해당 교통매체 배경색상 변경
    $('.method table tr td').click(function(){
      $('.method table tr td').css('background-color' , '#fff');
      $(this).css('background-color' , 'rgb(239, 208, 222)');
    });

  // X 클릭시 돋보기 이미지로 변경
    $('.store table tr td img').click(function(){
      if($(this).attr('src') === "images/clear.png"){
        $(this).attr('src' , 'images/find.png');
        $('.store table tr td input').attr('value' , '');
      }
      else{
        $(this).attr('src' , 'images/clear.png');
        $('.store table tr td input').attr('value' , '내위치 · 하노이시 하노이동');
      }
    });







    });