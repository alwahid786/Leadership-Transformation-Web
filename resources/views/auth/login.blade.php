@extends('layouts.default-layout')
@section('content')
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
				<div class="wrap d-md-flex">
					<div class="img" style="background-image: url('{{asset('assets/images/login-img.svg')}}');">
					</div>
					<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4 text-green">Sign In</h3>
							</div>

						</div>
						<div class="form-group mb-3">
							<label class="label" for="name">Email</label>
							<input type="text" class="form-control validate" id="email" placeholder="Enter Email" required>
						</div>
						<div class="form-group mb-3">
							<label class="label" for="password">Password</label>
							<input type="password" class="form-control validate" id="password" placeholder="Enter Password" required>
						</div>
						<div class="form-group">
							<button id="loginButton" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
						</div>
						<div class="form-group d-md-flex">
							<div class="w-50 text-left">
							</div>
							<div class="w-50 text-md-right">
								<a href="{{url('forget-password')}}">Forgot Password</a>
							</div>
						</div>
						<p class="text-center">Not a member? <a data-toggle="tab" href="{{url('/signup')}}">Sign Up</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('insertjavascript')
<script>
	$(document).ready(function() {
		// Click Signin Button 
		let errors = 0;
		$("#loginButton").click(function() {
			$(".validate").each(function() {
				if ($(this).val() == '') {
					errors++;
					$(this).css('border', '1px solid red');
				} else {
					errors--;
					$(this).css('border', '1px solid rgba(0, 0, 0, 0.1)');
				}
			})
			if (errors > 0) {
				Swal.fire({
					title: 'Empty Fields',
					text: 'All fields are required',
					icon: 'error',
					confirmButtonColor: "#66CE2C"
				})
				return;
			}
			var data = {
				email: $('#email').val(),
				password: $('#password').val(),
			}

			// Ajax REQUEST START
			var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: `{{url('/signin')}}`,
				type: "POST",
				data: data,
				cache: false,
				success: function(dataResult) {
					if (dataResult.success == false) {
						Swal.fire({
							title: 'Error',
							text: dataResult.message,
							icon: 'error',
							confirmButtonColor: "#66CE2C"
						})
						return;
					} else {
						var routeMapping = [
							'cover',
							'slide/1',
							'slide/2',
							'slide/3',
							'slide/4',
							'slide/5',
							'slide/6',
							'slide/7',
						];
						window.location.href = `{{url('${routeMapping[dataResult.data.page_number]}')}}`;
					}
				},
				error: function(jqXHR, exception) {
					Swal.fire({
						title: 'Validation Error',
						text: jqXHR.responseJSON.message,
						icon: 'error',
						confirmButtonColor: "#66CE2C"
					})
				}
			});
			// Ajax REQUEST END
		});
	});
</script>
@endsection