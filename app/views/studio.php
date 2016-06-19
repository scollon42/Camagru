<head>
	<link rel="stylesheet" href="/app/views/resources/style/studio-style.css" />
</head>
<section>
	<h3>This is your workshop !</h3>
	<hr>

	<form method="post" action='/studio/upload' enctype="multipart/form-data">
	<!-- This is the webcam block -->
		<fieldset id='webcam'>
			<legend>Take some pictures with your camera :</legend>
			<video id='video'></video>
			<canvas id='canvas'></canvas>
			<img src='https://u.o0bc.com/avatars/stock/_no-user-image.gif'id='photo' alt='photo'/>
		</fieldset>
		<br>

	<!-- This is the upload block -->
		<fieldset id='upload' style='display:none'>
			<legend>Upload a picture :</legend>
			<input type='file' name='image' id='image'/>
		</fieldset>

		<fieldset id='swag-zone'>
			<legend>Choose some swag :</legend>
			<input type='hidden' name='path' value='/public/images/swag/'/>
			<div class='swag'>
				<label for='stache'><img src='/public/images/swag/stache.png'/></label>
				<input onclick='checked' type='radio' name='swag' value='stache' id='stache'/>
			</div>
			<div class='swag'>
				<label for='joker'><img src='/public/images/swag/Illuminati.png'/></label>
				<input onclick='checked' type='radio' name='swag' value='Illuminati' id='Illuminati' />
			</div>
			<div class='swag'>
				<label for='18'><img src='/public/images/swag/18.png'/></label>
				<input onclick='checked' type='radio' name='swag' value='18' id='18' />
			</div>
			<div class='swag'>
				<label for='claw'><img src='/public/images/swag/claw.png'/></label>
				<input onclick='checked' type='radio' name='swag' value='claw' id='claw' />
			</div>
		</fieldset>
		<input type='hidden' name='user_id' value='<?= \App\App::getSession()->connected_as; ?>'/>
		<button id='start' type='submit'>Take it !</button>
	</form>
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
			
		//	This part of the code check if user have a cam
		//	and if not, allow the upload method 
		if (!navigator.getMedia) {
			var upload = document.querySelector('#upload');
			var webcam = document.querySelector('#webcam');

			upload.style.display = 'block';
			webcam.style.display = 'none';
			return ;
		}
		
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