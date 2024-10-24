@extends("Frontend.layout.master")

@section("content")

	<div class="col-sm-9" id="cart_items">
		<div class="table-responsive cart_info">
			<table class="table table-condensed" style="font-size: 16px;">
				<thead>
					<tr class="cart_menu">
						<td class="image">IMAGE</td>
						<td class="description">NAME</td>
						<td class="price">PRICE</td>									
						<td class="total">ACTION</td>	
					</tr>
				</thead>
				<tbody>	
					@if($product)
						@foreach ($product as $value)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{asset('/upload/product/'.$value['id_user'].'/hinh85_'. $getArrImage[$value['id']][0]) }}" alt=""></a>
								</td> 
								<td class="cart_description">
									<h4 style="margin: 0; line-height: 1;"><a href="">{{$value['name']}}</a></h4>		
								</td>
								<td class="cart_price">
									<p style="margin: 0; line-height: 1;">${{ number_format($value['price'], 0) }}</p>
								</td>
								<td class="cart_total">
									<a href="{{asset('account/product/edit/'.$value['id'])}}">Edit</a>
									<a href="{{asset('account/product/delete/'.$value['id'])}}">Delete</a>
								</td>
							</tr>	
						@endforeach	
					@else
						<div class="text-center mt-5"> 
							<!-- text-center: Căn giữa nội dung văn bản (text) theo chiều ngang của vùng chứa.
							 	 "mt-5"     : Thêm khoảng cách trên (margin-top) cho phần tử để nó cách xa phần tử phía trên. -->
							<h2>There are no products.</h2>
							<p>Please return to <a href="{{ route('home') }}">Home</a> page to shop!</p>
							<img src="{{ asset('Frontend/images/cart/cart-empty.png') }}" alt="Empty Cart" class="img-fluid mt-4" style="max-width: 300px;">
							<!-- Trong Bootstrap (thư viện CSS phổ biến), các lớp như img-fluid và mt-4 được sử dụng để tạo kiểu cho ảnh và đảm bảo chúng hiển thị đẹp và tương thích trên mọi thiết bị. -->
						</div>
        			@endif
				</tbody>
			</table>
		</div>
	</div>

@endsection