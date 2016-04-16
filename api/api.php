<?php
include('../config.php');
header('content-type: application/json;');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

function distanceGeoPoints ($lat1, $lng1, $lat2, $lng2) {

    $earthRadius = 3958.75;

    $dLat = deg2rad($lat2-$lat1);
    $dLng = deg2rad($lng2-$lng1);


    $a = sin($dLat/2) * sin($dLat/2) +
       cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
       sin($dLng/2) * sin($dLng/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $dist = $earthRadius * $c;

    // from miles
    $meterConversion = 1609;
    $geopointDistance = $dist * $meterConversion;

    return $geopointDistance;
}

if (isset($_GET["reason"])) {
  $reason = $_GET["reason"];

  switch ($reason) {
    case 'explore': {
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
      die();
      break;
    }
    case 'get_messages': {
      $room_id = $_GET['id'];
      $user_lat = $_GET['lat'];
      $user_lon = $_GET['lon'];

      $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ROOM_LON, ROOM_LAT, ROOM_RADIUS FROM ROOM WHERE ROOM_ID = ".$room_id);
      $row = mysqli_fetch_assoc($req);

      if (distanceGeoPoints((float)$user_lat, (float)$user_lon, (float)$row['ROOM_LAT'], (float)$row['ROOM_LON']) > (float)$row['ROOM_RADIUS']) {
          $data = array("error" => true, "messages" => "");
          $result = array(array("id" => "",  "user" => "chitchat admin", "message" => "You are out of range of this room..."));
          $data["messages"] = $result;
          echo json_encode($data);
          die();
      }

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
      die();
      break;
    }
    case 'new_message': {
        $room_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $user_lat = filter_var($_GET['lat'], FILTER_SANITIZE_NUMBER_FLOAT);
        $user_lon = filter_var($_GET['lon'], FILTER_SANITIZE_NUMBER_FLOAT);
        $message = filter_var($_GET['message'], FILTER_SANITIZE_MAGIC_QUOTES);
        $user = $_SESSION['username'];

        mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO MESSAGES (ROOM, USER, MESSAGE) VALUES ('".$room_id."','".$user."','".$message."')");

        echo json_encode(array("message" => "success"));
        die();
    }
    case 'get_rooms': {
        $user_lat = filter_var($_GET['lat'], FILTER_SANITIZE_NUMBER_FLOAT);
        $user_lon = filter_var($_GET['lon'], FILTER_SANITIZE_NUMBER_FLOAT);

        $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ROOM");
        $data = array("rooms" => "");
        $result = array();


        while ($row = mysqli_fetch_assoc($req)) {
            if (distanceGeoPoints((float)$user_lat, (float)$user_lon, (float)$row["ROOM_LAT"], (float)$row["ROOM_LON"]) < (float)$row['ROOM_RADIUS']) {
              $newRow = array("id" => (int)$row['ROOM_ID'], "name" => $row['ROOM_NAME'],"radius" => (int)$row['ROOM_RADIUS'], "latlng" => $latlng );
              array_push($result, $newRow);
            }
        }

        $data["rooms"] = $result;

        echo json_encode($data);
        die();

        $data["rooms"] = $result;

        echo json_encode($data);
        die();
    }
    default:
      echo json_encode(array("error" => "Uhh, why are you here?"));
      break;
  }
}

die();
 ?>
