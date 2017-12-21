@extends('agent.layouts.app')
@section('title', 'Udistro | Profile')

@section('content')
	<div class="container-fluid text-center">
 		<div class="col-lg-6 center-box">
  			<div class="col-lg-12">
   				<h1 class="page-header">Invite</h1>
  			</div>
  			<div class="col-lg-12 profile-box">
   				<ul class="nav nav-tabs">
    				<li class="active"><a data-toggle="tab" href="#profile">Information</a></li>
    				<li><a data-toggle="tab" href="#message">Brand</a></li>
    				<li><a data-toggle="tab" href="#template">Template</a></li>
   				</ul>
   				<div class="tab-content">
    				<div id="profile" class="tab-pane fade in active">
     					<div class="row top-buffer"> 
      						<!-- left column -->
      						<div class="col-md-12">
      							<form class="form-horizontal accordian" role="form" name="frm_agent_profile" id="frm_agent_profile" novalidate>
						        	<fieldset>
							         	<legend>Personal: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
									 	<div class="collapsbox" style="display:block;">
							         		<div class="form-group">
							          			<label class="col-lg-3 control-label">First name:</label>
							          			<div class="col-lg-8">
							           				<input class="form-control" value="{{ $agentDetails->fname or '' }}" name="agent_fname" id="agent_fname" type="text">
							          			</div>
							         		</div>
							         		<div class="form-group">
							          			<label class="col-lg-3 control-label">Last name:</label>
							          			<div class="col-lg-8">
							           				<input class="form-control" value="{{ $agentDetails->lname or '' }}" name="agent_lname" id="agent_lname" type="text">
							          			</div>
							         		</div>
							         		<div class="form-group">
							          			<label class="col-lg-3 control-label">Business name:</label>
							          			<div class="col-lg-8">
							           				<input class="form-control" value="{{ $agentDetails->bname or '' }}" name="agent_bname" id="agent_bname" type="text">
							          			</div>
							         		</div>
							         		<div class="form-group">
							          			<label class="col-lg-3 control-label">Gender:</label>
							          			<div class="col-lg-8">
													<div class="gender-box">
														<label class="control-label"> <input name="gender" value="1" checked="true" type="radio"> Male </label>
													</div>
										 			<div class="gender-box">
														<label class="control-label"><input name="gender" value="2" type="radio">Female</label>
										 			</div>
										 			<div class="gender-box">
														<label class="control-label"><input name="gender" value="3" type="radio">Others</label>
										 			</div>
							          			</div>
							         		</div>
							        		<div class="form-group">
							         			<label class="col-lg-3 control-label">&nbsp;</label>
							         			<div class="col-lg-8">
							          				<div class="ui-select">
							           					<button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
							          				</div>
							         			</div>
							        		</div>
										</div>
						        	</fieldset>
						       </form>

						       <form class="form-horizontal accordian" role="form" name="frm_agent_profile" id="frm_agent_profile" novalidate>
        							<fieldset>
         								<legend>Contact: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
		 								<div class="collapsbox" style="display:none;">
									       	<div class="form-group">
									        	<label class="col-lg-3 control-label">Email:</label>
									          	<div class="col-lg-8">
									           		<input class="form-control" value="mack123@gmail.com" name="agent_email" id="agent_email" type="text">
									          	</div>
									       	</div>
									       	<div class="form-group">
									        	<label class="col-lg-3 control-label">Phone Number:</label>
									          	<div class="col-lg-8">
									           		<input class="form-control" value="manon" name="phone_number" id="phone_number" type="text">
									          	</div>
									       	</div>
									       	<div class="form-group">
									        	<label class="col-lg-3 control-label">Extention Number:</label>
									          	<div class="col-lg-8">
									           		<input class="form-control" value="manon" name="ex_number" id="ex_number" type="text">
									          	</div>
									       	</div>
									       	<div class="form-group">
									        	<label class="col-lg-3 control-label">Fax:</label>
									          	<div class="col-lg-8">
									           		<input class="form-control" value="manon" name="fax" id="fax" type="text">
									          	</div>
									       	</div>
									       	<div class="form-group">
									        	<label class="col-lg-3 control-label">Website:</label>
									          	<div class="col-lg-8">
									           		<input class="form-control" value="https://mywebsite.com/login" name="agent_website" id="agent_website" type="text">
									          	</div>
									      	</div>
									        <div class="form-group">
									        	<label class="col-lg-3 control-label">&nbsp;</label>
									         	<div class="col-lg-8">
									          		<div class="ui-select">
									           			<button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
									          		</div>
									         	</div>
									       	</div>
										</div>
									</fieldset>
								</form>

								<form class="form-horizontal" role="form" name="frm_agent_address" id="frm_agent_address" novalidate>
							        <fieldset>
							        <legend>Address: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
										<div class="collapsbox" style="display: none;">
							         	<div class="form-group">
							          		<label class="col-lg-3 control-label">Address:</label>
							          		<div class="col-lg-8">
							           			<input name="agent_address" id="agent_address" class="form-control" value="Sea side, 121 street" placeholder="Enter a location" autocomplete="off" type="text">
							          		</div>
							         	</div>
							         	<div class="form-group">
							          		<label class="col-lg-3 control-label">Province:</label>
							          		<div class="col-lg-8">
							           			<div class="ui-select">
							            			<select id="user_time_zone" class="form-control" name="agent_province">
							             				<option value="">Select</option>
							             				<option value="1">Alberta</option>
							            			</select>
							           			</div>
							          		</div>
							         	</div>
							         	<div class="form-group">
							          		<label class="col-lg-3 control-label">City:</label>
							          		<div class="col-lg-8">
							           			<div class="ui-select">
							            			<select id="user_time_zone" class="form-control" name="agent_city">
							             				<option value="">Select</option>
							             				<option value="19">Abbotsford</option>
							            			</select>
							           			</div>
							          		</div>
							         	</div>
							         	<div class="form-group">
							          		<label class="col-lg-3 control-label">Postal Code:</label>
							          		<div class="col-lg-8">
							           			<input class="form-control" value="123 456" name="agent_postalcode" id="agent_postalcode" type="text">
							          		</div>
							         	</div>
							         	<div class="form-group">
							          		<label class="col-lg-3 control-label">Country:</label>
							          		<div class="col-lg-8">
							           			<div class="ui-select">
							            			<select id="user_time_zone" class="form-control" name="agent_country">
							             				<option value="1" selected="">Canada</option>
							            			</select>
							           			</div>
							          		</div>
							         	</div>
							        	<div class="form-group">
							         		<label class="col-lg-3 control-label">&nbsp;</label>
							         		<div class="col-lg-8">
							          			<div class="ui-select">
							           				<button type="submit" class="btn btn-primary" name="btn_update_agent_address" id="btn_update_agent_address">Submit</button>
							          			</div>
							         		</div>
							        	</div>
							        </fieldset>
							   	</form>

							   	<form class="form-horizontal" role="form" name="frm_agent_social" id="frm_agent_social">
							        <fieldset>
							       		<legend>Social: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
										<div class="collapsbox" style="display: none;">
								        	<div class="form-group">
								          		<label class="col-lg-3 control-label">Facebook:</label>
								          		<div class="col-lg-8">
								           			<input class="form-control" value="https://twitter.com/login" name="agent_twitter" id="agent_twitter" type="text">
								          		</div>
								         	</div>
								         	<div class="form-group">
								          		<label class="col-lg-3 control-label">Twitter:</label>
								          		<div class="col-lg-8">
								           			<input class="form-control" value="https://twitter.com/login" name="agent_twitter" id="agent_twitter" type="text">
								          		</div>
								         	</div>
								         	<div class="form-group">
								          		<label class="col-lg-3 control-label">LinkedIn:</label>
								          		<div class="col-lg-8">
								           			<input class="form-control" value="https://linkedin.com/login" name="agent_linkedin" id="agent_linkedin" type="text">
								          		</div>
								         	</div>
								         	<div class="form-group">
								          		<label class="col-lg-3 control-label">Goggle Plus:</label>
								          		<div class="col-lg-8">
								           			<input class="form-control" value="https://twitter.com/login" name="agent_twitter" id="agent_twitter" type="text">
								          		</div>
								         	</div>
								         	<div class="form-group">
								          		<label class="col-lg-3 control-label">Skype:</label>
								          		<div class="col-lg-8">
								           			<input class="form-control" value="https://facebook.com/login" name="agent_facebook" id="agent_facebook" type="text">
								          		</div>
								         	</div>
								         	<div class="form-group">
								          		<label class="col-lg-3 control-label">Instagram:</label>
								          		<div class="col-lg-8">
								           			<input class="form-control" value="https://twitter.com/login" name="agent_twitter" id="agent_twitter" type="text">
								          		</div>
								         	</div>
								        	<div class="form-group">
								         		<label class="col-lg-3 control-label">&nbsp;</label>
								         		<div class="col-lg-8">
								          			<div class="ui-select">
								           				<button type="submit" class="btn btn-primary" name="btn_update_agent_social" id="btn_update_agent_social">Submit</button>
								          			</div>
								         		</div>
								        	</div>
										</div>
								  	</fieldset>
								</form>
							</div>
						</div>
					</div>

					<div id="message" class="tab-pane fade">
				    	<div class="profile-wrap">
				      		<form class="form-horizontal" role="form" name="frm_agent_image" id="frm_agent_image">
				       			<div class="profile-box text-center"> 
				        			<div class="profile-pic-box">
				        				<?php
										if( $agentDetails->image != '' )
										{
											echo '<img src="'. url('/images/agents/' . $agentDetails->image) .'" id="agent_profile_image" height="" width="" class="avatar img-circle" alt="avatar">';
										}
										else
										{
											echo '<img src="'. url('/images/no_image.jpg') .'" id="agent_profile_image" height="" width="" class="avatar img-circle" alt="avatar">';
										}
										?>
										<div class="edit-profile-pic">
											<label for="agent_upload_image"><i class="fa fa-pencil" aria-hidden="true"></i></label>
												<input type="file" id="agent_upload_image" name="agent_upload_image" accept="image/*" style="display: none">
										</div>
									</div>
				        			<div class="top-buffer"> 
				         				<!-- To upload image -->
						 				<div class="sub-can-box">
							 				<button type="submit" class="btn btn-primary" name="btn_update_agent_image" id="btn_update_agent_image">Save</button>
							 				<button type="submit" class="btn btn-primary" name="btn_update_agent_image" id="btn_update_agent_image">Cancel</button>
						 				</div>
				        			</div>
				       			</div>
				      		</form>
				     	</div>
				     	<div class="message-box">
				      		<h3>Message</h3>
				      		<form class="form-horizontal" role="form" name="frm_agent_message" id="frm_agent_message" novalidate>
				       			<div class="form-group">
				        			<div class="col-lg-12">
				         				<textarea class="form-control" rows="10" name="agent_message" id="agent_message"></textarea>
				        			</div>
				       			</div>
				       			<div>
				        			<div class="ui-select">
				         				<button type="submit" class="btn btn-primary" name="btn_update_agent_message" id="btn_update_agent_message">Submit</button>
				        			</div>
				       			</div>
				      		</form>
				     	</div>
				   	</div>

				   	<div id="template" class="tab-pane fade">
					    <div class="email-template-wrap">
					    	<form class="form-horizontal" role="form" name="frm_agent_email_template" id="frm_agent_email_template" novalidate>
					       		<div class="form-group">
					        		<div class="col-lg-12"> 
					         			<div class="template-select">
					          				<label class="control-label">
					           					<input name="agent_email_template" value="1" checked="true" type="radio">Template 1
					           				</label>
					         			</div>
					         			<div class="template-select">
					          				<label class="control-label">
					           					<input name="agent_email_template" value="2" type="radio">Template 2
					           				</label>
					         			</div>
					         			<label id="agent_email_template-error" class="error" for="agent_email_template"></label>
					        		</div>
					       		</div>
					       		<div>
					        		<h4>Template Preview</h4>
					        		<div id="email_template_preview" style="min-height: 500px; width:600px;">
					         			<table style="text-align: center;">
					          				<tbody>
					           					<tr>
					            					<td style="width: 100%; text-align: justify;">[content]</td>
					           					</tr>
					          				</tbody>
					         			</table>
					        		</div>
					       		</div>
					       		<div class="top-buffer">
					        		<div class="ui-select">
					         			<button type="submit" class="btn btn-primary" name="btn_update_agent_email_template" id="btn_update_agent_email_template">Submit</button>
					        		</div>
					       		</div>
					   		</form>
						</div>
					</div>

					<br />
				</div>
			</div>
		</div>
	</div>

<!-- Google map address auto-complete --> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE&libraries=places&callback=initMap" async defer></script> 
<script type="text/javascript">
	// For agent address
	function initMap() {
	  	new google.maps.places.Autocomplete(
	    (document.getElementById('agent_address')), {
	      types: ['geocode']
	    });

	    new google.maps.places.Autocomplete(
	    (document.getElementById('agent_company_address')), {
	      types: ['geocode']
	    });
	}
/*Toggle*/
 $(document).ready(function(){
    $('.tab-content .collapsbox').hide();
    $('.tab-content legend:first').addClass('active').next().slideDown('slow');
    $('.tab-content legend').click(function() {
        if($(this).next().is(':hidden')) {
            $('.tab-content legend').removeClass('active').next().slideUp('slow');
            $(this).toggleClass('active').next().slideDown('slow');
        }
    });
});
</script>
@endsection