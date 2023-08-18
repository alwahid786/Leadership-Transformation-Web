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
		border: 1px solid #6dabe4;
		padding: 5px 0px;
		border-radius: 5px;
		width: 150px;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.buttonSection a:hover {
		background-color: #6dabe4;
		color: white;
	}

	.startBtn {
		background-color: #6dabe4;
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
		<form action="{{route('submitDesire')}}" id="desireForm" method="POST">
			@csrf
			<div class="row">
				<div class="col-12 text-center">
					<h3 class="headingTitle mb-0">Desire</h3>
				</div>
				<div class="col-12 mt-3">
					<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo vel optio repudiandae officiis maxime perferendis hic harum laboriosam, rerum porro commodi vero praesentium fugit molestias vitae deserunt aspernatur non numquam et odio eligendi ipsa aperiam sed quis. Saepe, tempora eligendi! Quo adipisci pariatur cupiditate id unde vero numquam, fugiat fuga.</p>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit culpa error ex molestiae, ratione libero sapiente consectetur possimus quod maxime quis aut illo nostrum voluptatem sint architecto explicabo labore cum eius distinctio beatae. Eligendi, laudantium iste vitae molestiae repellendus consectetur sit incidunt ipsam nulla eum dolorum, voluptatibus temporibus quis! Quas expedita rerum ullam dignissimos! Asperiores voluptatem earum dolor quasi, harum labore dicta. Libero quam ad nulla expedita tenetur reprehenderit sint?</p>
				</div>
				<div class="col-12 mt-3">
					<h4 class="mb-0">Record Audio</h4>
					<p>Record audio to convert to text in the editor below.</p>
					<div id="controls" class="d-flex align-items-center justify-content-between">
						<div>
							<button data-class="desire" type="button" id="startBtn1" data-sr_no="1" data-editor_name="editor" class="startBtn">Start Recording</button>
							<button data-class="desire" type="button" id="stopBtn1" data-sr_no="1" class="btn-danger stopBtn" style="display: none;">Stop Recording</button>
							<button data-class="desire" type="button" id="resetBtn1" data-sr_no="1" class="btn-danger resetBtn" style="display: none;">Reset Text</button>
						</div>
						<div class="d-flex align-items-center">
							<i class="zmdi zmdi-circle mr-2"></i>
							<div id="timer1">00:00:00</div>
						</div>
					</div>
					<div class="mt-3">
						<div id="editor"><?php echo $book['desire'] ?? '' ?></div>
					</div>
				</div>
				<input type="hidden" name="desire" id="contentInput" data-class="desire">
				<div class="text-right px-3 mt-3 w-100">
					<button type="submit" data-class="desire" id="save" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Save</button>
				</div>
			</div>
		</form>

	</div>
	<div class="buttonSection d-flex justify-content-end align-items-center mt-5">
		<a href="{{url('/gratitude')}}" class="navBtns mr-2"><i class="fas fa-arrow-left mr-2"></i> Previous</a>
		<a href="{{url('/wow/con')}}" class="navBtns">Next<i class="fas fa-arrow-right ml-2"></i> </a>
	</div>
</section>
@endsection
@section('insertjavascript')
@if(session()->has('desireSuccess'))
<script>
	Swal.fire({
		title: 'Success',
		text: `{{ session('desireSuccess') }}`,
		icon: 'success',
		confirmButtonColor: "#6dabe4"
	})
</script>
@endif
@if(session()->has('nextError'))
<script>
	Swal.fire({
		title: 'Error',
		text: `{{ session('nextError') }}`,
		icon: 'error',
		confirmButtonColor: "#6dabe4"
	})
</script>
@endif
<script>
	$('.sidenav  li:nth-of-type(3)').addClass('active');
</script>
<script>
	$(document).ready(function() {
		var scrollableDiv = document.getElementById("navAccordion");
		scrollableDiv.scrollTop = scrollableDiv.scrollHeight;

		$("#desireForm").submit(function(e) {
			e.preventDefault();
			validation = validateForm();
			if (validation) {
				var content = CKEDITOR.instances['editor'].getData();
				if (content == '') {
					Swal.fire({
						title: 'Empty Data',
						text: "Please write something in Text Editor to save!",
						icon: 'error',
						confirmButtonColor: "#6dabe4"
					})
					return;
				}
				$('#contentInput').val(content);
				$("#desireForm")[0].submit();
			} else {
				Swal.fire({
					title: 'Missing Fields',
					text: "Some fields are missing!",
					icon: 'error',
					confirmButtonColor: "#6dabe4"
				})
			}
		})

		function validateForm() {
			let errorCount = 0;
			$("form#desireForm :input").each(function() {
				let val = $(this).val();
				if (val == '' && $(this).attr('data-class') !== 'desire') {
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
				confirmButtonColor: '#6dabe4',
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