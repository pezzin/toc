<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

$sql = "SELECT * from rooms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Unique ID: " . $row["unique_id"]. " - Status: " . $row["status"]. "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();


function generateRand_md5uid() {
	$better_token = md5(uniqid(rand(), true));
	$unique_code = substr($better_token, 64);
	return $unique_code;
}

// echo generateRand_md5uid();

echo "Random ID:<br />";
$c = uniqid (rand (),false);
echo $c;
echo "<br />";

?>
