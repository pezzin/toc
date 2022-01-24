<!DOCTYPE html>
<html>
<head>
<title>Thrones of Cubes - Join an existing game</title>
<style media="screen">
  .button {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
  }

.button_blue {
  background-color: #34509a; /* Blue */
}

.button_red {
  background-color: #DE0C1C; /* Red */
}
.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

</style>
</head>
<body>
<center>
<h1>Thrones of Cubes</h1>
<form action="check.php" method="GET">
 <label for="code">Insert game code:</label><br>
 <input type="text" id="code" name="code"><br>
 <label for="name">Your name:</label><br>
 <input type="text" id="name" name="name">
</form>
</center>
</body>
</html>
