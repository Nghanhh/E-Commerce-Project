@extends("Frontend.layout.master")

@section('content1')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if($productincart)
							@foreach ($productincart as $value)
								<tr>
									<td class="cart_product">
										<a href=""><img src="{{asset('/upload/product/'.$value['id_user'].'/hinh85_'. $getArrImage[$value['id']][0]) }}" alt=""></a>
									</td>
									<td class="cart_description" id="{{$value['id']}}">
										<h4><a href="">{{$value['name']}}</a></h4>
										<p>Web ID: {{$value['id']}}</p>
									</td>
									<td class="cart_price" id="{{ number_format($value['price'], 0)}}">
										<p>${{ number_format($value['price'], 0)}}</p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<a class="cart_quantity_up" href=""> + </a>
											<input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2">
											<a class="cart_quantity_down" href=""> - </a>
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">
											${{ number_format($value['price'] * $value['qty'], 0) }}
										</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
									</td>
								</tr>
							@endforeach	
						@else
							<div class="text-center mt-5"> 
								<!-- text-center: Căn giữa nội dung văn bản (text) theo chiều ngang của vùng chứa.
									"mt-5"     : Thêm khoảng cách trên (margin-top) cho phần tử để nó cách xa phần tử phía trên. -->
								<h2>There are no products in the cart.</h2>
								<p>Please return to <a href="{{ url('/product/home') }}">Home</a> page to shop!</p>
								<img src="{{ asset('Frontend/images/cart/cart-empty.png') }}" alt="Empty Cart" class="img-fluid mt-4" style="max-width: 300px;">
								<!-- Trong Bootstrap (thư viện CSS phổ biến), các lớp như img-fluid và mt-4 được sử dụng để tạo kiểu cho ảnh và đảm bảo chúng hiển thị đẹp và tương thích trên mọi thiết bị. -->
							</div>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li class="cart-sub-total">Cart Sub Total <span  class="cart-sub-total">${{$totalprice}}</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span class="withtax">${{$totalprice + ($totalprice * 0.08)}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<script>
		$(document).ready(function(){

			$.ajaxSetup({
                headers: { 

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                }
			})

			//Quantity_up 
			$('a.cart_quantity_up').click(function(){
				event.preventDefault();
				var x = 0;
				var back = updatecart(0,this);		
				//Truyền data qua Ajax
				$.ajax({
					type:'POST',
					url:'{{url("/account/add/ajax")}}', 
					data:{
							qty: back['newqty'],
							id : back['product_id'],
						},
					success:function(data){
						//console.log (data.total)
						$('span.cart-sub-total').text('$' + data.totalprice);
						$('#cart-count').text(data.total);
						$('.withtax').text('$' + (data.total * 1.08));
						
					}
				}); 
						

			})
			//End quantity_up


			//Quantity_down
			$('a.cart_quantity_down').click(function(){
				event.preventDefault();
				var x = 1;
				var back = updatecart(1,this);
				//Ajax
					$.ajax({
					type:'POST',
					url:'{{url("/account/down/ajax")}}', 
					data:{
							qty: back['newqty'],
							id : back['product_id'],
						},
					success:function(data){
						$('span.cart-sub-total').text('$' + data.totalprice);
						$('#cart-count').text(data.total);
						$('.withtax').text('$' + (data.total * 1.08));
					} 
					}); 
			})
			//End quantity_down

			//Delete

			$('.cart_delete').click(function(){
				event.preventDefault();
				var newqty = 0;
				//Lấy id của sản phẩm được cộng thêm
					var product_id = $(this).closest('tr').find('td.cart_description').attr('id');
				//Xóa trên blade
				$(this).closest('tr').hide();
				$.ajax({
					type:'POST',
					url:'{{url("/account/delete/ajax")}}', 
					data:{
							qty: newqty,
							id : product_id,
						},
					success:function(data){
						$('#cart-count').text(data.total);
					}
				}); 
			})
			//End Delete
		})

		function updatecart(x,element){
			//Lấy qty hiện tại
			var qty = parseInt($(element).closest('div').find('input').val());
			if( x == 0){
				//Cộng thêm 1
				var newqty = qty + 1;
				$(element).closest('div').find('input').val(newqty);	
			}else if( x == 1){
				if(qty > 1){
					//Số lượng trừ đi 1
					var newqty = qty - 1;
					$(element).closest('div').find('input').val(newqty);	
				}else{
					//Xóa sản phẩm đó trên blade
					$(element).closest('tr').hide();
					var newqty = 0;
				}
			}

			//Lấy id của sản phẩm được cộng thêm
				var product_id = $(element).closest('tr').find('td.cart_description').attr('id');
			//Lấy giá cái mới tăng số lượng
				var price = $(element).closest('tr').find('td.cart_price').attr('id');
				//console.log(price);
			//Tính tổng 
				var total = newqty * price;
			//Bỏ lên trên kia nha
				$(element).closest('tr').find('td.cart_total p').text('$'+ total); 
			
			return {product_id,newqty};
		}
	</script>
@endsection