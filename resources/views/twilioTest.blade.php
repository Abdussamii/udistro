<!DOCTYPE html>
<html>
<head>
	<title>Twilio Test</title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script type="text/javascript">
	$(document).ready(function(){
		$('#contactForm').on('submit', function(e) {
	        // Prevent submit event from bubbling and automatically submitting the form
	        e.preventDefault();

	        // Call our ajax endpoint on the server to initialize the phone call
	        $.ajax({
	            url: '{{ url("/") }}' + '/call',
	            method: 'POST',
	            dataType: 'json',
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
	            data: {
	                userPhone: $('#userPhone').val(),
	                salesPhone: $('#salesPhone').val()
	            }
	        }).done(function(data) {
	            // The JSON sent back from the server will contain a success message
	            // alert(data.message);
	            console.log( data.message );
	        }).fail(function(error) {
	            // alert(JSON.stringify(error));
	            console.log( JSON.stringify(error) );
	        });
        });
	});
	</script>
</head>
<body>

	<form id="contactForm" role="form">
		<div class="form-group">
			<h3>Call Sales</h3>
		</div>
        <label>Your number</label>
        <div class="form-group">
           <input class="form-control" type="text" name="userPhone" id="userPhone"
                  placeholder="(651) 555-7889">
        </div>
        <label>Sales team number</label>
        <div class="form-group">
           <input class="form-control" type="text" name="salesPhone" id="salesPhone"
                  placeholder="(651) 555-7889">
         </div>
		<button type="submit" class="btn btn-default">
			Contact Sales
		</button>
	</form>

</body>
</html>