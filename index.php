<html>

<head>
  <title>Fire Emergency | Gimleng.com</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  </meta>
  <!--CSS-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="css/L.switchBasemap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <link href="css/all.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/L.Control.Layers.Tree.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/leaflet-routing-machine.css" />
  <link rel="stylesheet" href="css/Control.Geocoder.css" />
  <link rel="stylesheet" href="css/bootstrap-switch-button.min.css" />
  <link rel="stylesheet" href="css/L.Control.Locate.min.css" />
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/L.Icon.Pulse.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <!--JS-->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="js/bootstrap-switch-button.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="js/L.switchBasemap.js"></script>
  <script src="https://unpkg.com/shpjs@latest/dist/shp.js"></script>
  <script src="js/L.Control.Layers.Tree.js"></script>
  <script src="js/leaflet-routing-machine.js"></script>
  <script src="js/Control.Geocoder.js"></script>
  <script src='js/turf.min.js'></script>
  <script src='js/L.Control.Locate.min.js'></script>
  <script src='js/leaflet.ajax.min.js'></script>
  <script src='js/L.Icon.Pulse.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</head>

<body id="page-top">
  <div id="area_buffer" class="modal fade" style="--bs-modal-width: 400px;">
    <div class="modal-dialog" style="top: 30%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa-solid fa-fire"></i> พื้นที่เกิดเพลิงไหม้</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form name="area_buffer_form" id="area_buffer_form" method="post">
          <table class="modal_form" border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td class="modal_font"><i class="fa-solid fa-location-crosshairs"></i> พิกัด</td>
              <td><input class="textInput modal_font" type="text" id="fire_coor" name="fire_coor" required></td>
            </tr>
            <tr>
              <td class="modal_font"><i class="fa-solid fa-signature"></i> ชื่อพิกัด</td>
              <td><input class="textInput modal_font" id="coor_name" type="text" name="coor_name" required></td>
            </tr>
            <tr>
              <td class="modal_font"><i class="fa-regular fa-circle"></i> รัศมี (กิโลเมตร)</td>
              <td><input class="textInput modal_font float" id="radius_km" type="text" name="radius_km" required></td>
            </tr>
          </table>
          <br>
          <center><button type="submit" class="btn btn-primary modal_font">บันทึก</button></center>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-bottom"
    style="padding-bottom: 1px;padding-top: 1px" id="mainNav">
    <div class="container">
      <a class="navbar-brand"><i class="fa-solid fa-fire fa-beat-fade" style="color: #e00000;"></i> Fire Emergency</a>
      <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        เมนู
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
              onclick="near_me()">ตำแหน่งปัจจุบัน</a></li>
          <li id="nav_toggle" class="nav-item mx-0 mx-lg-1" style="margin-top:7px">
            <input id="nav_button" type="checkbox" data-toggle="switchbutton" onchange="showosrm()"
              data-onlabel="<i class='fa fa-compass'></i> ปิดเมนูการนำทาง"
              data-offlabel="<i class='fa fa-play'></i> เปิดเมนูการนำทาง">
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="page-section" id="map" style=" padding-top: 0px">

    <div id="map" style="height: 100%"></div>
    <script>
      var map = L.map('map').setView([13.746268, 100.5258001], 5);

      var warning_pulse_open = L.icon.pulse({ iconSize: [10, 10], color: 'Crimson' });
      var warning_pulse_closed = L.icon.pulse({ iconSize: [10, 10], fillColor: 'DarkCyan', animate: false });

      var FireStation = [{
        "type": "FeatureCollection",
        "crs": {
          "type": "name",
          "properties": {
            "name": "EPSG:4326"
          }
        },
        "features": [
          {
            "type": "Feature",
            "id": 0,
            "geometry": {
              "type": "Point",
              "coordinates": [
                100.52467893538228,
                13.736225679363987
              ]
            },
            "properties": {
              "FID": 0,
              "name": "สถานีดับเพลิงบรร",
              "address": "เลขที่ 278/1 ซอยจุฬาลงกรณ์ 9 ถ",
              "tel": "0-2214-1043-9",
              "AMP_CODE": 1007,
              "AMP_NAME": "Parthum Wan",
              "PROV_CODE": 10,
              "PROVE_NAMT": "กรุงเทพมหานคร",
              "AMP_NAMT": "เขตปทุมวัน",
              "PROV_NAME": "Bangkok",
              "POINT_X": 100.524678935,
              "POINT_Y": 13.7362256794
            }
          },
          {
            "type": "Feature",
            "id": 1,
            "geometry": {
              "type": "Point",
              "coordinates": [
                100.5489331983391,
                13.726226935637067
              ]
            },
            "properties": {
              "FID": 1,
              "name": "สถานีดับเพลิงบ่อ",
              "address": "เลขที่ 80 ถ.พระราม 4 ซอยปลูก",
              "tel": "0-2251-1157,0-2251-1443",
              "AMP_CODE": 1007,
              "AMP_NAME": "Parthum Wan",
              "PROV_CODE": 10,
              "PROVE_NAMT": "กรุงเทพมหานคร",
              "AMP_NAMT": "เขตปทุมวัน",
              "PROV_NAME": "Bangkok",
              "POINT_X": 100.548933198,
              "POINT_Y": 13.7262269356
            }
          },
          {
            "type": "Feature",
            "id": 2,
            "geometry": {
              "type": "Point",
              "coordinates": [
                100.51740971015423,
                13.730328973490812
              ]
            },
            "properties": {
              "FID": 2,
              "name": "สถานีดับเพลิงบาง",
              "address": "เลขที่ 37 ซอยเจริญกรุง 36 ถ.เ",
              "tel": "0-2234-8847-8",
              "AMP_CODE": 1004,
              "AMP_NAME": "Bang Rak",
              "PROV_CODE": 10,
              "PROVE_NAMT": "กรุงเทพมหานคร",
              "AMP_NAMT": "เขตบางรัก",
              "PROV_NAME": "Bangkok",
              "POINT_X": 100.51740971,
              "POINT_Y": 13.730328973500001
            }
          }
        ]
      }]

      /*Current location*/
      var lc = L.control.locate({
        strings: {
          title: "ไปยังตำแหน่งปัจจุบัน"
        }
      })
        .addTo(map);

      /*Near me click event*/
      function near_me() {
        lc.start();
        document.getElementById("nav_toggle").style.visibility = "visible";
        document.getElementById("nav_toggle").style.width = 'auto';
      }

      /*Nearest fire station*/
      function nearest_fire_station(lat_start, lng_start) {
        var starting_point = turf.point([lng_start, lat_start], { "marker-color": "#0F0" });
        var nir_sta = turf.nearestPoint(starting_point, FireStation[0]);
        return [nir_sta['geometry']['coordinates'][1], nir_sta['geometry']['coordinates'][0]];
      }

      /*Routing */
      var wp_control = L.Routing.control({
        routeWhileDragging: true,
        serviceUrl: 'https://router.project-osrm.org/route/v1',
        geocoder: L.Control.Geocoder.nominatim(),
        createMarker: function (i, waypoints, n) {
          var startIcon = L.icon({
            iconUrl: 'assets/icon/car_icon.png',
            iconSize: [40, 40]
          });
          var sampahIcon = L.icon({
            iconUrl: 'assets/icon/flag_icon.png',
            iconSize: [50, 50]
          });
          var destinationIcon = L.icon({
            iconUrl: 'assets/icon/flag_icon.png',
            iconSize: [50, 50]
          });
          if (i == 0) {
            marker_icon = startIcon
          } else if (i > 0 && i < n - 1) {
            marker_icon = sampahIcon
          } else if (i == n - 1) {
            marker_icon = destinationIcon
          }
          var marker = L.marker(waypoints.latLng, {
            draggable: true,
            bounceOnAdd: false,
            bounceOnAddOptions: {
              duration: 1000,
              height: 800,
              function() {
                (bindPopup(myPopup).openOn(mymap))
              }
            },
            icon: marker_icon
          })
          return marker
        }
      }).addTo(map)

      map.on('click', function (e) {
        var container = L.DomUtil.create('div', 'menuOnmap', container),
          startBtn = createButton('เลือกจุดเริ่มต้น', container),
          destBtn = createButton2('เลือกจุดหมาย', container),
          nearest_fs = createButton5('ดับเพลิงที่ใกล้ที่สุด', container),
          eva_area = createButton6('แสดงพื้นที่เกิดเพลิงไหม้', container);

        L.DomEvent.on(startBtn, 'click', function () {
          wp_control.spliceWaypoints(0, 1, e.latlng);
          map.closePopup();
        });

        L.DomEvent.on(destBtn, 'click', function () {
          wp_control.spliceWaypoints(wp_control.getWaypoints().length - 1, 1, e.latlng);
          map.closePopup();
        });

        L.DomEvent.on(nearest_fs, 'click', function () {
          wp_control.spliceWaypoints(0, 1, e.latlng);
          wp_control.spliceWaypoints(wp_control.getWaypoints().length - 1, 1, nearest_fire_station(e.latlng.lat, e.latlng.lng));
          map.closePopup();
        });

        L.DomEvent.on(eva_area, 'click', function () {
          document.getElementById('fire_coor').value = e.latlng.lat + "," + e.latlng.lng;
          $('input.float').on('input', function () {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
          });
          $('#area_buffer').modal('show');
          map.closePopup();
        });

        if (document.getElementsByClassName("leaflet-popup-content")[0] == undefined) {
          L.popup()
            .setContent(container)
            .setLatLng(e.latlng)
            .openOn(map);
        }
      });

      /*Click on map event*/
      function createButton(label, container) {
        var btn = L.DomUtil.create('button', 'btn btn-outline-primary btn-sm btn-block', container);
        btn.setAttribute('type', 'button');
        btn.innerHTML = label;
        return btn;
      }

      function createButton2(label, container) {
        var btn = L.DomUtil.create('button', 'btn btn-outline-success btn-sm btn-block', container);
        btn.setAttribute('type', 'button');
        btn.innerHTML = label;
        return btn;
      }

      function createButton5(label, container) {
        var btn = L.DomUtil.create('button', 'btn btn-outline-danger btn-sm btn-block', container);
        btn.setAttribute('type', 'button');
        btn.innerHTML = label;
        return btn;
      }

      function createButton6(label, container) {
        var btn = L.DomUtil.create('button', 'btn btn-outline-secondary btn-sm btn-block', container);
        btn.setAttribute('type', 'button');
        btn.innerHTML = label;
        return btn;
      }

      /*Basemap switcher*/
      new L.basemapsSwitcher([
        {
          layer: L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map), //DEFAULT MAP
          icon: 'assets/img/map1.png',
          name: 'Openstreet'
        },
        {
          layer: L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
          }),
          icon: 'assets/img/map2.png',
          name: 'Stadia'
        },
        {
          layer: L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
          }),
          icon: 'assets/img/map3.png',
          name: 'OpenTopo'
        },
      ], { position: 'topright' }).addTo(map);

      function handleJson_featureRequest(data) {
        console.log(data);
      }

      var fire_Icon = new L.icon({
        iconUrl: 'assets/icon/hydrant.png',
        iconSize: [15, 18],
        iconAnchor: [16, 37],
        popupAnchor: [0, -28]
      });

      var FireStation_geo = L.geoJSON(FireStation, {
        pointToLayer: function (feature, FireStation) {
          return L.marker(FireStation, { icon: fire_Icon, title: feature.properties.name });
        }
      })

      /*Layer Control*/
      var thunderAttr = { attribution: '© OpenStreetMap contributors. Tiles courtesy of Andy Allan' }
      var transport = L.tileLayer(
        '//{s}.tile.thunderforest.com/transport/{z}/{x}/{y}.png?apikey=YOUR_API',
        thunderAttr
      );

      var cycle = L.tileLayer(
        '//{s}.tile.thunderforest.com/cycle/{z}/{x}/{y}.png?apikey=YOUR_API',
        thunderAttr
      );

      var outdoors = L.tileLayer(
        '//{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png?apikey=YOUR_API',
        thunderAttr
      );


      var baseTree = [
        {
          label: 'แผนที่ทางคมนาคม',
          children: [
            { label: 'ทางเดิน', layer: outdoors },
            { label: 'จักรยาน', layer: cycle },
            { label: 'ยานยนต์', layer: transport }
          ]
        },
      ];

      var fire_sta = [
        {
          label: 'สถานีดับเพลิงในเขต กทม.',
          children: [
            { label: 'สถานีดับเพลิง', layer: FireStation_geo }
          ]
        }
      ];

      var lay = L.control.layers.tree(baseTree, fire_sta,
        {
          namedToggle: true,
          selectorBack: false,
          closedSymbol: '&#8862; &#128204;',
          openedSymbol: '&#8863; &#127758;',
          collapsed: false,
        });


      lay.addTo(map).collapseTree().expandSelected().collapseTree(true);

      function showosrm() {
        document.getElementsByClassName("leaflet-routing-container")[0].style.width = "320";
        document.getElementsByClassName("leaflet-routing-container")[0].style.height = "100%";
        document.getElementsByClassName("leaflet-routing-geocoders")[0].style.padding = "6px";
        document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.height = "0px";
        document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.width = "0px";
        document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.opacity = "0";
        document.getElementsByClassName("leaflet-control-layers")[0].style.opacity = "0";
        document.getElementById('nav_button').attributes.onchange.nodeValue = "hideosrm()";
      }
      function hideosrm() {
        document.getElementsByClassName("leaflet-routing-container")[0].style.width = "0";
        document.getElementsByClassName("leaflet-routing-container")[0].style.height = "0";
        document.getElementsByClassName("leaflet-routing-geocoders")[0].style.padding = "0px";
        setTimeout(function () {
          document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.height = "auto";
          document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.width = "auto";
          document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.transition = "opacity 0.5s ease-in-out";
          document.getElementsByClassName("leaflet-control-layers")[0].style.transition = "opacity 0.5s ease-in-out";
          document.getElementsByClassName("leaflet-control-basemapsSwitcher")[0].style.opacity = "1";
          document.getElementsByClassName("leaflet-control-layers")[0].style.opacity = "1";
        }, 200)
        document.getElementById('nav_button').attributes.onchange.nodeValue = "showosrm()";
      }

      $('#area_buffer_form').on('submit', function (e) {
        e.preventDefault();
        $('#area_buffer').modal('hide');
        var fire_form = $("#area_buffer_form");
        var params = fire_form.serializeArray();
        var fire_formData = new FormData();
        $(params).each(function (index, element) {
          fire_formData.append(element.name, element.value);
        });
        $.ajax({
          method: "POST",
          processData: false,
          contentType: false,
          url: "api/add_fire_point.php",
          data: fire_formData,
          success: function (data) {
            setTimeout(function () {
              swal({
                title: "บันทึกพิกัดเรียบร้อย",
                type: "success"
              }, function () {
                document.getElementById("area_buffer_form").reset();
                //func
              });
            }, 100);
          }
        });
        get_query_list();
      })


      function get_query_list() {
        $.ajax({
          method: "POST",
          processData: false,
          contentType: false,
          url: "api/get_query_list.php",
          success: function (data) {
            data = JSON.parse(data);
            bind_point(data);
          }
        });
      }

      function bind_point(data) {
        for (i in data) {
          var id_list = data[i];
          $.ajax({
            method: "POST",
            url: "api/bind_point.php",
            data: { 'id_list': id_list },
            success: function (data) {
              data = JSON.parse(data);
              var coor_latlng = data[2];
              var coor_name = data[1];
              const coor_latlng_split = coor_latlng.split(",");
              const lng = parseFloat(coor_latlng_split[1]);
              const lat = parseFloat(coor_latlng_split[0]);
              var point = turf.point([lng, lat]);
              var radius = data[3];
              var buffered_area_feature = turf.buffer(point, radius, { units: 'kilometers' });
              var buffered_area_geojson = L.geoJSON(null);
              buffered_area_geojson.addData(buffered_area_feature);
              buffered_area_geojson.addTo(map);
              if (data[4] == 'open') {
                var marker = new L.Marker([lat, lng], { icon: warning_pulse_open });
                marker.addTo(map);
              }
              else if (data[4] == 'closed') {
                var marker = new L.Marker([lat, lng], { icon: warning_pulse_closed });
                marker.addTo(map);
              }
              marker.bindPopup("<table class='table table-borderless'>\
                    <thead>\
                      <tr>\
                        <th scope='col' colspan='2' class='table-dark'><i class='fa-solid fa-map-pin'></i> พิกัดการเกิดเพลิงไหม้</th>\
                      </tr>\
                    </thead>\
                    <tbody>\
                      <tr>\
                        <th scope='row'>ชื่อ</th>\
                        <td>"+ coor_name + "</td>\
                      </tr>\
                      <tr>\
                        <th scope='row'>รัศมี</th>\
                        <td>"+ radius + " กม.</td>\
                      </tr>\
                      <tr>\
                        <th scope='row' colspan='2'><div class='d-grid gap-2'><button type='button' class='btn btn-outline-info btn-sm'>วิเคราะห์</button></div></th>\
                      </tr>\
                      <tr>\
                        <th scope='row' colspan='2'><div class='d-grid gap-2'><button type='button' class='btn btn-outline-secondary btn-sm'>ปิดโครงการ</button></div></th>\
                      </tr>\
                      <tr>\
                        <th scope='row'><div class='d-grid gap-2'><button type='button' class='btn btn-secondary btn-sm' onclick='copy_fire_coor("+ lat + "," + lng + ")'>คัดลอกพิกัด</button></div></td></th>\
                        <td><div class='d-grid gap-2'><button type='button' class='btn btn-danger btn-sm'>ลบ</button></div></td>\
                      </tr>\
                    </tbody>\
                  </table>", { maxWidth: 300, minWidth: 200 });
            }
          });
        }
      }

      // $('#area_buffer_form').on('submit', function (e) {
      // e.preventDefault();
      // var coor_latlng = document.getElementById('fire_coor').value;
      // var coor_name = document.getElementById('coor_name').value;
      // const coor_latlng_split = coor_latlng.split(",");
      // const lng = parseFloat(coor_latlng_split[1])
      // const lat = parseFloat(coor_latlng_split[0])
      // var point = turf.point([lng, lat]);
      // var radius = document.getElementById('radius_km').value;
      // var buffered_area_feature = turf.buffer(point, radius, { units: 'kilometers' });
      // var buffered_area_geojson = L.geoJSON(null);
      // buffered_area_geojson.addData(buffered_area_feature);
      // buffered_area_geojson.addTo(map);

      // // save this coordinate to postgreSQL
      // $.ajax({
      //   method: "POST",
      //   cache: false,
      //   url: "api/add_fire_point.php",
      //   data: {'coor_lat': lat, 'coor_lng': lng, 'coor_name': coor_name, 'radius': radius},
      //   success: function (data) {
      //     console.log('pass');
      //   }
      // });



      //         var marker = new L.Marker([lat, lng], { icon: warning_pulse });
      //         marker.addTo(map);
      //         marker.bindPopup("<table class='table'>\
      //   <thead>\
      //     <tr>\
      //       <th scope='col' colspan='2'><i class='fa-solid fa-map-pin'></i> พิกัดการเกิดเพลิงไหม้</th>\
      //     </tr>\
      //   </thead>\
      //   <tbody>\
      //     <tr>\
      //       <th scope='row'>ชื่อ</th>\
      //       <td>"+ coor_name + "</td>\
      //     </tr>\
      //     <tr>\
      //       <th scope='row'>รัศมี</th>\
      //       <td>"+ radius + " กม.</td>\
      //     </tr>\
      //     <tr>\
      //       <th scope='row'><button type='button' class='btn btn-secondary btn-sm' onclick='copy_fire_coor("+ lat + "," + lng + ")'>คัดลอกพิกัด</button></td></th>\
      //       <td><button type='button' class='btn btn-danger btn-sm'>ลบ</button></td>\
      //     </tr>\
      //   </tbody>\
      // </table>", { maxWidth: 300, minWidth: 200 }).openPopup();
      //         marker.addTo(map);
      //         $('#area_buffer').modal('hide');
      //         document.getElementById("area_buffer_form").reset();
      //       });

      function copy_fire_coor(lat, lng) {
        var coor_str = lat.toString() + ", " + lng.toString();
        navigator.clipboard.writeText(coor_str);
        setTimeout(function () {
          swal({
            title: "คัดลอกพิกัดเรียบร้อยแล้ว",
            type: "success"
          }, function () {
            //func
          });
        }, 100);
      }
      get_query_list();
    </script>
  </section>
</body>

</html>