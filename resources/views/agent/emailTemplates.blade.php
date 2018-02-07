@extends('agent.layouts.app')
@section('title', 'Udistro | Email Templates')

@section('content')

	<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
	<link href="https://vitalets.github.io/x-editable/assets/bootstrap/css/bootstrap.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<link href="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet"/>

	<script src="https://vitalets.github.io/x-editable/assets/bootstrap/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script src="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>
	<script src="https://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/wysihtml5/wysihtml5-0.0.2.js"></script>
	
	<script type="text/javascript">
	var elementPos = 20;
    $(document).ready(function(){
    	// $.fn.editable.defaults.mode = 'popup';
    	
    	$('#add_text_field').click(function()
    	{
    		var placeHolder = $(document.createElement('div')).css({
				border: '1px dashed',
				position: 'relative',
				// left: elementPos,
				width: '400', 
				height: '100', 
				padding: '3', 
				margin: '0'
			});

    		// Add the class to manage the css while sending the email
			$(placeHolder).addClass('email_component');

    		elementPos = elementPos + 25;

    		// Initialize the draggable and resizable on newly created placeholder
    		$(placeHolder).resizable().draggable({
		        // Restrict the dragging to parent div only
		        // containment: "parent"
    		}).append('Click here to enter text').appendTo("#email_template_content");

    		// Initialize the x-editable on newly created placeholder
    		$(placeHolder).editable({
    			type: 'wysihtml5',
				pk: 1,
				row: 3,
				placement: 'bottom'
    		});
    	});

    	// To render the image preview
		$("#file-input").change(function() {
          	readURL(this);
        });

        // To make social icon editable
        $('.x_editable').editable({
			type: 'wysihtml5',
			pk: 1,
			row: 3,
			placement: 'bottom'
		});

		// To make already existing placeholder draggable and resizable
		$('.x_editable, .drag_resize').resizable().draggable({
	        // Restrict the dragging to parent div only
	        // containment: "parent"
		});

		// Get the html
		$('#btn_preview').click(function() {

			let logo = $('#company_logo');
			var position = logo.position();

			console.log( position.left + ' : ' + position.top  );

			$('#preview_dialog').html( $('#email_template_container').html() );
			
			$('#preview_dialog').dialog({
				width: 800,
                height: 'auto'
			});

		});

		// To remove the div
    	$('#trash').droppable({
	        drop: function(event, ui) {
                $(ui.draggable).remove();
            }
	    });


	    // To send the testing email
	    $('#btn_agent_send_email').click(function(){

	    	let recipientEmail = $('#recipient_email').val();

	    	if( recipientEmail == '' )
	    	{
	    		alertify.error('Please enter email id');
	    		$('#recipient_email').focus();

	    		return false;
	    	}

	    	let htmlContent = $('#table_email_container').wrap('<div/>').parent().clone();

	    	$(htmlContent).find('.email_component').each(function(){

	    		// Get the top and left css property values
	    		var top 	= $(this).css('top');
	    		var left 	= $(this).css('left');

	    		// Remove the dashed border from all elements
	    		$(this).css('border', 'none');

	    		// Add the css
	    		$(this).css({
	    			'margin-top' : top,
	    			'margin-left' : left
	    		});

	    		// Remove the dashed border

	    		$(this).wrap( '<div class="wrapper"></div>' );
	    	});

	    	let content = $(htmlContent).html();

    		$.ajax({
    			url: $('meta[name="route"]').attr('content') + '/email',
    			method: 'post',
    			data: {
    				recipientEmail: recipientEmail,
    				content: content
    			},
    			headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    success: function(response){
			    	if( response.errCode == 0 )
			    	{
			    		alertify.success( response.errMsg );	
			    	}
			    	else
			    	{
			    		alertify.error( response.errMsg );
			    	}
			    }
    		});

	    });

    });

    /*function readURL(input)
    {
      	if (input.files && input.files[0])
      	{
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#logo_image').attr('src', e.target.result);
            }

        	reader.readAsDataURL(input.files[0]);
      	}
    }*/
    </script>

    <!-- Dialog to show preview -->
	<div id="preview_dialog" title="Preview" style="display: none; width: 800px; overflow: hidden;"></div>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Email Templates</h1>
        </div>
    </div>
    <div class="row">

    	<div id="exTab2" class="">	
    		<ul class="nav nav-tabs">
    			<?php
    			// Check if any email template categories is available
    			if( isset( $emailTemplateCategories ) && count( $emailTemplateCategories ) > 0 )
    			{
    				$step = 1;
    				foreach( $emailTemplateCategories as $emailTemplateCategory )
    				{
    				?>
    					<li class="{{ ( $step == 1 ) ? 'active' : '' }}"><a href="#{{ $step }}" data-toggle="tab">{{ ucwords( strtolower( $emailTemplateCategory->name ) ) }}</a></li>
    				<?php
    					$step++;
    				}
    			}
    			?>
			</ul>
			<div class="tab-content">
			  	<?php
    			// Check if any email template categories is available
    			if( isset( $emailTemplateCategories ) && count( $emailTemplateCategories ) > 0 )
    			{
    				$step = 1;
    				foreach( $emailTemplateCategories as $emailTemplateCategory )
    				{
    				?>
    					<div class="tab-pane {{ ( $step == 1 ) ? 'active' : '' }}" id="{{ $step }}">
							
    						<div>
    							<!-- Email template control panel -->
    							<div class="col-sm-3 col-md-3 col-lg-3">
    								<div>
	    								<h2>Control Panel</h2>
	    								<a href="javascript:void(0);" id="add_text_field" class="btn btn-primary">Add New Text Field</a>
	    								<br><br>
	    								<a href="javascript:void(0);" id="btn_preview" class="btn btn-primary">Preview</a>
	    							</div>

    								<div id="trash" style="height: 200px; width: 200px; background: url('https://thumb1.shutterstock.com/display_pic_with_logo/1176923/583110190/stock-vector-cartoon-crumpled-paper-and-trash-can-vector-illustration-583110190.jpg') no-repeat; background-size: cover;">
    								</div>

    								<!-- Recipient Email -->
    								<div>
    									<input type="email" name="recipient_email" id="recipient_email" placeholder="Email Id" value="">
    								</div>

    								<div>
    									<input type="button" name="btn_agent_send_email" id="btn_agent_send_email" class="btn btn-primary" value="Send Email">
    								</div>

    							</div>

    							<!-- Email template creation panel -->
							    <div class="col-sm-9 col-md-9 col-lg-9" style="margin-bottom: 50px;" id="email_container">

							        <div class="col-sm-12 col-md-12 col-lg-12" style="width: 100%;">
				                		<div class="text-center"><h3>Email Template</h3></div>
				                		<table style="width: 800px;" id="table_email_container">
				                			<tr>
				                				<td style="border: 1px dashed #cccccc;" id="email_template_container">

				                					<div id="email_template_content">

				                						<!-- Email template banner -->
				                						<div class="drag_resize email_component" style="text-align: center;">
				                							<img id="logo_image" src="{{ url('images/email-template-banner.jpg') }}" style="max-width: 780px;" class="image_editable">
				                						</div>

				                						<!-- Email template logo -->
				                						<div class="drag_resize email_component" style="text-align: center;">
				                							<img id="logo_image" src="{{ url('images/email-template-logo.jpg') }}" style="max-width: 780px;" class="image_editable">
				                						</div>

				                						<!-- Email template text header -->
				                						<div id="email_heading" class="x_editable email_component" style="height: 100px; border: 1px dashed;">
				                							Header
				                						</div>

				                						<!-- Email template text content -->
				                						<div id="email_content" class="x_editable email_component" style="height: 200px; border: 1px dashed;">
				                							Content
				                						</div>

				                					</div>

				                					<div style="padding-top: 50px; text-align: center;" id="social_links">
				            							<div style="display: inline-block;">
				            								<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
				            									<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook.png" alt="|" />
				            								</a>
				            							</div>
				            							<div style="display: inline-block;">
				            								<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
				            									<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter.png" alt="|" />
				            								</a>
				            							</div>
				            							<div style="display: inline-block;">
					            							<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
					            								<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-linkedin.png" alt="|" />
					            							</a>
				            							</div>
				            							<div style="display: inline-block;">
					            							<a href="javascript:void(0);" style="text-decoration: none; display: inline-block;" class="x_editable email_component">
					            								<img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-instagram.png" alt="|" />
					            							</a>
				            							</div>
				            						</div>

				                				</td>
				                			</tr>
				                		</table>
				                	</div>

							    </div>

    						</div>

						</div>
    				<?php
    					$step++;
    				}
    			}
    			?>
			</div>
    	</div>

    </div>
@endsection