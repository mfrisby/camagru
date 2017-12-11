(function() {
	var width = 400;
	var height = 400;

	var streaming = false;
  
	var video = document.getElementById('video');
	var canvas = document.getElementById('canvas');
	var photo = document.getElementById('photo');
	var startbutton = document.getElementById('startbutton');
	var context = canvas.getContext('2d');

	var img = new Image();

	function startup() {
  
		navigator.getMedia = (
			navigator.getUserMedia ||
			navigator.webkitGetUserMedia ||
			navigator.mozGetUserMedia ||
			navigator.msGetUserMedia);
  
	  navigator.getMedia({
		  video: true,
		  audio: false
		},function(stream) {
				if (navigator.mediaDevices.getUserMedia) {
					video.mozSrcObject = stream;
				}
				else {
					var vendorURL = window.URL || window.webkitURL;
					video.src = vendorURL.createObjectURL(stream);
				}
				video.play();
		},function(err) {
		  console.log("An error occured! " + err);
		});
  
	video.addEventListener('canplay', function(ev){
		if (!streaming) {
			height = video.videoHeight / (video.videoWidth/width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			streaming = true;
		}
	}, false);
  
		startbutton.addEventListener('click', function(ev){
			takepicture();
			ev.preventDefault();
		}, false);

	  savebutton.addEventListener('click', function(ev){
			sendpicture();
		ev.preventDefault();
		}, false);
  
	function takepicture() {
		var toto = document.getElementById("tmp");
		var tr = document.createElement("tr");

	  if (width && height) {
			canvas.width = width;
			canvas.height = height;
			context.drawImage(video, 0, 0, width, height);
			img.onload = function() {
				context.drawImage(img, 2, 2);
			}
			img.src = "images/Hat.png";
			var data = canvas.toDataURL('image/png');
			tr.innerHTML += "<tr><img src=\"" + data + "\"/></tr>";
			toto.appendChild(tr);
		}
		else {
				//clearphoto();
	  }
	}

	function sendpicture() {	
		alert("coucou");
	}
	}
	window.addEventListener('load', startup, false);
	})();