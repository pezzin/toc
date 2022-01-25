<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Thrones of Cubes - Create a new game</title>
  <link rel="stylesheet" href="toc.css">
</head>
<body>
  <center>
    <h1>Thrones of Cubes</h1>
    <form action="check2.php" method="GET">
      <label for="name">Your name:</label><br />
      <input type="text" id="name" name="name"><br />
      <label for="name">Allow spectators:</label><input type="checkbox" id="spectators" name="spectators" value="1"><br />
      <input class="button button_red" type="submit" value="Create game">
    </form>
  </center>
</body>
</html>
