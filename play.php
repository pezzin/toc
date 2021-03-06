<?php
// Start the session
session_start();

// Get values from previous page
$game_code = $_GET['game'];

// Use session variables
// $_SESSION["is_player"]

?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://unpkg.com/konva@8.3.2/konva.min.js"></script>
  <meta charset="utf-8" />
  <title>Thrones of Cubes</title>
  <link rel="stylesheet" href="toc.css">
</head>
<body>

  <div id="container"></div>

  <script>

  // Detecting browser to fix pixel issue

  // Opera 8.0+
  var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

  // Firefox 1.0+
  var isFirefox = typeof InstallTrigger !== 'undefined';

  // Safari 3.0+ "[object HTMLElementConstructor]"
  var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));

  // Internet Explorer 6-11
  var isIE = /*@cc_on!@*/false || !!document.documentMode;

  // Edge 20+
  var isEdge = !isIE && !!window.StyleMedia;

  // Chrome 1 - 79
  var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

  // Edge (based on chromium) detection
  var isEdgeChromium = isChrome && (navigator.userAgent.indexOf("Edg") != -1);

  // Blink engine detection
  var isBlink = (isChrome || isOpera) && !!window.CSS;

  var width = window.innerWidth;
  var height = window.innerHeight;
  var shadowOffset = 20;
  var tween = null;
  var blockSnapSize = 30;

  var pixelFix = 0;

  if (isChrome) {
    pixelFix = 8;
  }

  var stage = new Konva.Stage({
    container: 'container',
    width: width,
    height: height
  });

  var gridLayer = new Konva.Layer();

  // define position for map
  var mapX = stage.width() / 2 - 300;
  var mapY = stage.height() / 2 - 224 - pixelFix;

  // define colors
  var color_yellow = '#ffe115';
  var color_red = '#DE0C1C';
  var color_black = '#1c1c1c';
  var color_blue = '#34509a';
  var color_white = '#ffffff';
  var color_grey = '#7f7f7f';

  // not used by now but useful at a later stage
  var color_lightbrown = '#f3ece4';
  var color_darkbrown = '#a69480';
  var color_border = '#4a4338';

  // Setting up variables for cube positioning and distance
  var distanza = 30;
  var cube_x_p1 = (stage.width() / 2 - 300) / 2 - 100;
  var cube_y_p1 = stage.height() / 2 - 200 + 4;
  var cube_x_p2 = (stage.width() / 2 - 300) + 600 + ((stage.width() / 2 - 300) / 2) - 150;
  var cube_y_p2 = stage.height() / 2 - 200 + 4;

  var shadowRectangle = new Konva.Rect({
    x: 1,
    y: 1,
    width: blockSnapSize * 1,
    height: blockSnapSize * 1,
    fill: '#dddddd',
    opacity: 0.6,
    stroke: 'aaaaaa',
    strokeWidth: 3,
    dash: [20, 2]
  });

  function newCube(x, y, layer, stage, color) {
    let rectangle = new Konva.Rect({
      x: x,
      y: y,
      width: blockSnapSize * 1,
      height: blockSnapSize * 1,
      fill: color,
      stroke: '#ddd',
      strokeWidth: 1,
      shadowColor: 'black',
      shadowBlur: 2,
      shadowOffset: {x : 1, y : 1},
      shadowOpacity: 0.4,
      draggable: true
    });

    rectangle.on('dragstart', (e) => {
      shadowRectangle.show();
      shadowRectangle.moveToTop();
      rectangle.moveToTop();
    });

    rectangle.on('dragend', (e) => {
      rectangle.position({
        x: Math.round(rectangle.x() / blockSnapSize) * blockSnapSize,
        y: Math.round(rectangle.y() / blockSnapSize) * blockSnapSize
      });
      stage.batchDraw();
      shadowRectangle.hide();
    });

    rectangle.on('dragmove', (e) => {
      shadowRectangle.position({
        x: Math.round(rectangle.x() / blockSnapSize) * blockSnapSize,
        y: Math.round(rectangle.y() / blockSnapSize) * blockSnapSize
      });
      stage.batchDraw();
    });

    layer.add(rectangle);

  }

  var padding = blockSnapSize;

  // Use this to output something in case of need
  // console.log(width, padding, width / padding);

  /*
  for (var i = 0; i < width / padding; i++) {
  gridLayer.add(new Konva.Line({
  points: [Math.round(i * padding) + 0.5, 0, Math.round(i * padding) + 0.5, height],
  // stroke: '#ddd',
  strokeWidth: 1,
}));
}

gridLayer.add(new Konva.Line({points: [0,0,10,10]}));

for (var j = 0; j < height / padding; j++) {
gridLayer.add(new Konva.Line({
points: [0, Math.round(j * padding), width, Math.round(j * padding)],
// stroke: '#ddd',
strokeWidth: 0.5,
}));
}
*/

var layer = new Konva.Layer();

shadowRectangle.hide();

layer.add(shadowRectangle);

// newCube(blockSnapSize, blockSnapSize, layer, stage);

