<?php
include('../config.php');
header('content-type: application/json;');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

if (isset($_GET["Reason"])) {
  $reason = $_GET["Reason"];

  switch ($reason) {
    case 'explore':
      $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ROOM_ID, ROOM_RADIUS, ROOM_LON, ROOM_LAT FROM ROOM");
      $data = array("rooms" => "");
      $result = array();


      while ($row = mysqli_fetch_assoc($req)) {
        $latlng = array((float)$row["ROOM_LAT"].",".(float)$row["ROOM_LON"]);
        $newRow = array("id" => (int)$row['ROOM_ID'], "radius" => (int)$row['ROOM_RADIUS'], "latlng" => $latlng );
        array_push($result, $newRow);
      }

      $data["rooms"] = $result;

      echo json_encode($data);
      break;
    case 'get_message':
      $room_id = $_GET['id'];
      $user_lat = $_GET['lat'];
      $user_lon = $_GET['lon'];
      $last_comment = $_GET['last'];

      $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT MESSAGE, ID FROM MESSAGES WHERE ID > ".$last);

      

      break;
    default:
      # code...
      break;
  }


}

die();
 ?>
