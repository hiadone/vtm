<?php    $this->managelayout->add_js('https://maps.google.com/maps/api/js?v=3.3&key=AIzaSyC5C3WnSgg9h4otykkgKNuBI49zUsOBe9U&sensor=true&language=ko'); 

$menuName="";

$board_key_arr=explode("_",element('board_key', $view));
if(count($board_key_arr) > 1) $menu_key=$board_key_arr[0]."_".$board_key_arr[1];
else $menu_key=element('board_key', $view);
$i=0;
$curentContents="";
if (element('menu', $layout)) {
                $menu = element('menu', $layout);
                if (element(0, $menu)) {
                    foreach (element(0, $menu) as $mkey => $mval) {
                        if(strpos($mval['men_link'],$menu_key) !==false) {
                            $menuName=html_escape(element('men_name', $mval));
                            $curentContents=$i;
                        }
                        $i++;
                    }
                }
            }


  
 
//설정값

$tel1=element('tel1',element('extravars', $view));
$geo = element('google_map',element('extravars', $view));
$marker = element('google_map',element('extravars', $view));
$geo_arr = explode(',', $geo);
$lat = !empty($geo_arr[0]) ? $geo_arr[0] : '37.566535';
$lng = !empty($geo_arr[1]) ? $geo_arr[1] : '126.977969';
$zoom = !empty($geo_arr[2]) ? $geo_arr[2] : 14;
?>
<div class="wrap">

  <!-- title 영역 -->
    <section class="title">
      <h4>
        title
      </h4>
      <h2 class="bottom_02">[<?php echo "업소정보";//$menuName ?>] <?php echo element('post_title', element('post',$view)) ?></h2>
        <table>
            <tr>
                <td style="width:25%;">
                    <a href="<?php echo element('post_url', $view); ?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu12.png')?>" alt="sub01"> 
                        업소정보
                    </a>
                </td>
                <td style="width:25%;" class="active">
                    <a href="<?php echo base_url('document/map/'.element('post_id', element('post', $view))); ?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu10.png')?>" alt="sub02">
                        위치확인
                    </a>
                </td>
                <td style="width:25%;">
                    <a href="<?php echo base_url('/board/vtn_review?post_parent='.element('post_id', element('post', $view)))?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu13.png')?>" alt="sub03">
                        업소후기
                    </a>
                </td>
                <td style="width:25%;">
                   <a href="tel:<?php echo $tel1 ?>">
                        <img src="<?php echo base_url('assets/images/temp/submenu11.png')?>" alt="sub04">
                        전화걸기
                    </a>
                </td>
            </tr>
        </table>
    </section>
  <!-- ===== -->

  <!-- 이미지 영역 -->
    <section class="store">
      <h2>
      하노이시 하노이동 하노이구 하노이 거리 136-66번지<br/>
       내위치 로부터 <span>5km</span>
      </h2>

      <table>
        <tr>
          <td class="border">
            <input type="text" value="내위치 · 하노이시 하노이동"> 
            <img src="images/clear.png" alt="X">
          </td>
          <td rowspan="2">
            길찾기
          </td>
        </tr>
        <tr>
          <td>다낭빈펄리조트</td>
        </tr>
      </table>
    </section>
  <!-- ===== -->

  <!--method  영역 -->
    <section class="method">
      <h4>찾아가는 방법</h4>
      <table>
        <tr>
          <td>
            <figure>
              <img src="images/traffic01.png" alt="traffic01">
              <figcaption>
                자동차
              </figcaption>
            </figure>
          </td>

          <td>
            <figure>
              <img src="images/traffic02.png" alt="sub01">
              <figcaption>
                대중교통
              </figcaption>
            </figure>
          </td>
        </tr>
        </table>
      <a href="index17.html">
      <img src="images/road01.png" alt="road01">
      </a>
    </section>
  <!-- ===== -->

  <!-- 광고 배너 영역 -->
    <section class="ad">
      <h4>ad</h4>
      <a href="">
        <img src="images/ad_04.png" alt="banner01">
      </a>
    </section>
  <!-- ===== -->

</div>

<div class="map">
        <h2>
            [위치확인] <?php echo element('post_title', element('post',$view)) ?>
        </h2>

        <p>
          [주소] <span id="formatedAddress"></span>
        </p>
        
        <div id="directionsPanel"></div>
        <div id="map-canvas" style="width: 100%; height: 400px;margin-bottom:10px"></div>
</div>
<script type="text/javascript">
var map;
var geocoder;
var centerChangedLast;
var reverseGeocodedLast;
var currentReverseGeocodeResponse;
var mapstart
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();




      function initialize()
      {
        directionsDisplay = new google.maps.DirectionsRenderer();
        mapstart = new google.maps.LatLng("<?php echo $lat; ?>", "<?php echo $lng; ?>");// 지도에서 가운데로 위치할 위도와 경도
        var markLocation = new google.maps.LatLng("<?php echo $lat; ?>", "<?php echo $lng; ?>"); // 마커가 위치할 위도와 경도
         
        var mapOptions = {
          center: mapstart, // 지도에서 가운데로 위치할 위도와 경도(변수)
          zoom: 14, // 지도 zoom단계
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), // id: map-canvas, body에 있는 div태그의 id와 같아야 함
            mapOptions);
        geocoder = new google.maps.Geocoder();
        var size_x = 60; // 마커로 사용할 이미지의 가로 크기
        var size_y = 60; // 마커로 사용할 이미지의 세로 크기
         
        // 마커로 사용할 이미지 주소
        // var image = new google.maps.MarkerImage( 'http://www.larva.re.kr/home/img/boximage3.png',
        //                     new google.maps.Size(si[ze_x, size_y),
        //                     '',
        //                     '',
        //                     new google.maps.Size(size_x, size_y));
         
        var marker;
        marker = new google.maps.Marker({
               position: markLocation, // 마커가 위치할 위도와 경도(변수)
               map: map,
               //icon: image, // 마커로 사용할 이미지(변수)
//             info: '말풍선 안에 들어갈 내용',
               title: '<?php echo element('post_title', element('post',$view)) ?>' // 마커에 마우스 포인트를 갖다댔을 때 뜨는 타이틀
        });
         
        var content = "<?php echo element('post_title', element('post',$view)) ?>"; // 말풍선 안에 들어갈 내용
         
        // 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
        var infowindow = new google.maps.InfoWindow({ content: content});
        
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));

        google.maps.event.addListener(marker, "click", function() {
            infowindow.open(map,marker);
            onClickDistance()
        });
        
        centerChanged();
      }

      function centerChanged()
      {
       
        
        geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult);
        document.getElementById('formatedAddress').innerHTML = '';
        currentReverseGeocodeResponse = null;
      }

      function reverseGeocodeResult(results, status) 
      {
          currentReverseGeocodeResponse = results;
          if (status === 'OK') {
              if (results.length === 0) {
                  document.getElementById('formatedAddress').innerHTML = 'None';
              } else {
                  document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
              }
          } else {
              document.getElementById('formatedAddress').innerHTML = 'Error';
          }
      }

      function onClickDistance() {
        
        var end = document.getElementById("end").value;
        var request = {
          origin:mapstart,
          destination:end,
          travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);






      var neighborhoods = [
  {lat: 52.511, lng: 13.447},
  {lat: 52.549, lng: 13.422},
  {lat: 52.497, lng: 13.396},
  {lat: 52.517, lng: 13.394}
];

var markers = [];
var map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: {lat: 52.520, lng: 13.410}
  });
}

function drop() {
  clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
    addMarkerWithTimeout(neighborhoods[i], i * 200);
  }
}

function addMarkerWithTimeout(position, timeout) {
  window.setTimeout(function() {
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP
    }));
  }, timeout);
}

function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}
</script>