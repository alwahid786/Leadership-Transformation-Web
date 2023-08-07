@extends('layouts.default-layout')
@section('content')
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
				<div class="wrap d-md-flex">
					<div class="img" style="background-image: url('{{asset('assets/images/login-image.jpg')}}');">
					</div>
					<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4 text-green">Sign In</h3>
							</div>

						</div>
						<form action="#" class="signin-form">
							<div class="form-group mb-3">
								<label class="label" for="name">Email</label>
								<input type="text" class="form-control" placeholder="Enter Email" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
							</div>
							<div class="form-group d-md-flex">
								<div class="w-50 text-left">
									<!-- <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label> -->
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div>
							</div>
						</form>
						<p class="text-center">Not a member? <a data-toggle="tab" href="{{url('/signup')}}">Sign Up</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('insertjavascript')
@endsection