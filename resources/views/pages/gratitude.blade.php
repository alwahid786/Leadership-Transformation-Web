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

	#pageCode::placeholder {
		/* Chrome, Firefox, Opera, Safari 10.1+ */
		color: gray !important;
		opacity: 1 !important;
		/* Firefox */
	}
</style>
@include('includes.navbar')
<section class="contentSection position-relative">
	<div class="container-fluid contentRow">
		<form action="{{route('submitGratitude')}}" id="gratitudeForm" method="POST">
			@csrf
			<div class="row">
				<div class="col-12 text-center">
					<h3 class="headingTitle mb-0">Gratitude</h3>
					<h5>Taken from the book "Gratitude Stories From Our Hearts"</h5>
				</div>
				<div class="col-12 mt-3">
					<p>My gratitude journey started at the Entrepreneur’s Organization Global Leadership Conference
						in Bangkok, Thailand. A smart lady and now friend by the name of Gina Mollicone- Long was
						speaking during a break-out session. Gina is a Process Control Engineer by education and a
						trainer of Performance Coaches professionally. I was lucky to be in the audience when she
						talked about the role of energy and emotion in human performance. During her lecture, she
						proposed that humans perform at their highest level when they express or experience
						gratitude, and at their lowest level when they express or experience fear or shame. Little did I
						know that thought would completely change my life.
					</p>
					<p>When we returned to the United States, I drove myself to our local Home Depot and bought a
						small, galvanized pail. It wasn’t heavy but it’s noticeable, it’s shiny, not easy to carry in your
						pocket and you can’t really hide it, the pail is about eight inches tall and eight inches across. I
						wrote the word “gratitude” on a piece of paper and dropped it the pail. I carried the pail
						everywhere with me. That pail became a physical reminder to me to be intentional about my
						gratitude practice. It sat in the passenger seat of my car, in my truck, on the desk in my home
						office, on the credenza in my actual office, and beside the TV when Sunday movies came on. I
						did this for six months. The pail was my physical reminder to practice gratitude The interesting
						thing about gratitude, is the more you practice gratitude the more grateful you become. After
						six months or so I made the decision, I was going to share my newfound gratitude with my
						Company Leadership Team.
					</p>
					<p>
						We started a weekly Gratitude Exercise called One Good Thing. Every Monday at nine in the
						morning, each member was given one minute or two to share One Good Thing. One Good Thing
						is a share of whatever a person is most Grateful from their business, family, or personal life
						from the previous week. It was awkward at first and took a while before people were
						comfortable enough to really share, but once they did, their stories were eye opening.
					</p>
					<p>
						Two stories stand out for me. One of my teammates was a parent to a daughter who loved
						soccer. When it was his turn to speak, he said that he was grateful that his daughter finally
						introduced him to her friends. You see, my teammate had been attending his daughter’s soccer
						games week in and week out, but his daughter never acknowledged that he was
						there. Until one day, she did. That tiny moment made my teammates’ week.
					</p>
					<p>
						Another teammate was a new grandmother. We all knew that her daughter was pregnant, and
						that they were all excited for the baby. What we didn’t know was that the baby had been
						diagnosed with a congenital defect that increased his risk for not surviving to term. If he did
						survive to term, the doctor said that it would be likely that he would be stillborn. If he wasn’t
						stillborn, he would most likely die immediately after birth. When it was her turn to speak, she
						said that she was grateful that her grandson was born. Though he lived only an hour, she was
						grateful to meet her grandson, hold him and tell him she loved him. I thought I was going to
						teach my teammates about the power of Gratitude, and I learned so much more than I taught.
					</p>
				</div>
				<div class="col-12 mt-3">
					<h4 class="mb-0">Record Audio</h4>
					<p>Record audio to convert to text in the editor below.</p>
					<div id="controls" class="d-flex align-items-center justify-content-between">
						<div>
							<button data-class="gratitude" type="button" id="startBtn1" data-sr_no="1" data-editor_name="editor" class="startBtn">Start Recording</button>
							<button data-class="gratitude" type="button" id="stopBtn1" data-sr_no="1" class="btn-danger stopBtn" style="display: none;">Stop Recording</button>
							<button data-class="gratitude" type="button" id="resetBtn1" data-sr_no="1" class="btn-danger resetBtn" style="display: none;">Reset Text</button>
						</div>
						<div class="d-flex align-items-center">
							<i class="zmdi zmdi-circle mr-2"></i>
							<div id="timer1">00:00:00</div>
						</div>
					</div>
					<div class="mt-3">
						<div id="preview"></div>
						<div id="editor"><?php echo $book['gratitude'] ?? '' ?></div>
					</div>
				</div>
				<input type="hidden" name="gratitude" id="contentInput" data-class="gratitude">
				<div class="text-right px-3 mt-3 w-100">
					<button type="submit" data-class="gratitude" id="save" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Save</button>
				</div>
			</div>
		</form>

	</div>
	<div class="buttonSection d-flex justify-content-end align-items-center mt-5">
		<a href="{{url('/cover')}}" class="navBtns mr-2"><i class="fas fa-arrow-left mr-2"></i> Previous</a>
		@if(auth()->user()->unlocked_pages >= 3)
		<a href="{{url('/desire/con')}}" class="navBtns">Next<i class="fas fa-arrow-right ml-2"></i> </a>
		@else
		<a href="javascript:void(0)" class="navBtns" id="nextButton" data-toggle="modal" data-target="#exampleModalCenter">Next<i class="fas fa-arrow-right ml-2"></i> </a>
		@endif
	</div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Enter Code</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>You must enter Page Code to unlock next page.</p>
				<input name="code" type="text" id="pageCode" class="form-control validation" placeholder="Write Code Here...">
				<input name="page_number" type="hidden" id="pageNumber" value="3" class="form-control validation">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submitCodeButton">Proceed</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('insertjavascript')
