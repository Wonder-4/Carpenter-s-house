<!DOCTYPE HTML5>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript"><?require("control.js");?></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--<link href="/stylesheet" rel="stylesheet" type="text/css">-->
    <title>木匠之家捐贈物資</title>
    <style type="text/css"><?require("stylesheet.css");?></style>
  </head><body>
<script>
      //控制按鈕的顯示方式
      $(document).ready(function(){
        $("#screenshot").hide();
        $("#screenshot-button").click(function(){
          $("#videoscreen").hide();
          $("#screenshot").show();
        });
        $("#showvid-button").click(function(){
          $("#videoscreen").show();
          $("#screenshot").hide();
        })  
      });
      //Again!按鈕的執行函數
        $("#showvid-button").click(
          function(){
            $("#screenshot-button").prop("disabled",false);
          });
      //取得css設定
      var custom_pic = document.querySelector('#custom_pic');
      var videoElement = document.querySelector('#videoscreen');
      var button = document.querySelector('#screenshot-start-stop');
      var screenshot_button = document.querySelector('#screenshot-button');
      var canvas = document.querySelector('#screenshot-canvas');
      var img = document.querySelector('#screenshot');
      var ctx = canvas.getContext('2d');
      var localMediaStream = null;
      var videoSelect = document.querySelector("select#videoSource");
      
      //設定呈現大小
      function sizeCanvas() {
          // video.onloadedmetadata not firing in Chrome so we have to hack.
          // See crbug.com/110938.
          setTimeout(function() {
            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            img.height = videoElement.offsetHeight;
            img.width = videoElement.offsetWidth;
          }, 1000);
      }

      //執行拍照的函數
      function snapshot() {
          console.log("in snapshot");
          var canvas = document.createElement('canvas');
          var ctx = canvas.getContext('2d');
          // make canvas size equal to the video source
          canvas.width = videoElement.videoWidth;
          canvas.height = videoElement.videoHeight;
          // for some reason img height is smaller than the video
          // but I think it's unrelated problem. this adjustment is
          // only for a visual aspect as the canvas data URL won't change.
          img.height = videoElement.offsetHeight;
          img.width = videoElement.offsetWidth;
          ctx.drawImage(videoElement, 0, 0);
          img.src = custom_pic.value = canvas.toDataURL('image/png');
      }

      //按下拍照鍵
      screenshot_button.addEventListener('click', function(e) {
          if (localMediaStream) {
            $(this).prop("disabled",true);
            $('#screen-stream').hide();
            $('#screenshot').show();
            snapshot();
            return;
          }
      }, false);

      //瀏覽器取得媒體方式
      navigator.getUserMedia = navigator.getUserMedia ||
        navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

      //鏡頭擷取
      function gotSources(sourceInfos) {
          for (var i = 0; i != sourceInfos.length; ++i) {
            var sourceInfo = sourceInfos[i];
            var option = document.createElement("option");
            option.value = sourceInfo.id;
            if (sourceInfo.kind === 'audio') {
            }
            else if (sourceInfo.kind === 'video') {
                option.text = sourceInfo.label || 'camera ' + (videoSelect.length + 1);
                videoSelect.appendChild(option);
            } else {
                console.log('Some other kind of source: ', sourceInfo);
            }
          }
      }

      if (typeof MediaStreamTrack === 'undefined'){
          alert('This browser does not support MediaStreamTrack.');
      } else {
          MediaStreamTrack.getSources(gotSources);
      }


      function successCallback(stream) {
          window.stream = stream; // make stream available to console
          videoElement.src = window.URL.createObjectURL(stream);
          localMediaStream = stream;
          sizeCanvas();
          videoElement.play();
      }

      //錯誤回傳
      function errorCallback(error){
          console.log("navigator.getUserMedia error: ", error);
      }

      //開始函數
      function start(){
          if (!!window.stream) {
            videoElement.src = null;
            window.stream.stop();
          }
          var videoSource = videoSelect.value;
          var constraints = {
            video: {
                optional: [{sourceId: videoSource}]
            }
          };
          navigator.getUserMedia(constraints, successCallback, errorCallback);
      }

      videoSelect.onchange = start;

      start();
    </script>

    <section class="swag text-center" id = "abc">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <h1>來拍照吧!<br><span>做出 <em>獨一無二</em> 的動作</span></h1>
                <a href="#portfolio" class="down-arrow-btn"><i class="fa fa-chevron-down"></i></a>
              </div>
            </div>
          </div>
        </section>
        <section class="portfolio text-center section-padding" id="portfolio">
          <div class="container">
            <div class="row">
              <div id="portfolioSlider">
                <h1>拍照囉～～</h1>
                <div class='select'>
                  <label for='videoSource'>Video source:&nbsp;</label>
                  <select id='videoSource'></select>
                  <!--將表格傳送至=>php Server的url-->
                        <form role="form" id="form1" action="http://linen-totality-802.appspot.com/" enctype="multipart/form-data" method="post">
                          <label for="background">請選擇您剛挑中的背景:</label>
                          <select class="selectpicker" id="background" name="background">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                          </select>
                          <!--拍照後data的存放地點-->
                          <input type="hidden" name="custom_pic" id="custom_pic">
                          <!--<input type="hidden" name="is_background" id="is_background">-->
                          <!--執行拍照-->
                          <button type="button" class="btn btn-primary" id="screenshot-button">Take!</button>
                          <input type="submit" class="btn btn-primary" value="確定" id="confirm">
                          <button type="button" class="btn btn-primary" name="showvid-button"id="showvid-button">Again!</button>
                        </form>
                </div>
                <div class="abox">
                  <p>準備好後，請記得微笑！</p>
                    <br/>
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1" id='screen'>
                        <!--螢幕的即時呈現-->
                        <video id="videoscreen" style="width:95%;" autoplay></video>
                        <img id="screen-stream" src="" alt="" />
                        <!--拍照後圖片呈現-->
                        <img id="screenshot" style="width:95%;" src="">
                        <canvas id="screenshot-canvas"></canvas>
                      </div>
                    </div>
                </div>
                <!--拍照階段結束-->
              </div>
            </div>
          </div>
        </section>
        </body></html>