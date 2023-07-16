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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
  <link rel="stylesheet" href="css/sidenav.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
  <!--JS-->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="js/bootstrap-switch-button.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
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
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
</head>

<body id="page-top">
  <div id="area_buffer" class="modal fade" style="--bs-modal-width: 400px;">
    <div class="modal-dialog" style="top: 30%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fa-solid fa-fire"></i> พื้นที่เกิดเพลิงไหม้</h5>
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
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
      <ul class="navbar-nav ms-auto">
        <li id="nav_toggle_osrm" class="nav-item mx-0 mx-lg-1">
          <input id="nav_button" type="checkbox" data-toggle="switchbutton" onchange="showosrm()"
            data-onlabel="<i class='fa fa-compass'></i> ปิด" data-offlabel="<i class='fa fa-play'></i> นำทาง">
        </li>
        <li id="nav_toggle_filter" class="nav-item mx-0 mx-lg-1">
          <button class="btn font-weight-bold bg-light rounded" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter_collapse" aria-controls="filter_collapse" aria-expanded="false"
            aria-label="Toggle navigation">
            กรองการแสดงข้อมูล
            <i class="fas fa-bars fa-xl"></i>
          </button>
        </li>
      </ul>
    </div>
  </nav>

  <div class="sidenav">
    <div class="collapse filter_collapse" id="filter_collapse">
      <div class="filter_box">
        <table class="filter_form" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td>กำลังดำเนินการ</td>
            <td><input id="filter_active" type="checkbox" checked data-toggle="toggle" data-style="ios"
                data-onstyle="outline-success" data-offstyle="outline-danger">
            </td>
          </tr>
          <tr>
            <td>ปิดโครงการแล้ว</td>
            <td><input id="filter_deactive" type="checkbox" checked data-toggle="toggle" data-style="ios"
                data-onstyle="outline-success" data-offstyle="outline-danger">
            </td>
          </tr>
          </td>
          </tr>
        </table>
      </div>
    </div>
  </div>



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
      var container = L.DomUtil.create('div', 'menuOnmap d-grid gap-2', container),
        startBtn = createButton('เลือกจุดเริ่มต้น', container),
        destBtn = createButton2('เลือกจุดหมาย', container),
        nearest_fs = createButton5('ดับเพลิงที่ใกล้ที่สุด', container),
        eva_area = createButton6('สร้างโครงการจุดนี้', container);

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
      var btn = L.DomUtil.create('button', 'btn btn-outline-primary btn-sm', container);
      btn.setAttribute('type', 'button');
      btn.innerHTML = label;
      return btn;
    }

    function createButton2(label, container) {
      var btn = L.DomUtil.create('button', 'btn btn-outline-success btn-sm', container);
      btn.setAttribute('type', 'button');
      btn.innerHTML = label;
      return btn;
    }

    function createButton5(label, container) {
      var btn = L.DomUtil.create('button', 'btn btn-outline-danger btn-sm', container);
      btn.setAttribute('type', 'button');
      btn.innerHTML = label;
      return btn;
    }

    function createButton6(label, container) {
      var btn = L.DomUtil.create('button', 'btn btn-outline-secondary btn-sm', container);
      btn.setAttribute('type', 'button');
      btn.innerHTML = label;
      return btn;
    }

    /*Basemap switcher*/
    new L.basemapsSwitcher([
      {
        layer: L.tileLayer('//{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map), //DEFAULT MAP
        icon: 'assets/img/map1.png',
        name: 'Hybrid'
      },
      {
        layer: L.tileLayer('//{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        icon: 'assets/img/map2.png',
        name: 'Street'
      },
      {
        layer: L.tileLayer('//{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),
        icon: 'assets/img/map3.png',
        name: 'Satelite'
      },
    ], { position: 'topright' }).addTo(map);

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
    var fire_sta = [
      {
        label: 'สถานีดับเพลิงในเขต กทม.',
        children: [
          { label: 'สถานีดับเพลิง', layer: FireStation_geo }
        ]
      }
    ];

    var lay = L.control.layers.tree(fire_sta,
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
      get_query_list('active');
    })


    function get_query_list(point_show) {
      $.ajax({
        method: "POST",
        url: "api/get_query_list.php",
        data: { 'point_show': point_show },
        success: function (data) {
          data = JSON.parse(data);
          bind_point(data);
        }
      });
    }

    function close_proj(ID_sel) {
      map.closePopup();
      $.ajax({
        method: "POST",
        url: "api/close_proj.php",
        data: { 'id_selected': ID_sel },
        success: function (data) {
          if (data == 'completed') {
            setTimeout(function () {
              swal({
                title: "ปิดโครงการเรียบร้อยแล้ว",
                type: "success"
              }, function () {
                //func
              });
            }, 100);
            $(".status_open").remove();
            $(".status_closed").remove();
            get_query_list(active);
            get_query_list(deactive);
          }
          else if (data == 'NoID') {
            setTimeout(function () {
              swal({
                title: "ไม่พบโครงการนี้",
                type: "error"
              }, function () {
                //function
              });
            }, 100);
          }
          else {
            setTimeout(function () {
              swal({
                title: "เกิดข้อผิดพลาด",
                type: "error"
              }, function () {
                //function
              });
            }, 100);
          }
        }
      });
    }

    function open_proj(ID_sel) {
      map.closePopup();
      $.ajax({
        method: "POST",
        url: "api/open_proj.php",
        data: { 'id_selected': ID_sel },
        success: function (data) {
          if (data == 'completed') {
            setTimeout(function () {
              swal({
                title: "เปิดโครงการเรียบร้อยแล้ว",
                type: "success"
              }, function () {
                //func
              });
            }, 100);
            $(".status_open").remove();
            $(".status_closed").remove();
            get_query_list(active);
            get_query_list(deactive);
          }
          else if (data == 'NoID') {
            setTimeout(function () {
              swal({
                title: "ไม่พบโครงการนี้",
                type: "error"
              }, function () {
                //function
              });
            }, 100);
          }
          else {
            setTimeout(function () {
              swal({
                title: "เกิดข้อผิดพลาด",
                type: "error"
              }, function () {
                //function
              });
            }, 100);
          }
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
            var point_id = data[0];
            var coor_latlng = data[2];
            var coor_name = data[1];
            var created_date = data[5];
            if (data[6] == null) {
              closed_date = 'ยังไม่เสร็จสิ้น';
            }
            else {
              closed_date = data[6];
            }
            const coor_latlng_split = coor_latlng.split(",");
            const lng = parseFloat(coor_latlng_split[1]);
            const lat = parseFloat(coor_latlng_split[0]);
            var point = turf.point([lng, lat]);
            var radius = data[3];
            var buffered_area_feature = turf.buffer(point, radius, { units: 'kilometers' });
            var buffered_area_geojson = L.geoJSON(null);
            buffered_area_geojson.addData(buffered_area_feature);
            buffered_area_geojson.addTo(map);
            //buffered_area_geojson.clearLayers();
            if (data[4] == 'open') {
              var marker = new L.Marker([lat, lng], { icon: warning_pulse_open });
              marker.addTo(map);
              var proj_status_text = 'ปิดโครงการ';
              var proj_change_button = 'close_proj';
            }
            else if (data[4] == 'closed') {
              var marker = new L.Marker([lat, lng], { icon: warning_pulse_closed });
              marker.addTo(map);
              var proj_status_text = 'เปิดโครงการ';
              var proj_change_button = 'open_proj';
            }
            marker.bindPopup("<table class='table table-borderless'>\
                    <thead>\
                      <tr>\
                        <th scope='col' colspan='2' class='table-dark'><i class='fa-solid fa-map-pin'></i> พิกัดการเกิดเพลิงไหม้</th>\
                      </tr>\
                    </thead>\
                    <tbody>\
                      <tr>\
                        <th scope='row'>ชื่อจุด</th>\
                        <td>"+ coor_name + "</td>\
                      </tr>\
                      <tr>\
                        <th scope='row'>รัศมี</th>\
                        <td>"+ radius + " กม.</td>\
                      </tr>\
                      <tr>\
                        <th scope='row'>วันที่สร้าง</th>\
                        <td>"+ created_date + "</td>\
                      </tr>\
                      <tr>\
                        <th scope='row'>วันที่ปิดโครงการ</th>\
                        <td>"+ closed_date + "</td>\
                      </tr>\
                      <tr>\
                        <th scope='row' style='padding: 2px;' colspan='2'><div class='d-grid gap-2'><button type='button' class='btn btn-outline-info btn-sm'>วิเคราะห์</button></div></th>\
                      </tr>\
                      <tr>\
                        <th scope='row' style='padding: 2px;' colspan='2'><div class='d-grid gap-2'><button type='button' id='proj_button' class='btn btn-outline-secondary btn-sm' onclick='"+ proj_change_button + "(" + point_id + ")'>" + proj_status_text + "</button></div></th>\
                      </tr>\
                      <tr>\
                        <th scope='row' style='padding: 1px;'><div class='d-grid gap-2'><button type='button' class='btn btn-outline-primary btn-sm' onclick='copy_fire_coor("+ lat + "," + lng + ")'>คัดลอกพิกัด</button></div></td></th>\
                        <td style='padding: 1px;'><div class='d-grid gap-2'><button type='button' class='btn btn-outline-danger btn-sm'>ลบ</button></div></td>\
                      </tr>\
                    </tbody>\
                  </table>", { maxWidth: 400, minWidth: 300 });
            $(marker._icon).addClass('status_' + data[4]);
          }
        });
      }
    }

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

    function mobile_check() {
      var w = window.innerWidth;
      if (w <= 992) {
        document.getElementById("nav_toggle_osrm").style.display = "none";
      }
    }

    $('#filter_active').on('change', function () {
      $(".status_open").remove();
      if ($(this).is(':checked')) {
        get_query_list('active');
      }
      else {
        //func
      }
    });

    $('#filter_deactive').on('change', function () {
      $(".status_closed").remove();
      if ($(this).is(':checked')) {
        get_query_list('deactive');
      }
      else {
        //func
      }
    });

    mobile_check();
    hideosrm();
    get_query_list('active');
    get_query_list('deactive');
  </script>

</body>

</html>