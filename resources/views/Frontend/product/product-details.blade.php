@extends("Frontend.layout.master")

@section("content")
<div class="col-sm-9 padding-right">
	
	<div class="product-details"><!--product-details-->
		<!-- Xử lý hình ảnh ở đây -->
			<div class="col-sm-5">
				<div class="view-product">
					<img class = "bigimg" src="{{asset('upload/product/'. $product['id_user']. '/hinh329_' . $imgarr['0'])}}" alt="" />
					<a href="{{asset('upload/product/'. $product['id_user']. '/hinh329_' . $imgarr['0'])}}" rel="prettyPhoto"><h3>ZOOM</h3></a>
				</div>
				<div id="similar-product" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<!-- Bỏ những ảnh kích thước 85 của sản phẩm -->
						@for($i = 0; $i < 3; $i ++ )
							@if($i == 0)
								<div class="item active">
							@else
								<div class="item">
							@endif
									@foreach($imgarr as $value)
										<a href=""><img class = "smallimg" src="{{asset('upload/product/'. $product['id_user']. '/hinh85_' . $value)}}" alt=""></a>
									@endforeach
								</div>
						@endfor
				</div>

					<!-- Controls mũi tên qua lại-->
					<a class="left item-control" href="#similar-product" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a class="right item-control" href="#similar-product" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
			</div>

		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				<img src="{{asset('Frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
				<h2>{{$product['name']}}</h2>
				<p>Web ID: {{$product['id']}}</p>
				<img src="{{asset('Frontend/images/product-details/rating.png')}}" alt="" />
				<span>
					<span>US ${{number_format($product['price'])}}</span>
					<label>Quantity:</label>
					<input type="text" value="3" />
					<button type="button" class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</span>
				<p><b>Availability:</b> In Stock</p>
				<p><b>Condition:</b> New</p>
				<p><b>Brand:</b> {{$brand['name']}}</p>
				<a href=""><img src="{{asset('Frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
			</div><!--/product-information-->
		</div>

	</div><!--/product-details-->

	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li><a href="#details" data-toggle="tab">Details</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
				<li><a href="#tag" data-toggle="tab">Tag</a></li>
				<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
			</ul>
		</div>

		<div class="tab-content">
			<div class="tab-pane fade" id="details" >

				<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('Frontend/images/home/gallery1.jpg')}}" alt="" />{{asset('Frontend/images/home/gallery1.jpg')}}
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
						    </div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('Frontend/images/home/gallery2.jpg')}}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('Frontend/images/home/gallery3.jpg')}}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{asset('Frontend/images/home/gallery4.jpg')}}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			<div class="tab-pane fade" id="companyprofile" >
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{asset('Frontend/images/home/gallery1.jpg')}}" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{asset('Frontend/images/home/gallery3.jpg')}}" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{asset('Frontend/images/home/gallery2.jpg')}}" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{asset('Frontend/images/home/gallery4.jpg')}}" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
		</div>
							
		<div class="tab-pane fade" id="tag" >
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="{{asset('Frontend/images/home/gallery1.jpg')}}" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="{{asset('Frontend/images/home/gallery2.jpg')}}" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="{{asset('Frontend/images/home/gallery3.jpg')}}" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="{{asset('Frontend/images/home/gallery4.jpg')}}" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane fade active in" id="reviews" >
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				<p><b>Write Your Review</b></p>
				<form action="#">
					<span>
						<input type="text" placeholder="Your Name"/>
						<input type="email" placeholder="Email Address"/>
					</span>
					<textarea name="" ></textarea>
					<b>Rating: </b> <img src="{{asset('Frontend/images/product-details/rating.png')}}" alt="" />
					<button type="button" class="btn btn-default pull-right">
							Submit
					</button>
				</form>
			</div>
		</div>
		</div>
	
	</div><!--/category-tab-->
					
	<div class="recommended_items"><!--recommended_items-->
			<h2 class="title text-center">recommended items</h2>
				<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="item active">	
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('Frontend/images/home/recommend1.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('Frontend/images/home/recommend2.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('Frontend/images/home/recommend3.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">	
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('Frontend/images/home/recommend1.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset('Frontend/images/home/recommend2.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{asset('Frontend/images/home/recommend3.jpg')}}" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>			
				</div>
	</div><!--/recommended_items-->
					
</div>

<script>
	$(document).ready(function(){
		$('img.smallimg').click(function(){
			event.preventDefault();
			var src = $(this).attr('src').split('hinh85_').pop();

			//hình 329 tất cả đều bị bể
			var bigimgsrc = "{{ asset('upload/product/' . $product['id_user']) }}/hinh329_" + src;
			
			//console.log(bigimgsrc); 
			$('img.bigimg').attr('src',bigimgsrc);

			//link hình full
			var fullimg = "{{ asset('upload/product/' . $product['id_user']) }}/" + src;

			//Gán lại link cho pop up
			$('a[rel="prettyPhoto"]').attr('href',fullimg );
			//Đây là selector jQuery, chọn tất cả các thẻ <a> có thuộc tính rel="prettyPhoto"
		})

		$("a[rel='prettyPhoto']").prettyPhoto({//Hàm này khởi tạo plugin prettyPhoto trên các phần tử được chọn.
			/* theme: 'dark_rounded',
			social_tools: false */
    	});

	})
</script>

@endsection