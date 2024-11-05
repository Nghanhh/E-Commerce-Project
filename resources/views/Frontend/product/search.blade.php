@extends("Frontend.layout.master")

@section('content')
<div class="col-sm-9 padding-right">
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Features Items</h2>
		@if($match->isEmpty())
            <p class="text-center">No products found.</p>
        @else
			<div>
				<h3 style="font-weight: 300;">
					Sản phẩm liên quan đến 
					<span style="color: red;">"{{ $searchterm }}"</span>
				</h3>
			</div>
			@foreach ($match as $value)
			<div class="col-sm-4">
				<div class="product-image-wrapper">   
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="{{ asset('upload/product/'.$value->id_user. '/' . $getArrImage[$value->id][0]) }}" alt="" />
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
		@endif		
	</div><!--features_items-->
	{{ $match->links('pagination::bootstrap-4') }}
</div>
<!-- <script>
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
</script> -->
@endsection