// Setting cubes for Player 1
newCube(cube_x_p1, cube_y_p1, layer, stage, color_yellow);
newCube(cube_x_p1 + distanza, cube_y_p1, layer, stage, color_yellow);
newCube(cube_x_p1 + distanza * 2, cube_y_p1, layer, stage, color_white);
newCube(cube_x_p1 + distanza * 3, cube_y_p1, layer, stage, color_white);
newCube(cube_x_p1 + distanza * 4, cube_y_p1, layer, stage, color_red);
newCube(cube_x_p1 + distanza * 5, cube_y_p1, layer, stage, color_red);
newCube(cube_x_p1 + distanza * 6, cube_y_p1, layer, stage, color_black);
newCube(cube_x_p1 + distanza * 7, cube_y_p1, layer, stage, color_black);
newCube(cube_x_p1 + distanza * 8, cube_y_p1, layer, stage, color_blue);
newCube(cube_x_p1 + distanza * 9, cube_y_p1, layer, stage, color_blue);
newCube(cube_x_p1 + distanza * 10, cube_y_p1, layer, stage, color_grey);
newCube(cube_x_p1 + distanza * 11, cube_y_p1, layer, stage, color_grey);

// Setting cubes for Player 2

newCube(cube_x_p2, cube_y_p1, layer, stage, color_yellow);
newCube(cube_x_p2 + distanza, cube_y_p1, layer, stage, color_yellow);
newCube(cube_x_p2 + distanza * 2, cube_y_p1, layer, stage, color_white);
newCube(cube_x_p2 + distanza * 3, cube_y_p1, layer, stage, color_white);
newCube(cube_x_p2 + distanza * 4, cube_y_p1, layer, stage, color_red);
newCube(cube_x_p2 + distanza * 5, cube_y_p1, layer, stage, color_red);
newCube(cube_x_p2 + distanza * 6, cube_y_p1, layer, stage, color_black);
newCube(cube_x_p2 + distanza * 7, cube_y_p1, layer, stage, color_black);
newCube(cube_x_p2 + distanza * 8, cube_y_p1, layer, stage, color_blue);
newCube(cube_x_p2 + distanza * 9, cube_y_p1, layer, stage, color_blue);
newCube(cube_x_p2 + distanza * 10, cube_y_p1, layer, stage, color_grey);
newCube(cube_x_p2 + distanza * 11, cube_y_p1, layer, stage, color_grey);

// add names Players
var label_p1 = new Konva.Text({
  x: stage.width() / 2 - 600,
  y: cube_y_p1 - 50,
  text: 'Player 1',
  fontSize: 30,
  fontFamily: 'Calibri',
  fill: 'green',
});

var label_p2 = new Konva.Text({
  x: stage.width() / 2 + 600,
  y: cube_y_p2 - 50,
  text: 'Player 2',
  fontSize: 30,
  fontFamily: 'Calibri',
  fill: 'green',
});

// add image using main API:
var imageObj = new Image();
imageObj.onload = function () {
  var campo = new Konva.Image({
    x: mapX,
    y: mapY,
    image: imageObj,
    width: 600,
    height: 480,
  });

  layer.add(campo);
  campo.zIndex(0);
}

imageObj.src = 'img/mappa.jpg';

layer.add(label_p1);
layer.add(label_p2);

stage.add(gridLayer);
stage.add(layer);

</script>

<?php
// Fetch names of player from DB
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

$sql = "SELECT * from rooms WHERE unique_id = '".$game_code."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$p1 = $row["player1_name"];
$p2 = $row["player2_name"];
$allow = $row["spectators"];

$conn->close();
?>

<div id="desc">
  <div>
    This is a development server for the game: <b>Throne of Cubes</b>.<br />
    Game designer: Davide Ghelfi<br />
    Web Developer: Christian Pezzin<br />
    Game ID: <?php echo $game_code; ?><br />
    Player 1 name: <?php echo $p1; ?><br />
    Player 2 name: <?php echo $p2; ?><br />
    Allow spectators: <?php echo $allow; ?><br />
    Session ID: <?php echo session_id(); ?><br />

    <?php
    /*  $_SESSION['IS_PLAYER']: <?php echo $_SESSION['IS_PLAYER']; ?><br />
    $_SESSION['P1']: <?php echo $_SESSION['P1']; ?><br />
    $_SESSION['P2']: <?php echo $_SESSION['P2']; ?><br />
    $_SESSION['ALLOW']: <?php echo $_SESSION['ALLOW']; ?><br />
    */
    ?>
    <?php
    if ((!isset($_SESSION['IS_PLAYER'])) && ($allow == "1")) {
      echo "You are not an authorized player. You are just a Spectator. Happy watching!<br />";
    } else {
      if ((!isset($_SESSION['IS_PLAYER'])) && ($allow == "0")) {
        // echo "You are not an authorized player. YOU CANNOT BE HERE!!!<br />";
        // echo "Thou shall be redirected <a href=\"error.html\">here</a>.";

        // Using header function now will break the code. Trying with some javascript instead.
        // header("Location: error.html"");
        echo "<script> location.replace(\"error.html\"); </script>";
      }
    }
    ?>
    </div>
    </div>
    </body>
    </html>
