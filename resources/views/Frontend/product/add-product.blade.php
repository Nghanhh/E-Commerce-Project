@extends("Frontend.layout.master")

@section('content')
<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Add product</h2>
			<div class="signup-form"><!--Add product form-->
				<h2>Add New Product!</h2>
				<form action="" method="POST" enctype="multipart/form-data">
				@csrf

				@if(session('success'))
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Notification</h4>
							{{session('success')}}
					</div>
				@endif
					
					<input type="text" placeholder="Name" name="name"/>
					@error('name')
						<div class="error">{{ $message }}</div>
					@enderror

					<div style="display: inline-block;" class="">
						<input type="text" style="display: inline-block; width: 200px; padding: 5px;" placeholder="Price" name="price">
						<span style="display: inline-block; margin-left: 5px;">$</span>
					</div>
					@error('price')
						<div class="error">{{ $message }}</div>
					@enderror
					
					<select name="id_category" id="" placeholder="Please choose category">
						<option value="">Please choose category</option>
						@foreach($category as $value)
							<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>
					@error('id_category')
							<div class="error">{{ $message }}</div>
					@enderror

					<select name="id_brand" id="" placeholder="Please choose brand">
						<option value="">Please choose brand</option>
						@foreach($brand as $value)
							<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>
					@error('id_brand')
							<div class="error">{{ $message }}</div>
					@enderror

					<select name="status" class="status" placeholder="Please choose brand">
						<option value="">Sale</option>
						<option value="0">0</option>
						<option value="1">1</option>
					</select>
					@error('status')
							<div class="error">{{ $message }}</div>
					@enderror

					<div style="display: none;" class="ifsale">
						<input type="text" style="display: inline-block; width: 200px; padding: 5px;" placeholder="Sale" name="sale">
						<span style="display: inline-block; margin-left: 5px;">%</span>
					</div>

					<input type="text" placeholder="Company profile" name="company"/>
					@error('company')
							<div class="error">{{ $message }}</div>
					@enderror

					<input type="file" name="image[]" id="" multiple >
					@error('image')
							<div class="error">{{ $message }}</div>
					@enderror

					<textarea name="detail" id="" placeholder="Detail"></textarea >
					@error('detail')
							<div class="error">{{ $message }}</div>
					@enderror
					
					<button type="submit" class="btn btn-default">Add Product</button>

				</form>
			</div>
	</div>
</div>

<script>
	/* Click chọn có Sale () thì hiện ra ô nhập giá Sale --> */
	 
	/*
		- Chọn Sale có nghĩa là value of select = 1 (Không Sale value = 0). => $('select.status').val()
		- if Value of select = 0, show() div class ifsale
	*/
	$(document).ready(function() {

		$('select.status').change(function(){
			var status = $('select.status').val();
			//alert(status);
			if(status == 1){
				$('div.ifsale').show();
			}else{
				$('div.ifsale').hide();
			}
		})


	})
</script>

@endsection