<?php    $this->managelayout->add_js('https://maps.google.com/maps/api/js?v=3.3&key=AIzaSyC5C3WnSgg9h4otykkgKNuBI49zUsOBe9U&sensor=true&language=ko'); ?>

<?php
//설정값


$geo = element('google_map',element('extravars', $view));
$marker = element('google_map',element('extravars', $view));
$geo_arr = explode(',', $geo);
$lat = $geo_arr[0] ? $geo_arr[0] : '37.566535';
$lng = $geo_arr[1] ? $geo_arr[1] : '126.977969';
$zoom = !empty($geo_arr[2]) ? $geo_arr[2] : 14;
?>
<div class="map">
        <h2>
            [위치확인] <?php echo element('post_title', element('post',$view)) ?>
        </h2>

        <p>
          [주소] <span id="formatedAddress"></span>
        </p>
        

        <div id="map-canvas" style="width: 100%; height: 400px;margin-bottom:10px"></div>
</div>
<script type="text/javascript">
var map;
var geocoder;
var centerChangedLast;
var reverseGeocodedLast;
var currentReverseGeocodeResponse;

      function initialize()
      {
        var mapLocation = new google.maps.LatLng("<?php echo $lat; ?>", "<?php echo $lng; ?>"); // 지도에서 가운데로 위치할 위도와 경도
        var markLocation = new google.maps.LatLng("<?php echo $lat; ?>", "<?php echo $lng; ?>"); // 마커가 위치할 위도와 경도
         
        var mapOptions = {
          center: mapLocation, // 지도에서 가운데로 위치할 위도와 경도(변수)
          zoom: 18, // 지도 zoom단계
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), // id: map-canvas, body에 있는 div태그의 id와 같아야 함
            mapOptions);
        geocoder = new google.maps.Geocoder();
        var size_x = 60; // 마커로 사용할 이미지의 가로 크기
        var size_y = 60; // 마커로 사용할 이미지의 세로 크기
         
        // 마커로 사용할 이미지 주소
        var image = new google.maps.MarkerImage( 'http://www.larva.re.kr/home/img/boximage3.png',
                            new google.maps.Size(size_x, size_y),
                            '',
                            '',
                            new google.maps.Size(size_x, size_y));
         
        var marker;
        marker = new google.maps.Marker({
               position: markLocation, // 마커가 위치할 위도와 경도(변수)
               map: map,
               icon: image, // 마커로 사용할 이미지(변수)
//             info: '말풍선 안에 들어갈 내용',
               title: '<?php echo element('post_title', element('post',$view)) ?>' // 마커에 마우스 포인트를 갖다댔을 때 뜨는 타이틀
        });
         
        var content = "<?php echo element('post_title', element('post',$view)) ?>"; // 말풍선 안에 들어갈 내용
         
        // 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
        var infowindow = new google.maps.InfoWindow({ content: content});
 
        google.maps.event.addListener(marker, "click", function() {
            infowindow.open(map,marker);
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

      google.maps.event.addDomListener(window, 'load', initialize);
</script>
