<div class="container" style="padding: 70px;background-color: #A9A9A9;border-spacing: 10px">
	<div class="row">
	@include('partials.messages')
	@include('partials.errors')
	<h2 style="text-align: center;">Subscribe To Our Newsletter</h2>
	<form method="post" action="{{route('newsletter')}}">
		@csrf
		<div class="row">
			<div class="col-md-4"></div>
				<div class="form-group col-md-4">
					<label for="Email">Email</label>
					<input type="text" name="email" placeholder="Enter Your Email">
				</div>
			<div class="col-md-4">
				<div class="form-group">
					<button class="btn btn-secondary btn-sm" type="submit">Subscribe</button>
				</div>
			</div>
		</div>
	</form>
	</div>
</div>