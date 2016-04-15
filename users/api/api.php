<?php
include('../config.php');
header('content-type: application/json;');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

if (isset($_GET["reason"])) {
  $reason = $_GET["reason"];

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
    case 'get_messages':
      $room_id = $_GET['id'];
      $user_lat = $_GET['lat'];
      $user_lon = $_GET['lon'];
      $last_comment = $_GET['last'];
      $data = array("messages" => "");
      $result = array();
      $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT user, message, id FROM MESSAGES WHERE room = ".$room_id." AND ID > ".$last_comment);

      while ($row = mysqli_fetch_assoc($req)) {
          $new_row = array("id" => $row['id'],  "user" => $row['user'], "message" => $row['message']);
          array_push($result, $row);
      }

      $data["messages"] = $result;
      echo json_encode($data);
      break;
    default:
      # code...
      break;
  }


}

die();
 ?>
