<!DOCTYPE html>
<html>
<head>
	<title>Assign Rating</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="route" content="{{ url('/') }}">

    <link href="{{ URL::asset('css/movers/bootstrap.min.css') }}" rel="stylesheet">

	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>

	<script src="{{ URL::asset('js/movers/bootstrap.min.3.3.7.js') }}"></script>

	<script type="text/javascript">
	$(document).ready(function(){
		// To manage the star rating
		$(document).on('click', '.assign_rating', function(){
			// Get the start index
			let start = 0;
			
			let ratingCount = $(this).closest('.rating_container').attr('id');
			$('.assign_rating').attr('src', "{{ url('images/star-black.png') }}");
			$(this).closest('.rating_container').find('.assign_rating').slice(start, ratingCount).attr('src', "{{ url('images/star.png') }}");

			$('#rating').val(ratingCount);
		});

		// To save rating
		$('#btn_save_rating').click(function(){

			let rating 			= $('#rating').val();
			let companyId 		= $('#company_id').val();
			let moverId 		= $('#mover_id').val();
			let responseId 		= $('#response_id').val();
			let transactionId 	= $('#transaction_id').val();

			if( rating != '' )
			{
				$.ajax({
				    url: $('meta[name="route"]').attr('content') + '/saverating',
				    method: 'post',
				    data: {
				        rating: rating,
				        companyId: companyId,
				        moverId: moverId,
				        responseId: responseId,
				        transactionId: transactionId
				    },
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    success: function(response){
				        if( response.errCode == 0 )
				        {
				            // alertify.success( response.errMsg );
				            $('#service_response').find('.modal-header').html('Success');
				            $('#service_response').find('.modal-body').html(response.errMsg);
				            $('#service_response').modal('show');

				            // Refresh the rating data
				            $('.assign_rating').attr('src', "{{ url('images/star-black.png') }}");
				            $('#rating').val('');
				        }
				        else
				        {
				            // alertify.error( response.errMsg );
				            $('#service_response').find('.modal-header').html('Alert');
				            $('#service_response').find('.modal-body').html(response.errMsg);
				            $('#service_response').modal('show');
				        }
				    }
				});
			}
			else
			{
				// alertify.error('Please select rating');
				$('#service_response').find('.modal-header').html('Alert');
				$('#service_response').find('.modal-body').html('Please select rating');
				$('#service_response').modal('show');
			}
		});
	});
	</script>
	<style type="text/css">
		.ratingPart {
			box-sizing: border-box;
			-webkit-box-sizing: border-box;
			width: 20%;
			margin:0 auto;
		}

		.ratingPart a {
			color: #fff;	
			background: #2e63c1; 
			padding: 10px;	
			display: block;	
			margin-top: 20px; 
			font-size: 18px; 
			text-transform: uppercase; 
			text-decoration: navajowhite;	
			border-radius: 4px; 
			width: 100%;
		}

		.ratingPart h1 {
			text-align: center;
			margin:10px 0;
			padding: 0;
		}

		.rating-row {
			display: table;
			width: 100%;
			border:1px solid #ddd;
			padding: 10px;
			border-radius: 5px;
			margin-bottom: 10px;
		}

		.rating-part, .rating-star {
			text-align: left;
			display: table-cell;
		}

		.rating-part p {
			margin:0;
			padding: 0;
		}

		.rating-star {
			text-align: right;
		}
	</style>
</head>
<body>

	<!-- Server Response -->
	<div class="modal fade" id="service_response" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	            	
	            </div>
	            <div class="modal-body">
	            	
	            </div>
	            <div class="modal-footer">
	                <a style="width: 80px;" id="bt-modal-cancel" class="btn btn-success" href="javascript:void(0);" data-dismiss="modal">OK</a>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Server Response -->

	<div class="ratingPart">
		<h1>Assign rating</h1>
		<div class="rating-row">
			<div class="rating-part">
				<p>
					Excellent
				</p>
			</div>
			<div class="rating-star rating_container" id="5">
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			</div>
		</div>
		<div class="rating-row">
			<div class="rating-part">
				<p>
					Good
				</p>
			</div>
			<div class="rating-star rating_container" id="4">
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			</div>
		</div>
		<div class="rating-row">
			<div class="rating-part">
				<p>
					Average
				</p>
			</div>
			<div class="rating-star rating_container" id="3">
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			</div>
		</div>
		<div class="rating-row">
			<div class="rating-part">
				<p>
					Bad
				</p>
			</div>
			<div class="rating-star rating_container" id="2">
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			</div>
		</div>
		<div class="rating-row">
			<div class="rating-part">
				<p>
					Very Bad
				</p>
			</div>
			<div class="rating-star rating_container" id="1">
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			</div>
		</div>
		<input type="hidden" name="rating" id="rating" value="">
		<input type="hidden" name="company_id" id="company_id" value="{{ $companyId }}">
		<input type="hidden" name="mover_id" id="mover_id" value="{{ $moverId }}">
		<input type="hidden" name="response_id" id="response_id" value="{{ $responseId }}">
		<input type="hidden" name="transaction_id" id="transaction_id" value="{{ $transactionId }}">
		<a href="javascript:void(0);" id="btn_save_rating">
			confirm
		</a>
	</div>

	

</body>
</html>