@extends('Frontend.layout.master')

@section('content')

	<div class="col-sm-9">
		<!-- ------------------------------------------------ -->
		<div class="blog-post-area">
			<h2 class="title text-center">Latest From our Blog</h2>
			<div class="single-blog-post">
				<h3>{{$blog['title']}}</h3>
					<div class="post-meta">
						<ul>
							<li><i class="fa fa-user"></i> Mac Doe</li>
							<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
							<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
						</ul>
						<!-- <span>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
						</span> -->
					</div>
					<a href="">
						<img src="{{ asset('upload/user/blog/'.$blog['image']) }}" alt="">
					</a>
					<p>
						{!! $blog['content'] !!}
					</p>
					<div class="pager-area">
						<ul class="pager pull-right">
							<li><a href="#">Pre</a></li>
							<li><a href="#">Next</a></li>
						</ul>
				</div>
			</div>
		</div>
		<!----------------/blog-post-area----------------------->

		<div class="rating-area">
			<ul class="ratings">
				<li class="rate-this">Rate this item:</li>
				<li>
					<div class="rate">
						<div class="vote">
							@for ($i = 1; $i < 6; $i++)
								<div class="star_{{$i}} ratings_stars" ><input value="{{$i}}" type="hidden"></div>
							@endfor
								<span class="rate-np">{{$average}}</span>
						</div> 
					</div>
				</li>
				<li class="color">({{$count}} votes)</li>
			</ul>
			<ul class="tag">
				<li>TAG:</li>
				<li><a class="color" href="">Pink <span>/</span></a></li>
				<li><a class="color" href="">T-Shirt <span>/</span></a></li>
				<li><a class="color" href="">Girls</a></li>
			</ul>
		</div><!--/rating-area-->
					
		<div class="socials-share">
			<a href=""><img src="{{ asset('Frontend/images/blog/socials.png') }}" alt=""></a>
		</div><!--/socials-share-->

		<!-- <div class="media commnets">
			<a class="pull-left" href="#">
				<img class="media-object" src="images/blog/man-one.jpg" alt="">
			</a>
			<div class="media-body">
				<h4 class="media-heading">Annie Davis</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				<div class="blog-socials">
					<ul>
						<li><a href=""><i class="fa fa-facebook"></i></a></li>
						<li><a href=""><i class="fa fa-twitter"></i></a></li>
						<li><a href=""><i class="fa fa-dribbble"></i></a></li>
						<li><a href=""><i class="fa fa-google-plus"></i></a></li>
					</ul>
					<a class="btn btn-primary" href="">Other Posts</a>
				</div>
			</div>
		</div> --><!--Comments-->

		<div class="response-area">
			<h2>3 RESPONSES</h2>
			<ul class="media-list">
			<!-- -------------------------------CMT CHA------------------------------- -->
				<?php
					foreach ($comment as $parent){
						if ($parent['level'] == 0){
							$hour = date('H:i', strtotime($parent['created_at']));
							$date = date('M j, Y', strtotime($parent['created_at']));
				?>
					<li class="media" id="comment-{{ $parent['id'] }}">
						<a class="pull-left" href="#">
							<img class="media-object" src="" alt="Avatar">
						</a> 
						<div class="media-body">
							<ul class="sinlge-post-meta">
								<li><i class="fa fa-user"></i>{{$parent["user_name"]}}</li>
								<li><i class="fa fa-clock-o"></i> {{ $hour }} pm</li>
								<li><i class="fa fa-calendar"></i> {{$date}}</li>
							</ul>
							<p>{{$parent["comment"]}}</p>
							<a class="btn btn-primary replycmt" id = "{{ $parent['id'] }}" href=""><i class="fa fa-reply"></i> Replay</a>
							<div class="replay-box {{ $parent['id'] }}" style="display: none;" >
								<div class="row">
									<div class="col-sm-12">
										<h2>Leave a replay</h2>		
										<div class="text-area"  >
											<div class="blank-arrow">
												<label>Your Name</label>
											</div>
											<span>*</span>
											<textarea name="message" class="comment" rows="11"></textarea>
											<a class="btn btn-primary submitcmt" href="" id = "{{ $parent['id'] }}">Post comment</a>
										</div>
									</div>
								</div>
						</div>
					</li>

							
						<!-- ------------------------------------------------------------------------>

						<!-- ---------------------------------CMT CON----------------------------- -->
						 <?php
							
								}

						 	foreach ($comment as $children){
								if ($children['level'] == $parent['id']){
									$hourcon = date('H:i', strtotime($parent['created_at']));
									$datecon = date('M j, Y', strtotime($parent['created_at']));
						 ?>
							<li class="media second-media">
								<a class="pull-left" href="">
								<!-- <img class="media-object" src="{{ asset('upload/user/avatar/' . $children['avatar']) }}" alt="Avatar"> -->
								<img class="media-object" src="" alt="Avatar">
								</a> 
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{$children["user_name"]}}</li>
										<li><i class="fa fa-clock-o"></i> {{ $hourcon }} pm</li>
										<li><i class="fa fa-calendar"></i> {{ $datecon }}</li>
									</ul>
									<p>{{$children["comment"]}}</p>
									<!-- <a class="btn btn-primary repCha" href="" ><i class="fa fa-reply"></i> Replay</a> -->
								</div>
							</li>
								
							<?php
								}
							}
							}
							?>

							<!-- ------------------------------------------------------------------->

						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								
								<div class="text-area">
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<textarea name="message" class="comment" rows="11"></textarea>
									<a class="btn btn-primary submitcmt" id="" href="">post comment</a>
								</div>

							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
			



