<?php
// Start the session
session_start();
/*
echo "Codice:" . $_GET['code'];
echo "<br />";
echo "Nome:" . $_GET['name'];
echo "<br />";
echo "IP:" . $_SERVER['REMOTE_ADDR'];
*/

// Get value from previous form
$player1_name = $_GET['name'];
$allow_spectators = $_GET['spectators'];
if ($_GET['spectators'] != "1") {
  $allow_spectators = "0";
}

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

/* SELECT QUERY
$sql = "SELECT * from rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row$mysqli->query("SELECT id FROM mytable WHERE city = 'c7'");
while($row = $result->fetch_assoc()) {
echo "id: " . $row["id"]. " - Unique ID: " . $row["unique_id"]. " - Status: " . $row["status"]. "<br>";
}
} else {
echo "0 results";
}

$conn->close();
*/

/*
$sql_check = "SELECT id FROM rooms WHERE unique_id = '".$game_code."'";
$result = $conn->query($sql_check);

if ($result->num_rows == 0) {
  echo "<center>";
  echo "<h1>Room not found!</h1><br />";
  echo "Back to the <a href=\"index.html\">home page</a>";
  echo "</center>";
} else {
  // Write name of player 2 in DB
  $sql_update = "UPDATE rooms SET player2_name = '".$player2_name."' WHERE unique_id = '".$game_code."'";
  $conn->query($sql_update);
  // Redirect player to play page with correct code
  header("Location: play.php?game=".$game_code);
  $conn->close();
  exit();
}
*/

/* Generate random ID */
// echo "Random ID:<br />";
$c = uniqid (rand (),false);
// echo $c;
// echo "<br />";

/* Test creation of new rows in the DB */
$sql = "INSERT INTO rooms (unique_id, status, player1_name, spectators) VALUES ('".$c."', 'waiting', '".$player1_name."', '".$allow_spectators."')";

if ($conn->query($sql) === TRUE) {
  // echo "New room created successfully";
  header("Location: play.php?game=".$c);
  $conn->close();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the DB connection
$conn->close();
?>
