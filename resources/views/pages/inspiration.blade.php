@extends('layouts.default-layout')
@section('content')
<style>
	.navbar-header {
		background: white;
	}

	@media screen and (max-width: 991px) {
		.responsive-mobile-navbar {
			height: 100vh;
			overflow-y: scroll;
			-webkit-box-align: start;
			-ms-flex-align: start;
			align-items: flex-start;
		}
	}

	@media (min-width: 992px) {
		.navbar-collapse {
			padding-left: 15% !important;
		}

		.navbar-header-right-section {
			padding-right: 70px;
		}
	}

	.navbar-expand-lg .sidenav {
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	.navbar-toggler i {
		color: #003f77;
	}

	.navBtns {
		border: 1px solid #66CE2C;
		padding: 5px 0px;
		border-radius: 5px;
		width: 150px;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.buttonSection a:hover {
		background-color: #66CE2C;
		color: white;
	}

	.startBtn {
		background-color: #66CE2C;
		border-radius: 5px;
		padding: 5px 15px;
		border: none;
		color: white;
	}

	.stopBtn {
		background-color: #ce2c2c;
		border-radius: 5px;
		padding: 5px 15px;
		border: none;
		color: white;
	}

	.resetBtn {
		background-color: #2cb0ce;
		border-radius: 5px;
		padding: 5px 15px;
		border: none;
		color: white;
	}
</style>
@include('includes.navbar')
<section class="contentSection position-relative">
	<div class="container-fluid contentRow">
		<form action="{{route('submitInspiration')}}" id="inspirationForm" method="POST">
			@csrf
			<div class="row">
				<div class="col-12 text-center">
					<h3 class="headingTitle">Inspiration</h3>
				</div>
				<div class="col-12 mt-3">

					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui vero eaque obcaecati ab esse mollitia, reiciendis sed nihil assumenda quos. Sed magnam blanditiis laudantium enim nisi deleniti itaque molestiae quia omnis voluptatum, suscipit neque a eaque dolores reprehenderit perspiciatis doloribus veniam maxime, eum earum officiis commodi facere architecto. Illo, corporis.</p>
					<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint repellendus, aliquam ex laudantium maxime a dignissimos similique eius fuga ut ullam fugit sapiente repudiandae libero atque, cumque laborum inventore numquam eos odit perferendis. Nihil facilis porro, natus dolore eos nisi? Inventore, in? Quis facere minima magni minus molestias exercitationem vel, odio alias, ratione iste maxime repellat repudiandae dicta maiores excepturi perspiciatis molestiae totam ipsum sint dolor ipsa cumque. Numquam quibusdam aut vel maxime officiis nostrum accusamus suscipit odio, necessitatibus eum.</p>
				</div>
				<div class="col-12 mt-3">
					<h4 class="mb-0">Record Audio</h4>
					<p>Record audio to convert to text in the editor below.</p>
					<div id="controls" class="d-flex align-items-center justify-content-between">
						<div>
							<button data-class="inspiration" id="startBtn1" data-sr_no="1" data-editor_name="editor" class="startBtn">Start Recording</button>
							<button data-class="inspiration" id="stopBtn1" data-sr_no="1" class="btn-danger stopBtn" style="display: none;">Stop Recording</button>
							<button data-class="inspiration" id="resetBtn1" data-sr_no="1" class="btn-danger resetBtn" style="display: none;">Reset Text</button>
						</div>
						<div class="d-flex align-items-center">
							<i class="zmdi zmdi-circle mr-2"></i>
							<div id="timer1">00:00:00</div>
						</div>
					</div>
					<div class="mt-3">
						<div id="editor"><?php echo $book['inspiration'] ?? '' ?></div>
					</div>
					<input type="hidden" name="inspiration" id="contentInput" data-class="inspiration">
					<div class="text-right px-3 mt-3 w-100">
						<button type="submit" data-class="inspiration" id="save" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Save</button>
					</div>
				</div>
			</div>
		</form>

	</div>
	<div class="buttonSection d-flex justify-content-end align-items-center mt-5">
		<a href="{{url('/vision')}}" class="navBtns mr-2"><i class="fas fa-arrow-left mr-2"></i> Previous</a>
		<a href="{{url('/execution/con')}}" class="navBtns">Next<i class="fas fa-arrow-right ml-2"></i> </a>
	</div>
</section>
@endsection
@section('insertjavascript')
@if(session()->has('inspirationSuccess'))
<script>
	Swal.fire({
		title: 'Success',
		text: `{{ session('inspirationSuccess') }}`,
		icon: 'success',
		confirmButtonColor: "#66CE2C"
	})
</script>
@endif
@if(session()->has('nextError'))
<script>
	Swal.fire({
		title: 'Error',
		text: `{{ session('nextError') }}`,
		icon: 'error',
		confirmButtonColor: "#66CE2C"
	})
</script>
@endif
<script>
	$('.sidenav  li:nth-of-type(11)').addClass('active');
</script>
<script>
	$(document).ready(function() {
		var scrollableDiv = document.getElementById("navAccordion");
		scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
		
		$("#inspirationForm").submit(function(e) {
			e.preventDefault();
			validation = validateForm();
			if (validation) {
				var content = CKEDITOR.instances['editor'].getData();
				if (content == '') {
					Swal.fire({
						title: 'Empty Data',
						text: "Please write something in Text Editor to save!",
						icon: 'error',
						confirmButtonColor: "#66CE2C"
					})
					return;
				}
				$('#contentInput').val(content);
				$("#inspirationForm")[0].submit();
			} else {
				Swal.fire({
					title: 'Missing Fields',
					text: "Some fields are missing!",
					icon: 'error',
					confirmButtonColor: "#66CE2C"
				})
			}
		})

		function validateForm() {
			let errorCount = 0;
			$("form#inspirationForm :input").each(function() {
				let val = $(this).val();
				if (val == '' && $(this).attr('data-class') !== 'inspiration') {
					errorCount++
					$(this).css('border', '1px solid red');
				} else {
					$(this).css('border', 'none');
				}
			});
			if (errorCount > 0) {
				return false;
			}
			return true;
		}

		CKEDITOR.replace('editor', {
			height: '400px',
			removePlugins: 'elementspath'
		});

		// Script For CK Editor Speech Recignition Work 
		let recognition;
		let transcription = '';
		let startBtn = document.getElementById('startBtn');
		let stopBtn = document.getElementById('stopBtn');
		let resetBtn = document.getElementById('resetBtn');
		let editorName = 'editor';

		// create a new instance of SpeechRecognition
		if (window.SpeechRecognition || window.webkitSpeechRecognition) {
			recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
		} else {
			console.log('Speech recognition not supported');
		}

		// set recognition properties
		recognition.continuous = true;
		recognition.interimResults = true;
		recognition.lang = 'en-US';

		// handle result event
		recognition.onresult = function(event) {
			let interimTranscription = '';
			for (let i = event.resultIndex; i < event.results.length; i++) {
				let transcript = event.results[i][0].transcript;
				if (event.results[i].isFinal) {
					var editor = CKEDITOR.instances[editorName];

					// Get the current selection object
					var selection = editor.getSelection();

					// Get the current element where the cursor is blinking
					var element = selection.getStartElement();

					// Insert the text at the cursor position
					// editor.setData('', { selectionStart: element, selectionEnd: element });
					editor.insertText(transcript, element);
					// CKEDITOR.instances.transcription.insertHtml(transcript);
					//   transcription += transcript + ' ';
				}
				//    else {
				//       interimTranscription += transcript;
				//   }
			}
			//   transcriptionField.value = transcription + interimTranscription;

		};

		// handle error event
		recognition.onerror = function(event) {
			console.log('Error occurred in recognition: ' + event.error);
		};

		// handle end event
		recognition.onend = function() {
			console.log('Recognition ended');
			startBtn.style.display = 'inline-block';
			resetBtn.style.display = 'inline-block';
			stopBtn.style.display = 'none';
		};

		// add click event listener to start button
		$('.startBtn').click(function() {
			let sr_id = $(this).attr('data-sr_no');
			console.log(sr_id);
			startBtn = document.getElementById('startBtn' + sr_id);
			stopBtn = document.getElementById('stopBtn' + sr_id);
			resetBtn = document.getElementById('resetBtn' + sr_id);
			// startBtn.addEventListener('click', function() {
			editorName = startBtn.getAttribute('data-editor_name');
			startTimer(sr_id);
			$(".zmdi-circle").addClass('red');
			recognition.start();
			console.log('Recognition started');
			startBtn.style.display = 'none';
			resetBtn.style.display = 'none';
			stopBtn.style.display = 'inline-block';
		});

		// add click event listener to stop button
		$('.stopBtn').click(function() {
			let sr_id = $(this).attr('data-sr_no');
			startBtn = document.getElementById('startBtn' + sr_id);
			stopBtn = document.getElementById('stopBtn' + sr_id);
			resetBtn = document.getElementById('resetBtn' + sr_id);
			stopTimer();
			$(".zmdi-circle").removeClass('red');
			recognition.stop();
			console.log('Recognition stopped');
			startBtn.style.display = 'inline-block';
			resetBtn.style.display = 'inline-block';
			stopBtn.style.display = 'none';
		});


		// add click event listener to reset button
		$('.resetBtn').click(function() {
			let sr_id = $(this).attr('data-sr_no');
			startBtn = document.getElementById('startBtn' + sr_id);
			stopBtn = document.getElementById('stopBtn' + sr_id);
			resetBtn = document.getElementById('resetBtn' + sr_id);
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#66CE2C',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, reset it!'
			}).then((result) => {
				if (result.isConfirmed) {
					// Perform the action here
					resetTimer(sr_id);
					transcription = '';
					CKEDITOR.instances[editorName].setData('');
					recognition.stop();
					console.log('Recognition stopped');
					resetBtn.style.display = 'none';
				}
			})
		});
		var startTime = 0;
		var elapsedTime = 0;
		var timerInterval;

		function startTimer(id) {
			if (elapsedTime === 0) {
				startTime = new Date().getTime();
			} else {
				startTime = new Date().getTime() - elapsedTime;
			}
			// timerInterval = setInterval(updateTimer, 1000);
			timerInterval = setInterval(function() {
				updateTimer(id);
			}, 1000);
		}

		function stopTimer() {
			clearInterval(timerInterval);
			elapsedTime = new Date().getTime() - startTime;
		}

		function resetTimer(id) {
			clearInterval(timerInterval);
			elapsedTime = 0;
			document.getElementById('timer' + id).innerHTML = '00:00:00';
		}

		function updateTimer(id) {
			var elapsedTime = new Date().getTime() - startTime;
			var seconds = Math.floor(elapsedTime / 1000) % 60;
			var minutes = Math.floor(elapsedTime / (1000 * 60)) % 60;
			var hours = Math.floor(elapsedTime / (1000 * 60 * 60)) % 24;
			document.getElementById('timer' + id).innerHTML = formatTime(hours) + ':' + formatTime(minutes) + ':' + formatTime(seconds);
		}

		function formatTime(time) {
			return (time < 10 ? '0' : '') + time;
		}
	});
</script>
@endsection