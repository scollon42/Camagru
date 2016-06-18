<section>
	<h3>This is your workshop !</h3>
	<hr>
	<fieldset>
		<legend>Or take a new with your webcam :</legend>
		<video id='video'></video>
		<button id='start'>Take it !</button>
		<canvas id='canvas'></canvas>
		<img src='https://u.o0bc.com/avatars/stock/_no-user-image.gif'id='photo' alt='photo'/>
	</fieldset>
	<br>
	<fieldset>
		<legend>Choose some swag :</legend>
	</fieldset>
</section>

<script>

	(function() {
		var streaming 	= false;
		var video 		= document.querySelector('#video');
		var canvas 		= document.querySelector('#canvas');
		var photo 		= document.querySelector('#photo');
		var start 		= document.querySelector('#start');

		var width 		= 320;
		var height 		= 0;

		navigator.getMedia = ( 	navigator.getuserMedia || 
								navigator.webKitGetUserMedia ||
								navigator.mozGetUserMedia ||
								navigator.msGetUserMedia );
		navigator.getMedia(
			{
				video: true,
				audio: false
			},
			function(stream) {
				if (navigator.mozGetUserMedia) {
					video.mozSrcObject = stream;
				}
				else {
					var vendorURL = window.URL || window.webkitURL;
					video.src = vendorURL.createObjectURL(stream);
				}
				video.play();
			},
			function(err) {
				console.log("An error occured : " + err);
			}
		);

		video.addEventListener('canplay', function(ev) {
			if (!streaming) {
				height = video.videoHeight / (video.videoWidth / width);
				video.setAttribute('width', width);
				video.setAttribute('height', height);
				canvas.setAttribute('width', width);
				canvas.setAttribute('height', height);
				streaming = true;
			}
		}, false);

		function takepicture() {
			canvas.width = width;
			canvas.height = height;
			canvas.getContext('2d').drawImage(video, 0, 0, width, height);
			var data = canvas.toDataURL('image/png');
			photo.setAttribute('src', data);
		}

		start.addEventListener('click', function(ev) {
				takepicture();
			ev.preventDefault();
		}, false);

	})();

</script>