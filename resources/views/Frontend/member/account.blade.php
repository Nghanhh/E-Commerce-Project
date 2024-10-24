@extends('Frontend.layout.master')

@section('content')

	<div class="col-sm-9">
		<div class="blog-post-area">
			<h2 class="title text-center">Update user</h2>
			<div class="signup-form"><!--sign up form-->
				<h2>Update User Information!</h2>
				<form action="" method="POST" enctype="multipart/form-data">
				@csrf
					@if(session('success'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Notification!</h4>
							{{session('success')}}
						</div>
					@endif

					<input type="text" name="name" value="{{$user->name}}"/>
					@error('name')
                    	<div class="error">{{ $message }}</div>
                    @enderror

					<input type="email" name="email" value="{{$user->email}}" readonly/>

					<input type="password" name="password" placeholder="Password" />

					<select name="id_country" id="">
						@foreach ($country as $value)
							<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>

					<input type="text" name="phone" value="{{$user->phone}}"/>

					<input type="file" name="avatar" id="" >

					<button type="submit" class="btn btn-default">Update</button>

				</form>
			</div>
		</div>
	</div>

@endsection