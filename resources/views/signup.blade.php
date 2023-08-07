@extends('layouts.default-layout')
@section('content')
<section class="ftco-section">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
				<div class="wrap d-md-flex">
					<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4 text-green">Sign Up</h3>
							</div>

						</div>
						<form action="#" class="signin-form">
							<div class="form-group mb-3">
								<label class="label" for="name">First Name</label>
								<input type="text" class="form-control" placeholder="Enter First Name" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="name">Last Name</label>
								<input type="text" class="form-control" placeholder="Enter Last Name" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="name">Email</label>
								<input type="email" class="form-control" placeholder="Enter Email" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="name">Phone</label>
								<input type="text" class="form-control" placeholder="Enter Phone" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">Confirm Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
							</div>

						</form>
						<p class="text-center">Already a member? <a data-toggle="tab" href="{{url('/login')}}">Sign In</a></p>
					</div>
					<div class="img" style="background-image: url('{{asset('assets/images/login-image.jpg')}}');">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('insertjavascript')
@endsection