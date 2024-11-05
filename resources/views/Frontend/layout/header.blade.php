<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{ asset('Frontend/images/home/logo.png') }}" alt="" /></a> 
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								
								@auth 

								<li><a href="{{url('/account/update/')}}"><i class="fa fa-user"></i> Account</a></li>

								@endauth

								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="{{url('product/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>

								@auth 
									<li style="position: relative;"><a href="{{url('account/cart/list')}}">
										<i class="fa fa-shopping-cart"></i> Cart</a>
										<span id="cart-count" style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; border-radius: 50%; padding: 5px 8px; font-size: 12px; font-weight: bold; line-height: 1;">
										{{ $total ?? 0 }}
										</span>	
									</li>
									<li><a href="{{url('/member/logout/')}}"><i class="fa fa-lock"></i> Logout</a></li>
								@else
									<li><a href="{{url('/member/login/')}}"><i class="fa fa-lock"></i> Login</a></li>
								@endauth
																	
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/product/home') }}">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html" class="active">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
								<li><a href="{{ url('/product/search/advanced') }}">Search advanced</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="pull-right">
							<form action="{{ url('/product/search') }}" method="post" style="display: flex; align-items: center; position: relative; width: 100%; ">
							@csrf
								<input type="text" placeholder="Search" name="search" style="flex: 1; padding: 5px 5px 5px 5px; border: 1px solid #ccc; border-radius: 5px; outline: none; transition: 0.2s ease-in;"/>
								<button type="submit" style="position: absolute; top: 5px; right: 5px; background-color: orange; border: none; ">
									<i class="fa fa-search" style="font-size: 16px; color: rgba(0, 0, 0, 0.3); font-weight: 50;"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
</header><!--/header-->