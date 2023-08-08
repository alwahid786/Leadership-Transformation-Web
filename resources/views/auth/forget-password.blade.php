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
								<h3 class="mb-4 text-green">Forget Password</h3>
							</div>
							<p>Please enter your email address to verify it's you.</p>
						</div>
						<form action="#" class="signin-form">
							<div class="form-group mb-3">
								<label class="label" for="name">Email</label>
								<input type="email" class="form-control" placeholder="Enter Email" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
							</div>

						</form>
						<p class="text-center">Remember Password? <a data-toggle="tab" href="{{url('/login')}}">Sign In</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('insertjavascript')
@endsection