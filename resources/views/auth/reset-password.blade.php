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
								<h3 class="mb-4 text-green">Reset Password</h3>
							</div>
						</div>
						<form action="#" class="signin-form">
							<div class="form-group mb-3">
								<label class="label" for="password">Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" required>
							</div>
							<div class="form-group mb-3">
								<label class="label" for="password">Confirm Password</label>
								<input type="password" class="form-control" placeholder="Enter Password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control btn btn-primary rounded submit px-3">Update Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('insertjavascript')
@endsection