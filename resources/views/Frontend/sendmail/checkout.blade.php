@extends("Frontend.layout.master")

@section('content1')
<section id="cart_items">
	@if (session('message'))
		<div class="alert alert-success">
			{{ session('message') }}
		</div>
	@endif

	@if (session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
	@endif
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="step-one">
			<h2 class="heading">Step1</h2>
		</div>

		<div class="checkout-options">
			<h3>New User</h3>
			<p>Checkout options</p>
			<ul class="nav">
				<li>
					<label><input type="checkbox"> Register Account</label>
				</li>
				<li>
					<label><input type="checkbox"> Guest Checkout</label>
				</li>
				<li>
					<a href=""><i class="fa fa-times"></i>Cancel</a>
				</li>
			</ul>
		</div><!--/checkout-options-->

		<div class="register-req">
			<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
		</div><!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				@if(!Auth::check())
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form method="POST" enctype="multipart/form-data" action="{{ url('/checkout/register') }}">
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

								<button type="submit" class="btn btn-primary">Signup</button>

							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
						</div>
					</div>
				@endif
				<div class="col-sm-5 clearfix">
					<div class="bill-to">
						<p>Bill To</p>
						<div class="form-one">
							<form>
								<input type="text" placeholder="Company Name">
								<input type="text" placeholder="Email*">
								<input type="text" placeholder="Title">
								<input type="text" placeholder="First Name *">
								<input type="text" placeholder="Middle Name">
								<input type="text" placeholder="Last Name *">
								<input type="text" placeholder="Address 1 *">
								<input type="text" placeholder="Address 2">
							</form>
						</div>
						<div class="form-two">
							<form>
								<input type="text" placeholder="Zip / Postal Code *">
								<select>
									<option>-- Country --</option>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								<select>
									<option>-- State / Province / Region --</option>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								<input type="password" placeholder="Confirm password">
								<input type="text" placeholder="Phone *">
								<input type="text" placeholder="Mobile Phone">
								<input type="text" placeholder="Fax">
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="order-message">
						<p>Shipping Order</p>
						<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
						<label><input type="checkbox"> Shipping to bill address</label>
					</div>	
				</div>					
			</div>
		</div>

		<div class="review-payment">
			<h2>Review & Payment</h2>
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
					@if($cart)
						@foreach ($cart as $value)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{asset('/upload/product/'.$value['id_user'].'/hinh85_'. $getArrImage[$value['id']][0]) }}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$value['name']}}</a></h4>
									<p>Web ID: {{$value['id']}}</p>
								</td>
								<td class="cart_price">
									<p>${{ floor($value['price']) }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<!-- <a class="cart_quantity_up" href=""> + </a> -->
										<input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2">
										<!-- <a class="cart_quantity_down" href=""> - </a> -->
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">${{ floor($value['price']) * $value['qty'] }}</p>
								</td>
								<!-- <td class="cart_delete">
									<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
								</td> -->
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
					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								<tr>
									<td>Cart Sub Total</td>
									<td> ${{$totalprice}}</td>
								</tr>
								<tr>
									<td>Exo Tax</td>
									<td> ${{round($totalprice * 0.08)}}</td>
								</tr>
								<tr class="shipping-cost">
									<td>Shipping Cost</td> 
									<td> Free</td>										
								</tr>
								<tr>
									<td>Total</td>
									<td><span> ${{$totalprice + round($totalprice * 0.08)}}</span></td>
								</tr>
								<!-- <tr>
									<td><button type="submit" class="">Checkout</button></td>
								</tr> -->
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="payment-options">
			<span>
				<label><input type="checkbox"> Direct Bank Transfer</label>
			</span>
			<span>
				<label><input type="checkbox"> Check Payment</label>
			</span>
			<span>
				<label><input type="checkbox"> Paypal</label>
			</span>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection