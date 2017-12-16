(function() {
	var width = 400;
	var height = 400;

	var streaming = false;
  
	var video = document.getElementById('video');
	var canvas = document.createElement("canvas");
	var photo = document.getElementById('photo');
	var startbutton = document.getElementById('startbutton');
	var context = canvas.getContext('2d');

	var img = new Image();
	var path = "";
	var hat = document.getElementById('hat');
	var fire = document.getElementById('fire');
	var beer = document.getElementById('beer');
	var hatborder = document.getElementById('trHat');
	var fireborder = document.getElementById('trFire');
	var beerborder = document.getElementById('trBeer');
	var tmp = document.getElementById("tmp");

	var formfile = document.getElementById('formFile');

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
	
		function takepicture() {
			if (width && height) {
				canvas.width = width;
				canvas.height = height;
				context.drawImage(video, 0, 0, width, height);
				if (path != "") {
					img.onload = function() {
						context.drawImage(img, 0, 0);
						var data = canvas.toDataURL('image/png');
						save_picture(data);
						show_picture(data)
					}
					img.src = path;
				}
			}
		}
		function show_picture(data) {
				var tr = document.createElement("tr");
				tr.innerHTML += "<img src=\"" + data + "\"/>";
				tmp.appendChild(tr);
				len--;
		}
		function save_picture(dataurl) {
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			};
			xmlhttp.open("POST","functions/submitfile.php");
			xmlhttp.setRequestHeader("Content-Type",  "application/x-www-form-urlencoded");      
			xmlhttp.send("img=" + dataurl);
		}

		startbutton.addEventListener('click', function(ev){
			takepicture();
			ev.preventDefault();
		}, false);

		fire.addEventListener('click', function(ev){
			path = "images/fire.png";
			fireborder.style.border = "1px solid white";
			hatborder.style.border = "none";
			beerborder.style.border = "none";
			startbutton.disabled = false;
			ev.preventDefault();
		}, false);

		hat.addEventListener('click', function(ev){
			path = "images/hat.png";
			hatborder.style.border = "1px solid white";
			fireborder.style.border = "none";
			beerborder.style.border = "none";
			startbutton.disabled = false;
			ev.preventDefault();
		}, false);

		beer.addEventListener('click', function(ev){
			path = "images/beer.png";
			beerborder.style.border = "1px solid white";
			fireborder.style.border = "none";
			hatborder.style.border = "none";
			startbutton.disabled = false;
			ev.preventDefault();
		}, false);
	}
	window.addEventListener('load', startup, false);
	})();
