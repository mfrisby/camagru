window.addEventListener('DOMContentLoaded', function() {

  var video = document.getElementById("video");
  var canvas = document.getElementById("canvas");
  var button = document.getElementById("takeP");

	navigator.mediaDevices.getUserMedia({video: true}, function(stream) {
		video.src = window.URL.createObjectURL(stream);
		video.play();
		button.onclick = function() {
			canvas.getContext("2d").drawImage(video, 0, 0, 400, 400, 0, 0, 400, 400);
			var img = canvas.toDataURL("image/png");
			alert("done");
		};
  }, function(err) { alert("there was an error " + err)});
});


