<!DOCTYPE html>
<html>
<head>
	<title>Assign Rating</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="route" content="{{ url('/') }}">

	<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>

    <!-- JS Alert Plug-in -->
	<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>

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
				            alertify.success( response.errMsg );

				            // Refresh the rating data
				            $('.assign_rating').attr('src', "{{ url('images/star-black.png') }}");
				            $('#rating').val('');
				        }
				        else
				        {
				            alertify.error( response.errMsg );
				        }
				    }
				});
			}
			else
			{
				alertify.error('Please select rating');
			}
		});
	});
	</script>
</head>
<body>

	<table width="640" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 20px;  border: 2px solid #ddd; font-family:Verdana, Geneva, sans-serif; font-size:14px;">
	 <tr>
	  <td align="left" valign="top">&nbsp;</td>
	 </tr>
	 <tr>
	  <!-- <td align="left" valign="top">officia deserunt mollit anim id est laborum.</td> -->
	 </tr>
	 <tr>
	  <td align="left" valign="top">&nbsp;</td>
	 </tr>
	 <tr>
	  <td align="left" valign="top"><table width="640" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	     <td width="150">&nbsp;</td>
	     <td>
	     	<?php
	     	if( $params == true )
	     	{
	     	?>
		     	<table width="300" border="0" cellspacing="0" cellpadding="0">
			       <tr>
			        <td>
			        	<p style="border:1px solid #ddd; margin:0 0 5px 0; height:20px; line-height:20px; padding:10px; border-radius:3px;">
			        		<span style="float:left;">Excellent</span>
			        		<span style="float:right;" class="rating_container" id="5">
			        			<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			        			<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			        			<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			        			<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			        			<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			        		</span>
			        	</p>
			        </td>
			       </tr>
			       <tr>
			        <td>
			        	<p style="border:1px solid #ddd; margin:0 0 5px 0; height:20px; padding:10px; border-radius:3px;">
			        		<span style="float:left;">Good</span> 
			        		<span style="float:right;" class="rating_container" id="4"> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        	</span>
			        	</p>
			        </td>
			       </tr>
			       <tr>
			        <td>
			        	<p style="border:1px solid #ddd; margin:0 0 5px 0; height:20px; padding:10px; line-height:20px; border-radius:3px;">
			        		<span style="float:left;">Average</span>
			        		<span style="float:right;" class="rating_container" id="3">
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        	</span>
				        </p>
				    </td>
			       </tr>
			       <tr>
			        <td>
			        	<p style="border:1px solid #ddd; margin:0 0 5px 0; height:20px; padding:10px; line-height:20px; border-radius:3px;">
			        		<span style="float:left;">Bad</span>
			        		<span style="float:right;" class="rating_container" id="2">
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" /> 
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
			        		</span>
			        	</p>
			        </td>
			       </tr>
			       <tr>
			        <td>
			        	<p style="border:1px solid #ddd; margin:0 0 5px 0; height:20px; padding:10px; line-height:20px; border-radius:3px;">
			        		<span style="float:left;">Very Bad</span>
			        		<span style="float:right;" class="rating_container" id="1">
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        		<img src="{{ url('images/star-black.png') }}" alt="" class="assign_rating" />
				        	</span>
				        </p>
				    </td>
			       </tr>
			       <tr>
			        <td>&nbsp;</td>
			       </tr>
			       <tr>
			        <td align="center">
			        	<input type="hidden" name="rating" id="rating" value="">
			        	<input type="hidden" name="company_id" id="company_id" value="{{ $companyId }}">
			        	<input type="hidden" name="mover_id" id="mover_id" value="{{ $moverId }}">
			        	<input type="hidden" name="response_id" id="response_id" value="{{ $responseId }}">
			        	<input type="hidden" name="transaction_id" id="transaction_id" value="{{ $transactionId }}">

			        	<a style=" color: #fff;	background: #2e63c1; padding: 10px;	display: block;	margin-top: 20px; font-size: 18px; text-transform: uppercase; text-decoration: navajowhite;	border-radius: 4px;" href="javascript:void(0);" id="btn_save_rating">
			        		confirm
			        	</a>
			        </td>
			       </tr>
		      	</table>
	     	<?php
	     	}
	     	else
	     	{
	     	?>
	     		<table width="300" border="0" cellspacing="0" cellpadding="0">
			       	<tr>
			        	<td style="text-align: center;">
			        		<p>Incorrect Parameters</p>
			        	</td>
			    	</tr>
			    </table>
	     	<?php
	     	}
	     	?>
	  	</td>
	    </tr>
	   </table></td>
	 </tr>
	</table>

</body>
</html>