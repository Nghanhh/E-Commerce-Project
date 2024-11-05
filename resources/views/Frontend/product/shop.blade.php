@extends("Frontend.layout.master")

@section('content')
<div class="col-sm-9 padding-right">
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Features Items</h2>
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

		$('#sl2').on('slide', function(event) {

			//$value = JSON.parse($(this).attr('data-slider-value'));
			//$valuemin
			var value = event.value; // Lấy giá trị hiện tại của slider (là một array)
			//console.log(value);

			$.ajax({
				method: "POST",
				url: "{{ url('/product/search/ajaxSearch') }}",
				data: {
					value: value
				},
				success : function(data){
					$('.col-sm-4').empty();
					//console.log(data);
					var html = "";
					//Khi rả về dữ liệu JSON như return response()->json($match);, biến match có thể là một đối tượng phân trang của Laravel. 
					//Đối tượng này chứa dữ liệu và các thông tin khác như current_page, last_page, per_page, và total, cùng với mảng data chứa các sản phẩm thực tế.
					//Do đó, nếu muốn lấy số lượng phần tử thực tế, mày cần truy cập vào data, không phải match trực tiếp.
					var count = data.info.data.length; //ok có length rồi nhưng bị lỗi xíu hỏi thầy, length này truy cập vào properti length chứ kp method length.

					//console.log(data.data);
					for(let i=0; i<count; i++){
						var obj = data.info.data[i];
						//let imagePath = "{{ asset('upload/product') }}" ;
						let imagePath = "{{ asset('upload/product') }}" + "/" + obj.id_user + "/" + data.imgArr[obj.id][0];
						let productdetailpath = "{{url('product/detail')}}" + "/" + obj.id;
						//console.log(obj);
						//Nói chung là chạy lại 2, 3 lần nhưng không phải do cái này, xí hỏi thầy
						
							//console.log(key, obj[key]);
							html = html + "<div class='col-sm-4'>" +
												"<div class='product-image-wrapper'>" + 
													"<div class='single-products'>" +
														"<div class='productinfo text-center'>" +
															"<div class='productinfo text-center'>" +
																"<img src='"+ imagePath +"' alt=''>" +
																"<h2>$" + obj.price.split('.')[0] +" </h2>" +
																"<p>" + obj.name + "</p>" +
																"<a href='' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>" +
															"</div>" +
															"<div class='product-overlay'>" +
																"<div class='overlay-content'>" +
																	"<h2>" + obj.price.split('.')[0] + "</h2>" +
																	"<p><a href='"+ productdetailpath + "'" + " style='color:white;'>" + obj.name + "</a></p>"+
																	"<a href='' class='btn btn-default add-to-cart' id='" + obj.id + "'><i class='fa fa-shopping-cart'></i>Add to cart</a>" +
																"</div>" + 
															"</div>" +
														"</div>" +
														"<div class='choose'>" +
															"<ul class='nav nav-pills nav-justified'>" +
																"<li><a href=''><i class='fa fa-plus-square'></i>Add to wishlist</a></li>" +
																"<li><a href=''><i class='fa fa-plus-square'></i>Add to compare</a></li>" +
															"</ul>" +
														"</div>" +
													"</div>" +
												"</div>" +	
											"</div><!--features_items-->"
							;
						
								   
					}

					console.log(html);
					$(".title").append(html);
					
				}
			})
		});
			
		
	})
</script>
@endsection