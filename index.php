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

    var FireStation = {
      "type": "FeatureCollection", "features": [
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.8294503, 16.4306817] }, "properties": { "osm_id": "381897582", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.863494, 16.4361914] }, "properties": { "osm_id": "384526847", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงบึงทุ่งสร้าง" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.829717, 16.4579018] }, "properties": { "osm_id": "389394015", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง 3" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5451843, 13.7132164] }, "properties": { "osm_id": "676798750", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.304045, 7.898065] }, "properties": { "osm_id": "683890538", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.835136, 16.4147897] }, "properties": { "osm_id": "685073592", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.8387151, 16.4190036] }, "properties": { "osm_id": "690284461", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.7585646, 16.4341651] }, "properties": { "osm_id": "731795702", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.7836345, 17.4118391] }, "properties": { "osm_id": "757650168", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0032342, 18.9031004] }, "properties": { "osm_id": "836465780", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5062212, 13.7545147] }, "properties": { "osm_id": "978630950", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5136493, 13.7148673] }, "properties": { "osm_id": "1206929521", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง ยานนาวา" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.0648927, 13.8197708] }, "properties": { "osm_id": "1207398117", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงเทศบาลนครปฐม" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.150662, 17.3649887] }, "properties": { "osm_id": "1308259680", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0499177, 18.9004289] }, "properties": { "osm_id": "1388436928", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.036904, 18.7700211] }, "properties": { "osm_id": "1413038756", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.0873467, 17.286291] }, "properties": { "osm_id": "1473038478", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงตำบลในเมือง" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.889327, 18.750476] }, "properties": { "osm_id": "1583694573", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.0017314, 13.4092937] }, "properties": { "osm_id": "1591495718", "code": 2002, "fclass": "fire_station", "name": "ฝ่ายป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.9982994, 18.7948823] }, "properties": { "osm_id": "1616068615", "code": 2002, "fclass": "fire_station", "name": "อาคารป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [101.7312312, 17.4854439] }, "properties": { "osm_id": "1653930110", "code": 2002, "fclass": "fire_station", "name": "Fire Station" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [101.004111, 15.7864901] }, "properties": { "osm_id": "1721559433", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงบึงสามพัน" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.4796222, 7.0133472] }, "properties": { "osm_id": "1775721560", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0270063, 18.8452541] }, "properties": { "osm_id": "1862615637", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5946449, 13.8714708] }, "properties": { "osm_id": "1870284737", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงและกู้ภัยบางเขน" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5793009, 13.8031083] }, "properties": { "osm_id": "1958715652", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.5744251, 17.0058147] }, "properties": { "osm_id": "2022136574", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.2138962, 19.919533] }, "properties": { "osm_id": "2053533857", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.6129655, 14.8026503] }, "properties": { "osm_id": "2066042986", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.5176524, 19.2065366] }, "properties": { "osm_id": "2125657222", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.509712, 19.3387568] }, "properties": { "osm_id": "2128238192", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.852627, 20.147703] }, "properties": { "osm_id": "2134742418", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัยเทศบา" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.1309445, 15.7124582] }, "properties": { "osm_id": "2185710209", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.9555123, 12.5679329] }, "properties": { "osm_id": "2189276216", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0433586, 18.8407471] }, "properties": { "osm_id": "2190849811", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5332412, 13.7052351] }, "properties": { "osm_id": "2196920032", "code": 2002, "fclass": "fire_station", "name": "Yannawa Fire Station" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.0862458, 14.9730145] }, "properties": { "osm_id": "2283733320", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงนครราชสีมา" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.9986975, 12.6816516] }, "properties": { "osm_id": "2498777308", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.7524308, 13.6744544] }, "properties": { "osm_id": "2505964790", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงสนามบินสุวรรณภูมิ" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5137791, 13.7249139] }, "properties": { "osm_id": "2528289410", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงบางรัก" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.5167925, 11.4011316] }, "properties": { "osm_id": "2576823001", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.8216474, 17.0147177] }, "properties": { "osm_id": "2583674183", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.6853122, 17.0237279] }, "properties": { "osm_id": "2602823048", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0005066, 19.1052491] }, "properties": { "osm_id": "2614071357", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.3628238, 17.8034925] }, "properties": { "osm_id": "2618261363", "code": 2002, "fclass": "fire_station", "name": "ศูนย์ป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.5089154, 11.2069678] }, "properties": { "osm_id": "2651969438", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.9251175, 18.7246603] }, "properties": { "osm_id": "2670849284", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [101.5188978, 6.3946355] }, "properties": { "osm_id": "2927378763", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงรือเสาะ" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.5303626, 14.0208508] }, "properties": { "osm_id": "3073582840", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0067861, 18.8152411] }, "properties": { "osm_id": "3244491831", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.7773636, 18.7890978] }, "properties": { "osm_id": "3250628996", "code": 2002, "fclass": "fire_station", "name": "Nan Municipal Fire Station" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0382944, 18.6537733] }, "properties": { "osm_id": "3274045651", "code": 2002, "fclass": "fire_station", "name": "ศูนย์อำนวยการป้องกันฝ่ายพลเรือน" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [104.8618105, 15.2011965] }, "properties": { "osm_id": "3326556481", "code": 2002, "fclass": "fire_station", "name": "Muang Warin Municipal Fire Station" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.0814979, 14.6091715] }, "properties": { "osm_id": "3329272751", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.9990786, 18.827289] }, "properties": { "osm_id": "3367703729", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0190579, 18.578783] }, "properties": { "osm_id": "3423311888", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0018996, 18.7532433] }, "properties": { "osm_id": "3428219302", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.2203979, 16.0002636] }, "properties": { "osm_id": "3549075700", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5108534, 13.7480482] }, "properties": { "osm_id": "3706025318", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.6816486, 18.6565881] }, "properties": { "osm_id": "3724085539", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.8433105, 15.3885474] }, "properties": { "osm_id": "3797602962", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.0570682, 9.522987] }, "properties": { "osm_id": "3911916699", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.940641, 9.5217421] }, "properties": { "osm_id": "4078143021", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.9740523, 12.830963] }, "properties": { "osm_id": "4213354223", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.6429285, 16.0541265] }, "properties": { "osm_id": "4257371690", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัยเทศบา" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.9836861, 16.0178332] }, "properties": { "osm_id": "4302053256", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.2661813, 16.869018] }, "properties": { "osm_id": "4306557874", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.4722536, 6.9977764] }, "properties": { "osm_id": "4367158293", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง ศรีภูวนารถ" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.9767419, 18.8971259] }, "properties": { "osm_id": "4418739800", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.2573503, 16.1082614] }, "properties": { "osm_id": "4466209243", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.7566165, 19.5512289] }, "properties": { "osm_id": "4472486777", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [97.9326824, 18.0659022] }, "properties": { "osm_id": "4512923731", "code": 2002, "fclass": "fire_station", "name": "ป้องกันและบรรเทาสาธารณภัย อบต.แม่ต" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.3915652, 18.2294945] }, "properties": { "osm_id": "4596934572", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [101.2963286, 12.7836598] }, "properties": { "osm_id": "4624077146", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.3375232, 15.3632194] }, "properties": { "osm_id": "4631495801", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.310736, 7.817278] }, "properties": { "osm_id": "4704255992", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.4591407, 17.4851556] }, "properties": { "osm_id": "4716174989", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงเทศบาลตำบลสว่างแดนดิ" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.9066468, 19.1658213] }, "properties": { "osm_id": "4730093356", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง 1 งานป้องกันและบรรเทา" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.988264, 12.393501] }, "properties": { "osm_id": "4733435849", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.9679843, 12.7832792] }, "properties": { "osm_id": "4746281682", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.259538, 16.8105934] }, "properties": { "osm_id": "4753981021", "code": 2002, "fclass": "fire_station", "name": "ีดับเพลิง พิษณุโลก" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.434511, 14.352678] }, "properties": { "osm_id": "4823508621", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.4925853, 15.2203464] }, "properties": { "osm_id": "4897127786", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.4892217, 18.2888877] }, "properties": { "osm_id": "5091043622", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.4723172, 6.9978371] }, "properties": { "osm_id": "5108675821", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.0318024, 18.7855061] }, "properties": { "osm_id": "5178195703", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.6720711, 13.5625767] }, "properties": { "osm_id": "5234740918", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.9588369, 19.2236117] }, "properties": { "osm_id": "5304591191", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.1798816, 10.4945205] }, "properties": { "osm_id": "5411866270", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.7302747, 18.8476455] }, "properties": { "osm_id": "5485685754", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.8922143, 14.3747897] }, "properties": { "osm_id": "5700717721", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิง อู่ทอง" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [104.6783624, 17.052948] }, "properties": { "osm_id": "6141846180", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [104.8608443, 15.2284317] }, "properties": { "osm_id": "6316550285", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.4926148, 14.8870346] }, "properties": { "osm_id": "6341444154", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.5555174, 11.344091] }, "properties": { "osm_id": "6353479485", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.8352378, 16.414469] }, "properties": { "osm_id": "6362382887", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.8214954, 20.3199805] }, "properties": { "osm_id": "6376938985", "code": 2002, "fclass": "fire_station", "name": "สถานีควบคุมไฟป่าดอยตุง" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.4365676, 13.8486583] }, "properties": { "osm_id": "6396177671", "code": 2002, "fclass": "fire_station", "name": "ศูนย์ป้องกันและบรรเทาสาธารณภัย เทศ" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.4712123, 13.8078305] }, "properties": { "osm_id": "6396199787", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย เทศบา" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.5997501, 14.4738135] }, "properties": { "osm_id": "6403155585", "code": 2002, "fclass": "fire_station", "name": "กาบเชิง," } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.5283456, 13.8286544] }, "properties": { "osm_id": "6432214199", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงและกู้ภัยบางซ่อน" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [101.9642708, 15.3096364] }, "properties": { "osm_id": "6504320021", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.7432853, 19.5342135] }, "properties": { "osm_id": "6631508917", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [104.8805196, 15.2603096] }, "properties": { "osm_id": "6637234691", "code": 2002, "fclass": "fire_station", "name": "สนามบินนานาชาติอุบลราชธานี" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [101.7737195, 15.2041601] }, "properties": { "osm_id": "6766747831", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.1346473, 15.4564231] }, "properties": { "osm_id": "6901703097", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.1630365, 14.732107] }, "properties": { "osm_id": "6979356157", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.2986615, 12.0559624] }, "properties": { "osm_id": "7095710077", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.324418, 12.419402] }, "properties": { "osm_id": "7118336646", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.4924118, 13.842241] }, "properties": { "osm_id": "7260021185", "code": 2002, "fclass": "fire_station", "name": "สถานีดับเพลิงสวนใหญ่ (ย่อย) เทศบาลนค" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.2832756, 20.0937981] }, "properties": { "osm_id": "7263363404", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.461387, 13.8444395] }, "properties": { "osm_id": "7265667652", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย องค์ก" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.3572864, 13.6232336] }, "properties": { "osm_id": "7270925030", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันและบรรเทาสาธารณภัย ศูนย์" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.2962841, 16.7845764] }, "properties": { "osm_id": "7639993859", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [104.0507653, 16.537409] }, "properties": { "osm_id": "7658921873", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [105.1686215, 16.0476075] }, "properties": { "osm_id": "7704755697", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.9621401, 19.5349184] }, "properties": { "osm_id": "7881207605", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [103.2615146, 16.3885196] }, "properties": { "osm_id": "8060432612", "code": 2002, "fclass": "fire_station", "name": "ศูนย์ป้องกันและบรรเทาสาธารณภัย" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.1951476, 14.8418086] }, "properties": { "osm_id": "8089901819", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันเทศบาลตำบลด่านเกวียน" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.1951631, 14.8418125] }, "properties": { "osm_id": "8089911118", "code": 2002, "fclass": "fire_station", "name": "งานป้องกันสาธารณภัด่านยตำบลเกวียน" } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [102.8901842, 17.2542947] }, "properties": { "osm_id": "8492994923", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [99.1925257, 18.7416665] }, "properties": { "osm_id": "8672761130", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [100.9706092, 13.0959788] }, "properties": { "osm_id": "9668750438", "code": 2002, "fclass": "fire_station", "name": null } },
        { "type": "Feature", "geometry": { "type": "Point", "coordinates": [98.3180693, 7.7702123] }, "properties": { "osm_id": "11000981397", "code": 2002, "fclass": "fire_station", "name": null } }
      ]
    }

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
      var nir_sta = turf.nearestPoint(starting_point, FireStation);
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

    // import geojson file
    // var fire_station_th = fetchJSON('geojson/fire_station.geojson')
    //   .then((data)=> {
    //     fire_station_th_json = data;
    //   })

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
            $(".marker_id_" + ID_sel).remove();
            get_query_list(ID_sel);
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
            $(".marker_id_" + ID_sel).remove();
            get_query_list(ID_sel);
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
              var geojson_status = 'open_area_json';
            }
            else {
              closed_date = data[6];
              var geojson_status = 'closed_area_json';
            }
            const coor_latlng_split = coor_latlng.split(",");
            const lng = parseFloat(coor_latlng_split[1]);
            const lat = parseFloat(coor_latlng_split[0]);
            var point = turf.point([lng, lat]);
            var radius = data[3];
            var buffered_area_feature = turf.buffer(point, radius, { units: 'kilometers' });
            var buffered_area_geojson = L.geoJSON(null);
            buffered_area_geojson.addData(buffered_area_feature);
            buffered_area_geojson.setStyle({ 'className': geojson_status });
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
            $(marker._icon).addClass('marker_id_' + point_id);
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
      $(".open_area_json").remove();
      $(".status_open").remove();
      if ($(this).is(':checked')) {
        get_query_list('active');
      }
      else {
        //func
      }
    });

    $('#filter_deactive').on('change', function () {
      $(".closed_area_json").remove();
      $(".status_closed").remove();
      if ($(this).is(':checked')) {
        get_query_list('deactive');
      }
      else {
        //func
      }
    });

    function fetchJSON(url) {
      return fetch(url)
        .then(function (response) {
          return response.json();
        });
    }

    mobile_check();
    hideosrm();
    get_query_list('active');
    get_query_list('deactive');
  </script>

</body>

</html>