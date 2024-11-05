@extends("Frontend.layout.master")

@section('content')
<div class="col-sm-9 padding-right">
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Features Items</h2>
		<div style="width=100%; padding-bottom = 10px" >
			<form action="{{ url('/product/search/resultadvanced') }}" method="GET" >
			@csrf
				<div style="display: flex; gap: 10px; align-items: center;">
					
					<input name="name" type="text" style="height: 40px; width: 170px; border: none; background-color: #f2f2f2" placeholder = " Name">
					
					<select name="price" id="" style="height: 40px; width: 170px;">
						<option value="">Choose price</option>
						<option value="0-1000">< 1000</option>
						<option value="1000-4000">1000 - 4000</option>
					</select>
				
					<select name="category" id="" style="height: 40px; width: 170px;">
							<option value="">Category</option>
						@foreach($category as $value)
							<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>

					<select name="brand" id="" style="height: 40px; width: 170px;">
							<option value="">Brand</option>
						@foreach($brand as $value)
							<option value="{{$value['id']}}">{{$value['name']}}</option>
						@endforeach
					</select>

					<select name="status" id="" style="height: 40px; width: 170px;">
						<option value="">Status</option>
						<option value="0">New</option>
						<option value="1">Sale</option>
					</select>

				</div>

				<button type="submit" style="height: 30px; width: 100px; margin-top: 10px; width: 80px; background-color: orange; color: white; border: none; border-radius: 2px;">Search</button >
				

			</form>
		</div>
		@foreach ($product as $value)
		<div class="col-sm-4">
			<div class="product-image-wrapper">   
				<div class="single-products">
					<div class="productinfo text-center">
						<img src="{{ asset('upload/product/'.$value->id_user. '/' . $imgarr[$value->id]) }}" alt="" />
						<h2>${{number_format($value->price)}}</h2>
						<p>{{$value->name}}</p>
						<a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
					</div>
					<div class="product-overlay">
						<div class="overlay-content">
							<h2>${{number_format($value->price)}}</h2>
							<p><a href="{{url('product/detail/' . $value->id)}}" style="color: white;">{{$value->name}}</a></p>
							<a href="" class="btn btn-default add-to-cart" id="{{$value->id}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
					</div>
				</div>
				<div class="choose">
					<ul class="nav nav-pills nav-justified">
						<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
						<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
					</ul>
				</div>
			</div> 
		</div> 
		@endforeach		
	</div><!--features_items-->
	{{ $product->links('pagination::bootstrap-4') }}
</div>
<script>
	$(document).ready(function(){

	
		$.ajaxSetup({
                headers: { 

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                }
		})

		$('a.add-to-cart').click(function(){
			event.preventDefault();
			var getID = $(this).attr('id');
			//console.log (getID);=>ok

			$.ajax({
				method: "POST",
				url: "{{url('account/cart/ajax')}}", 
				data: {
					id: getID
				},
				success : function(data){
					console.log(data.total);
					$('#cart-count').text(data.total);

				}
			})   
		})
			
		
	})
</script>
@endsection