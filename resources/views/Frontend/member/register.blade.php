@extends('Frontend.layout.master')

@section('content')
	<section id="form" ><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="POST" enctype="multipart/form-data">
						@csrf

						@if(session('success'))
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> Notification</h4>
								{{session('success')}}
							</div>
						@endif

						<input type="text" placeholder="Name" name="name" />
						@error('name')
							<div class="error">{{ $message }}</div>
						@enderror

						<input type="email" placeholder="Email Address" name="email"/>
						@error('email')
							<div class="error">{{ $message }}</div>
						@enderror

						<input type="password" placeholder="Password" name="password"/>
						@error('password')
							<div class="error">{{ $message }}</div>
						@enderror

						<input type="text" placeholder="Phone no" name="phone"/>
						@error('phone')
							<div class="error">{{ $message }}</div>
						@enderror

						<input type="file" placeholder="Avatar" name="avatar"/>
						@error('avatar')
							<div class="error">{{ $message }}</div>
						@enderror

						<select class="form-control form-control-line" name="id_country">
							<option value="">Please select your country</option>
							<?php
                            	foreach($country as $value){
                        	?>
                            	<option value="{{$value['id']}}">{{$value['name']}}</option>
                        	<?php
                            	}
                    		?>
						</select>

						@error('id_country')
							<div class="error">{{ $message }}</div>
						@enderror
						

						<input type="text" style="display:none" name="level" value="0"/>
   
						<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection