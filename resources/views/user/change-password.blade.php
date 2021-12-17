@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		@include('partials.messages')
		@include('partials.errors')
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Change Password
				</div>
				<div class="card-body">
					<form method="POST" action="{{route('user.change.password')}}">
						@csrf
						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
							<div class="col-md-6">
								<input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current_password">
								@error('current_password')
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
							<div class="col-md-6">
								<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="password">
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
							<div class="col-md-6">
								<input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="password_confirmation">
								@error('password_confirmation')
								<span class="invalid-feedback" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary btn-sm">Change Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection