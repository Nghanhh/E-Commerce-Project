@extends("Frontend.layout.master")

@section('content')
<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Edit product</h2>
			<div class="signup-form"><!--Edit product form-->
				<h2>Edit Product!</h2>

				<form action="" method="POST" enctype="multipart/form-data">
				@csrf

					@if(session('success'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Notification</h4>
							{{session('success')}}
						</div>
					@endif
					@if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Notification</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

					<!-- Product name -->
					<input type="text" placeholder="Name" name="name" value="{{$product['name']}}"/>
					@error('name')
						<div class="error">{{ $message }}</div>
					@enderror

					<!-- Price -->
					<div style="display: inline-block;" class="">
						<input  value=" {{number_format($product['price'])}}" type="text" style="display: inline-block; width: 200px; padding: 5px;" placeholder="Price" name="price">
						<span style="display: inline-block; margin-left: 5px;">$</span>
					</div>
					@error('price')
						<div class="error">{{ $message }}</div>
					@enderror
					
					<!-- Choose category -->
					<select name="id_category" id="" value=""><!--  -->
						<option value="">Please choose category</option>
						@foreach($category as $value)
							<option value="{{$value['id']}}" 
								@if($value['id'] == $product['id_category']) selected @endif
							>{{$value['name']}}</option>
						@endforeach
					</select>
					@error('id_category')
							<div class="error">{{ $message }}</div>
					@enderror

					<!-- Choose brand -->
					<select name="id_brand" id="" >
						<option value="">Please choose brand</option>
						@foreach($brand as $value)
							<option value="{{$value['id']}}" 
								@if($value['id'] == $product['id_brand']) 
									selected 
								@endif
							>{{$value['name']}}</option>
						@endforeach
					</select>
					@error('id_brand')
							<div class="error">{{ $message }}</div>
					@enderror
					 
					<!-- Choose status -->
					<select name="status" class="status">
						<option value="">Sale</option>

						<option value="0"
							@if($product['status'] == "0") 
									selected 
							@endif
							>0</option>x
						<option value="1"
						@if($product['status'] == "1") 
									selected 
							@endif
							>1</option>
					</select>
					@error('status')
							<div class="error">{{ $message }}</div>
					@enderror
					
					<!-- Sale amount -->
					<div style="display: none;" class="ifsale">
						<input value=" {{$product['sale']}}" type="text" style="display: inline-block; width: 200px; padding: 5px;" placeholder="Sale" name="sale">
						<span style="display: inline-block; margin-left: 5px;">%</span>
					</div>
					
					<!-- Company -->
					<input value="{{ $product['company'] }}" type="text" placeholder="Company profile" name="company"/>
					@error('company')
							<div class="error">{{ $message }}</div>
					@enderror

					<!-- Images -->
					<input type="file" name="image[]" id="" multiple >
					<label for="">Select photo to delete</label>
					<div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 10px;">
						@foreach ($getArrImage as $value)
							<div style="width: 150px; text-align: center; border: 1px solid #ddd; padding: 5px;">
								<img src="{{ asset('upload/product/'.$product['id_user']. '/' . $value) }}" alt="Ảnh" style="width: 100%; height: 100px; object-fit: cover; display: block; margin-bottom: 5px;">
								<input type="checkbox" name="imageToDelete[]" value="{{ $value }}" >
							</div>
						@endforeach
					</div>
					@error('image')
							<div class="error">{{ $message }}</div>
					@enderror
					
					<!-- Detail -->
					<textarea name="detail" id="" placeholder="Detail">{{$product['detail']}}</textarea >
					@error('detail')
							<div class="error">{{ $message }}</div>
					@enderror
					
					<button type="submit" class="btn btn-default">Add Product</button>

				</form>
			</div>
	</div>
</div>

<script>

	$(document).ready(function() {

		function toggleSaleInput() {
        var status = $('select.status').val();
        if (status == 1) {
            $('div.ifsale').show();
        } else {
            $('div.ifsale').hide();
        }
    }

	toggleSaleInput();
		
	$('select.status').change(function(){

		toggleSaleInput();

	})


	})
</script>

@endsection