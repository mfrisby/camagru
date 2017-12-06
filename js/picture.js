(function() {
	var width = 400;
	var height = 400;

	var streaming = false;
  
	var video = document.getElementById('video');
	var canvas = document.getElementById('canvas');
	//var photo = document.getElementById('photo');
	var startbutton = document.getElementById('startbutton');
  
	function startup() {
  
	  navigator.getMedia = ( navigator.getUserMedia ||
							 navigator.webkitGetUserMedia ||
							 navigator.mozGetUserMedia ||
							 navigator.msGetUserMedia);
  
	  navigator.getMedia({
		  video: true,
		  audio: false
		}, function(stream) {
			if (navigator.mozGetUserMedia) {
				video.mozSrcObject = stream;
		  	}
		  	else {
				var vendorURL = window.URL || window.webkitURL;
				video.src = vendorURL.createObjectURL(stream);
				video.src = vendorURL.createObjectURL("images/Hat.png");
		 	}
			video.play();
		},
		function(err) {
		  console.log("An error occured! " + err);
		} );
  
	video.addEventListener('canplay', function(ev){
		if (!streaming) {
			height = video.videoHeight / (video.videoWidth/width);
		
		if (isNaN(height)) {
			height = width / (4/3);
		}
		
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
	  
	 // clearphoto();
	}
  
/* 	function clearphoto() {
	  var context = canvas.getContext('2d');
	  context.fillStyle = "#AAA";
	  context.fillRect(0, 0, canvas.width, canvas.height);
  
	  var data = canvas.toDataURL('image/png');
	  photo.setAttribute('src', data);
	} */
  
	function takepicture() {
		var toto = document.getElementById("loul");
		var li = document.createElement("li");
	  var context = canvas.getContext('2d');
	  if (width && height) {
		canvas.width = width;
		canvas.height = height;
		context.drawImage(video, 0, 0, width, height);
	  
		var data = canvas.toDataURL('image/png');
		li.innerHTML = "<li><img src=\"" + data + "\"alt=\"\" />lol</li>";
	//	photo.setAttribute('src', data);
		toto.appendChild(li);
	  } else {
		//clearphoto();
	  }
	}

	function sendpicture() {
		
		alert("coucou");
	  }

	window.addEventListener('load', startup, false);
  })();