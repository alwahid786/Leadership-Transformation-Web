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
</style>
@include('includes.navbar')
<section class="contentSection position-relative">
	<div class="container-fluid contentRow">
		<div class="row ">
			<div class="col-12 text-center">
				<h3 class="headingTitle">Transformational Leadership</h3>
			</div>
			<div class="col-lg-6 col-md-8 col-12 offset-lg-3 offset-md-2 mt-3">
				@if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
					<p class="m-0">{{ $error }}</p>
					@endforeach
				</div>
				@endif
				<div class="form-group mb-3">
					<label class="label" for="name">Designed For:</label>
					<input type="text" class="form-control validation" value="{{$book->designed_for ?? ''}}" id="designedFor" placeholder="ex: Patrick Milton" required>
				</div>
				<div class="form-group mb-3">
					<label class="label" for="name">First Name:</label>
					<input type="text" value="{{$book->first_name ?? auth()->user()->name}}" class="form-control validation" id="firstName" placeholder="ex: Jennifer" required>
				</div>
				<div class="form-group mb-3">
					<label class="label" for="name">Last Name:</label>
					<input type="text" value="{{$book->last_name ?? auth()->user()->last_name}}" class="form-control validation" id="lastName" placeholder="ex: Star" required>
				</div>
				<div class="form-group w-50 mx-auto">
					<button id="submitCoverButton" class="form-control btn btn-primary rounded submit px-3">Submit</button>
				</div>
			</div>
		</div>

	</div>
	<div class="buttonSection d-flex justify-content-end align-items-center mt-5">
		<a href="{{url('/gratitude/con')}}" class="navBtns">Next<i class="fas fa-arrow-right ml-2"></i> </a>
	</div>
</section>
@endsection
@section('insertjavascript')
<script>
	$('.sidenav  li:nth-of-type(1)').addClass('active');
</script>
<script>
	$(document).ready(function() {
		// Click Signin Button 
		let errors = 0;
		$("#submitCoverButton").click(function() {
			$(".validation").each(function() {
				if ($(this).val() == '') {
					errors++;
					$(this).css('border', '1px solid red');
				} else {
					$(this).css('border', '1px solid rgba(0, 0, 0, 0.1)');
				}
			})
			if (errors > 0) {
				Swal.fire({
					title: 'Empty Fields',
					text: 'All fields are required',
					icon: 'error',
					confirmButtonColor: "#6dabe4"
				})
				errors--;
				return;
			}
			var data = {
				designed_for: $('#designedFor').val(),
				first_name: $('#firstName').val(),
				last_name: $('#lastName').val(),
			}

			// Ajax REQUEST START
			var csrfToken = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: `{{url('/cover/submit')}}`,
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
						Swal.fire({
							title: 'Success',
							text: dataResult.message,
							icon: 'success',
							confirmButtonColor: "#6dabe4"
						})
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