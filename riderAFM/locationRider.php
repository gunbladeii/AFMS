<?php session_start();?>
<?php
    require('conn.php');
    $longitude = $_GET['longitude'];
    $latitude = $_GET['latitude'];
    
?>
<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.19.0.min.js"></script>
  </head>
  <body>
    <div class="card">
      <div id="map-canvas" style="width:100%;height:400px"></div>
    </div>

    <script>
    window.lat = <?php echo $latitude;?>;
    window.lng = <?php echo $longitude;?>;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(updatePosition);
        }
      
        return null;
    };

    function updatePosition(position) {
      if (position) {
        window.lat = <?php echo $latitude;?>;
        window.lng = <?php echo $longitude;?>;
      }
    }
    
    setInterval(function(){updatePosition(getLocation());}, 10000);
      
    function currentLocation() {
      return {lat:window.lat, lng:window.lng};
    };

    var map;
    var mark;

    var initialize = function() {
      map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:19});
      mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map});
    };

    window.initialize = initialize;

    var redraw = function(payload) {
      lat = payload.message.lat;
      lng = payload.message.lng;

      map.setCenter({lat:lat, lng:lng, alt:0});
      mark.setPosition({lat:lat, lng:lng, alt:0});
    };

    var pnChannel = "map2-channel";

    var pubnub = new PubNub({
      publishKey:   'pub-c-df6f2693-2f87-4918-95f3-983aa5c334d4',
      subscribeKey: 'sub-c-1d89a2fa-27d5-11ea-a5fd-f6d34a0dd71d'
    });

    pubnub.subscribe({channels: [pnChannel]});
    pubnub.addListener({message:redraw});

    setInterval(function() {
      pubnub.publish({channel:pnChannel, message:currentLocation()});
    }, 5000);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDloX9GMN9TNA1bTknKg8fODZPeBZistSw&callback=initialize"></script>
  </body>
</html>

