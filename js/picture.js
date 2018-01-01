(function () {
	
	var width = 400;
	var height = 400;

	var streaming = false;

	var video = document.getElementById('video');

	//draw video in canvas with png
	var videoCanvas = document.getElementById('videoCanvas');
	var videoContext = videoCanvas.getContext('2d');

	//draw final picture in canvas
	var canvas = document.createElement("canvas");
	var context = canvas.getContext('2d');

	var path = "";
	var img = new Image();

	var hat = document.getElementById('hat');
	var fire = document.getElementById('fire');
	var beer = document.getElementById('beer');
	var hatborder = document.getElementById('trHat');
	var fireborder = document.getElementById('trFire');
	var beerborder = document.getElementById('trBeer');

	var startbutton = document.getElementById('startbutton');
	var sendbutton = document.getElementById('sendbutton');

	var buttonL = document.getElementById('buttonLeft');
	var buttonD = document.getElementById('buttonDown');
	var buttonR = document.getElementById('buttonRight');
	var buttonU = document.getElementById('buttonUp');

	var pngX = 0;
	var pngY = 0;

	function startup() {

		navigator.getMedia = (
			navigator.getUserMedia ||
			navigator.webkitGetUserMedia ||
			navigator.mozGetUserMedia ||
			navigator.msGetUserMedia);

		navigator.getMedia({
			video: true,
			audio: false
		}, function (stream) {
			if (navigator.mediaDevices.getUserMedia) {
				video.mozSrcObject = stream;
			}
			else {
				var vendorURL = window.URL || window.webkitURL;
				video.src = vendorURL.createObjectURL(stream);
			}
			video.play();
		}, function (err) {
			//do stuff
		});
	}

	video.addEventListener('canplay', function (ev) {
		if (!streaming) {
			height = video.videoHeight / (video.videoWidth / width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			videoCanvas.setAttribute('width', width);
			videoCanvas.setAttribute('height', height);
			draw_video();
			streaming = true;
		}
	}, false);

	function takepicture() {
		if (!streaming) {
			var data = videoCanvas.toDataURL('image/png');
			show_picture(data);
		}
		else {
			if (width && height) {
				canvas.width = width;
				canvas.height = height;
				context.drawImage(video, 0, 0, width, height);
				if (path != "") {
					img.onload = function () {
						context.drawImage(img, pngX, pngY);
						var data = canvas.toDataURL('image/png');
						send_cam_pic(data, path);
						show_picture(data);
					}
					img.src = path;
				}
			}
		}
	}
	function show_picture(data) {
		var table = document.getElementById("table");
		table.innerHTML += "<img src=\"" + data + "\"/></br>";
	}

	startbutton.addEventListener('click', function (ev) {
		takepicture();
		ev.preventDefault();
	}, false);

	sendbutton.addEventListener('click', function (ev) {
		var pic = new Image();
		var png = new Image();
		if (width && height) {
			canvas.width = width;
			canvas.height = height;

			videoCanvas.setAttribute('width', width);
			videoCanvas.setAttribute('height', height);

			var input = document.getElementById("filepng");
			var fReader = new FileReader();
			fReader.readAsDataURL(input.files[0]);
			fReader.onloadend = function (event) {
				pic.onload = function () {
					draw_pic(pic);
				}
				pic.src = event.target.result;
			}
		}
		ev.preventDefault();
	}, false);

	/**
	 * AJAX REQ
	 */

	function send_cam_pic(dataurl, path) {
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		};
		xmlhttp.open("POST", "functions/submitfile.php");
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlhttp.send("img=" + dataurl + "filter=" + path);
	}

	/**
	 * IMAGE PNG EVENT
	 */

	fire.addEventListener('click', function (ev) {
		if (path == "images/fire.png") {
			return;
		}
		path = "images/fire.png";
		fireborder.style.border = "1px solid black";
		hatborder.style.border = "none";
		beerborder.style.border = "none";
		startbutton.disabled = false;
		sendbutton.disabled = false;
		img.onload = function () {
			draw_png();
		}
		img.src = path;
		ev.preventDefault();
	}, false);

	hat.addEventListener('click', function (ev) {
		if (path == "images/hat.png") {
			return;
		}
		path = "images/hat.png";
		hatborder.style.border = "1px solid black";
		fireborder.style.border = "none";
		beerborder.style.border = "none";
		startbutton.disabled = false;
		sendbutton.disabled = false;
		img.onload = function () {
				draw_png();
		}
		img.src = path;
		ev.preventDefault();
	}, false);

	beer.addEventListener('click', function (ev) {
		if (path == "images/beer.png") {
			return;
		}
		path = "images/beer.png";
		beerborder.style.border = "1px solid black";
		fireborder.style.border = "none";
		hatborder.style.border = "none";
		startbutton.disabled = false;
		sendbutton.disabled = false;
			img.onload = function () {
				draw_png();
			}
			img.src = path;
		ev.preventDefault();
	}, false);

	/**
	 * MOVE PNG
	 */

	buttonD.addEventListener('click', function (ev) {
		if (pngY < height) {
			pngY += 10;
		}
		ev.preventDefault();
	}, false);

	buttonR.addEventListener('click', function (ev) {
		if (pngX < width) {
			pngX += 10;
		}
		ev.preventDefault();
	}, false);

	buttonL.addEventListener('click', function (ev) {
		if (pngX > 0) {
			pngX -= 10;
		}
		ev.preventDefault();
	}, false);

	buttonU.addEventListener('click', function (ev) {
		if (pngY > 0) {
			pngY -= 10;
		}
		ev.preventDefault();
	}, false);

	/**
	 * 
	 * VIDEO DRAW 
	 */

	function draw_video() {
		(function loop() {
			videoContext.drawImage(video, 0, 0, width, height);
			setTimeout(loop, 1000 / 30); // drawing at 30fps
		})();
	}
	function draw_pic(pic) {
		(function loop() {
			videoContext.drawImage(pic, 0, 0, width, height);
			setTimeout(loop, 1000 / 30); // drawing at 30fps
		})();
	}

	function draw_png() {
		(function loop() {
			videoContext.drawImage(img, pngX, pngY);
			setTimeout(loop, 1000 / 30); // drawing at 30fps
		})();
	}
	window.addEventListener('load', startup, false);
})();