<link type="text/css" rel="stylesheet" href="{{ asset('Frontend/css/rate.css') }}"> 

<script>  
    	   
    $(document).ready(function(){
	
	/* -------------------------------------------Rate------------------------------------------ */

		$(".star_{{$average}}").prevAll().andSelf().addClass('ratings_over');
		
		$.ajaxSetup({
                headers: { 

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                }
		})

			//vote
		$('.ratings_stars').hover(
	        // Handles the mouseover
	        function() {
	            $(this).prevAll().andSelf().addClass('ratings_hover');
	            // $(this).nextAll().removeClass('ratings_vote'); 
	        },
	        function() {
	            $(this).prevAll().andSelf().removeClass('ratings_hover');
	            // set_votes($(this).parent());
	        }
	    );

		$('.ratings_stars').click(function(){

			var checkLogin = "{{Auth::Check()}}";
            //alert(checkLogin); ok

			if(checkLogin){
				var Values =  $(this).find("input").val();
				var element = $(this);

				$.ajax({
					type:'POST',
					url:'{{url("/blog/rate/ajax")}}', 
					data:{
							rate: Values,
							id_blog: "{{$blog["id"]}}" ,
							},
					
						success:function(data){
							var response = data.x;

							//console.log(response);

							if(response == 0){
								
								alert("You can only rate this article once.");

							}else{

								if (element.hasClass('ratings_over')) {

									$('.ratings_stars').removeClass('ratings_over');
									element.prevAll().andSelf().addClass('ratings_over');

								} else {
									element.prevAll().andSelf().addClass('ratings_over');
								}  

								$('.rate-np').text(Values);

							}
							
						}
				})

			}else{
                    alert("Please login to rate");
            }
		});
	/* ------------------------------------------endrate---------------------------------------- */

	//Xuất hiện ô reply cmt
	$('a.replycmt').click(function(){

		event.preventDefault();
		var id = $(this).attr('id');
		//alert (id);
		$(`.replay-box.${id}`).toggle();  

	}) 

	$('a.submitcmt').click(function(){

		event.preventDefault();
		//console.log("Hello"); =>ok

		var checkLogin = "{{Auth::Check()}}";
		if(checkLogin){

		//var comment = $('textarea[name="message"]').val();
		var comment = $(this).closest(".text-area").find('textarea.comment').val();
		var id = $(this).attr('id');
		//alert(id);
		
		$.ajax({

			type:'POST',
			url:'{{url("/blog/comment/ajax")}}', 
			data:{
				comment: comment,
				id_blog: "{{$blog["id"]}}",
				level: id ? id : 0
			},

		success:function(data){
			//console.log(data);
			var response = data.commentinfo;
			var fulldate = new Date();
			var time = fulldate.getHours() + ":" + new Date().getMinutes();
			var date = fulldate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }); 

			var img = "{{ asset('upload/avatar/')}}" + "/" + response.avatar;

			if(response.level == 0){
				var className = "media";
			}else{
				var className = "media second-media" 
			}
			//console.log(response.level);

			var html = "<li class='" + className + "'>" +
							"<a class='pull-left' href=''>" +
								"<img class='media-object' src='"+ img +"' alt='Avatar'>" +
							"</a>" +
								"<div class='media-body'>" +
									"<ul class='sinlge-post-meta'>" +
										"<li><i class='fa fa-user'></i>" + response.user_name + "</li>" +
										"<li><i class='fa fa-clock-o'></i>" + time + "</li>" +
										"<li><i class='fa fa-calendar'></i>" + date + "</li>" +
									"</ul>" +
									"<p>" + response.comment +" </p>" +
									"<a class='btn btn-primary' href=''><i class='fa fa-reply'></i>Replay</a>" +
								"</div>" +
						"</li>";
			//console.log(html)

			if(response.level == 0){

				$('.media-list').prepend(html);
				$('textarea[name="message"]').val('');

			}else{

				var className = '#comment-' + response.level;
				$(className).append(html);
				$(`.replay-box.${response.level}`).hide(); 

			}
			
		}

		}) 
		
	}else{
			alert("Please login to comment");
	}	
	
	}) 

	});
</script>
@endsection