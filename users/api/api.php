<?php
include('../config.php');
header('Content-Type: application/json');

if (isset($_GET['Reason'])) {
  switch ($_GET['Reason']) {
    case 'explore':
      $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ROOM_ID, ROOM_RADIUS, ROOM_LON, ROOM_LAT FROM ROOM");
      $data = array('rooms' => '');
      $result = array();


      while ($row = mysqli_fetch_assoc($req)) {
        $latlng = array((float)$row['ROOM_LAT'].','.(float)$row['ROOM_LON']);
        $newRow = array('id' => (int)$row['ROOM_ID'], 'radius' => (int)$row['ROOM_RADIUS'], 'latlng' => $latlng );
        array_push($result, $newRow);
      }

      $data['rooms'] = $result;

      echo json_encode($data, JSON_PRETTY_PRINT);
      die();
      break;

    default:
      # code...
      break;
  }
  $data = array('test' => 'Hello, World!');

}

echo json_encode($data);

die();
 ?>
