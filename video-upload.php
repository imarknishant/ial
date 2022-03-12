<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
</head>

<body>
  <div style="border:2px dashed blue;" id="diver">

    <div id="video-demo-container">
      <button id="upload-button">Select MP4 Video</button>
      <input type="file" id="file-to-upload" accept="video/mp4" />
      <video id="main-video" controls>
		<source type="video/mp4">
	</video>

      <p id="yes"></p>

    </div>


  </div>
  <p id="thumbnail-container"><button onclick="showit()">Confirm</button> <button>Undo</button></p>

  <br>


  <!-- other content to choose -->
  <div style="border:2px solid green;display:none" id="other">
    <br>
    <div style="margin-left:10%;">
      <p style="font-size:160%">
        <font style="font-weight:bolder">(1)</font>Choose thumbnail</p>

      <font style="font-weight:bolder;margin-left:3%;">(a)Choose from video clip:</font><br><br>

      <div id="allfloat">

        <div style="margin-left:5%;">
          Seek to
          <select id="set-video-seconds"></select> seconds <br><br>

          <button id="get-thumbnail" href="#" style="text-decoration:none;background-color:blue;padding-left,padding-right:2%;color:white;">Create Thumbnail</button>
        </div>






        <p style="font-weight:bolder;margin-left:5%;">Thumbnail:</p>

        <img id="image" src width="200px" height="400px" style="margin-left:5%">


        

      </div>

    </div>
  </div>
  <canvas id="myCanvas" style="display:none;">
 Your browser does not support the HTML5 canvas tag.
 </canvas>
    
    <style>
    
    body {
  margin: 0;
}

#video-demo-container {
  width: 400px;
  margin: 40px auto;
}

#main-video {
  display: none;
  max-width: 400px;
}

#thumbnail-container {
  display: none;
}

#get-thumbnail {
  display: none;
}

#video-canvas {
  display: block;
}

#upload-button {
  width: 150px;
  display: block;
  margin: 20px auto;
}

#file-to-upload {
  display: none;
}
    </style>
    
    <script>
    
    var _CANVAS = document.querySelector("#myCanvas"),
  _CTX = _CANVAS.getContext("2d"),
  _VIDEO = document.querySelector("#main-video");

document.getElementById("image").src = _CANVAS.toDataURL();


function showit() {
  document.getElementById("other").style.display = 'block';

}
// Upon click this should should trigger click on the #file-to-upload file input element
// This is better than showing the not-good-looking file input element
document.querySelector("#diver").addEventListener('click', function() {
  document.querySelector("#file-to-upload").click();
});

// When user chooses a MP4 file
document.querySelector("#file-to-upload").addEventListener('change', function() {
  // Validate whether MP4
  if (['video/mp4'].indexOf(document.querySelector("#file-to-upload").files[0].type) == -1) {
    alert('Error : Only MP4 format allowed');
    return;
  }

  // Hide upload button
  document.querySelector("#upload-button").style.display = 'none';

  // Object Url as the video source
  document.querySelector("#main-video source").setAttribute('src', URL.createObjectURL(document.querySelector("#file-to-upload").files[0]));

  // Load the video and show it
  _VIDEO.load();
  _VIDEO.style.display = 'inline';

  // Load metadata of the video to get video duration and dimensions
  _VIDEO.addEventListener('loadedmetadata', function() {
    console.log(_VIDEO.duration);
    var video_duration = _VIDEO.duration,
      duration_options_html = '';

    // Set options in dropdown at 4 second interval
    for (var i = 0; i < Math.floor(video_duration); i = i + 2) {
      duration_options_html += '<option value="' + i + '">' + i + '</option>';
    }
    document.querySelector("#set-video-seconds").innerHTML = duration_options_html;

    // Show the dropdown container
    document.querySelector("#thumbnail-container").style.display = 'block';

    // Set canvas dimensions same as video dimensions
    _CANVAS.width = _VIDEO.videoWidth;
    _CANVAS.height = _VIDEO.videoHeight;
  });
});

// On changing the duration dropdown, seek the video to that duration
document.querySelector("#set-video-seconds").addEventListener('change', function() {
  _VIDEO.currentTime = document.querySelector("#set-video-seconds").value;

  // Seeking might take a few milliseconds, so disable the dropdown and hide download link

});

// Seeking video to the specified duration is complete
document.querySelector("#main-video").addEventListener('timeupdate', function() {
  // Re-enable the dropdown and show the Download link
  document.querySelector("#set-video-seconds").disabled = false;
  document.querySelector("#get-thumbnail").style.display = 'inline';
});

// On clicking the Download button set the video in the canvas and download the base-64 encoded image data
document.querySelector("#get-thumbnail").addEventListener('click', function() {

  var c = document.getElementById("myCanvas");
  var ctx = c.getContext("2d");
  ctx.drawImage(_VIDEO, 10, 10,_VIDEO.videoWidth,_VIDEO.videoHeight);
    console.log(_VIDEO);
  document.getElementById("image").src = c.toDataURL();


});
var c = document.getElementById("myCanvas");
document.querySelector("#get-thumbnail").setAttribute('href', c.toDataURL());
document.querySelector("#get-thumbnail").setAttribute('download', 'thumbnai.png');
    </script>