@if(session()->has('gratitudeSuccess'))
<script>
	Swal.fire({
		title: 'Success',
		text: `{{ session('gratitudeSuccess') }}`,
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
	$('.sidenav  li:nth-of-type(2)').addClass('active');
</script>
<script>
	$(document).ready(function() {
		// var scrollableDiv = document.getElementById("navAccordion");
		// scrollableDiv.scrollTop = scrollableDiv.scrollHeight;

		$("#gratitudeForm").submit(function(e) {
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
				$("#gratitudeForm")[0].submit();
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
			$("form#gratitudeForm :input").each(function() {
				let val = $(this).val();
				if (val == '' && $(this).attr('data-class') !== 'gratitude') {
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
			transcriptionField = document.getElementById('preview');
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
					transcription = '';
				} else {
					interimTranscription += transcript;
				}

				transcriptionField.innerHTML = transcription + interimTranscription;
			}

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


		let pageErrors = 0;
		$("#submitCodeButton").click(function() {
			$(".validation").each(function() {
				if ($(this).val() == '') {
					pageErrors++;
					$(this).css('border', '1px solid red');
				} else {
					$(this).css('border', '1px solid rgba(0, 0, 0, 0.1)');
				}
			})
			if (pageErrors > 0) {
				Swal.fire({
					title: 'Empty Fields',
					text: 'You must Enter Code.',
					icon: 'error',
					confirmButtonColor: "#6dabe4"
				})
				pageErrors--;
				return;
			}
			var data = {
				code: $('#pageCode').val(),
				page_number: $('#pageNumber').val(),
			}

			// Ajax REQUEST START
			var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: `{{url('/validatePageCode')}}`,
				type: "POST",
				data: data,
				cache: false,
				success: function(dataResult) {
					if (dataResult.success == false) {
						Swal.fire({
							title: 'Error',
							text: dataResult.message,
							icon: 'error',
							confirmButtonColor: "#6dabe4"
						})
						return;
					} else {
						window.location.href = `{{url('/desire/con')}}`
					}
				},
				error: function(jqXHR, exception) {
					Swal.fire({
						title: 'Validation Error',
						text: jqXHR.responseJSON.message,
						icon: 'error',
						confirmButtonColor: "#6dabe4"
					})
				}
			});
			// Ajax REQUEST END
		});
	});
</script>
@endsection