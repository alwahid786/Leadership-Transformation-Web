@extends('layouts.default-layout')
@section('content')
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
				<div class="wrap d-md-flex">
					<div class="w-100 p-4 p-md-5">
						<div class="text-center">
							<div class="w-100">
								<h3 class="mb-4 text-green">Verify OTP Code</h3>
							</div>
							<p>Please enter OTP Code you received in your email address.</p>
						</div>
						<form action="#" class="signin-form">
							<!-- <div class="form-group mb-3">
								<label class="label" for="name">Email</label>
								<input type="email" class="form-control" placeholder="Enter Email" required>
							</div> -->
							<div class="form-group login-email-field d-flex justify-content-center">
								<div class="otp-inputs my-3">
									<input type="text" maxlength="1" name="otp[]" class="form-control" id="input1" onkeyup="moveToNext(this, 'input2')" aria-describedby="emailHelp">
									-<input type="text" maxlength="1" name="otp[]" class="form-control" id="input2" onkeyup="moveToNext(this, 'input3')" aria-describedby="emailHelp">
									-<input type="text" maxlength="1" name="otp[]" class="form-control" id="input3" onkeyup="moveToNext(this, 'input4')" aria-describedby="emailHelp">
									-<input type="text" maxlength="1" name="otp[]" class="form-control" id="input4" aria-describedby="emailHelp">
								</div>
							</div>
							<div class="form-group text-center">
								<button type="submit" class="w-50  form-control btn btn-primary rounded submit px-3">Verify</button>
							</div>

						</form>
						<p class="text-center">Incorrect Email? <a data-toggle="tab" href="{{url('/login')}}">Enter Email</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('insertjavascript')
@endsection