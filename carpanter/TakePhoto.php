<!DOCTYPE HTML5>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript"><?require("control.js");?></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--<link href="/stylesheet" rel="stylesheet" type="text/css">-->
    <title>木匠之家捐贈物資</title>
    <style type="text/css"><?require("stylesheet.css");?></style>
  </head>
  <body>
    <video id="video" width="640" height="480" autoplay></video>
    <button id="snap">Snap Photo</button>
    <canvas id="canvas" width="640" height="480"></canvas>
    <img id="screenshot" style="width:95%;" src="">
    <canvas id="screenshot-canvas">
      
    </canvas>
  </body>
  <script type="text/javascript">
    <?require("TakePhoto.js");?>
  </script>
</html>