<?php $__env->startSection('title', 'Udistro | Profile'); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile</h1>
        </div>
    </div>

    <ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
		<li><a data-toggle="tab" href="#message">Message</a></li>
		<li><a data-toggle="tab" href="#template">Email Template</a></li>
	</ul>

	<div class="tab-content">
		<div id="profile" class="tab-pane fade in active">
			<div class="row top-buffer">
				<!-- left column -->
				<div class="col-md-8">
					<form class="form-horizontal" role="form" name="frm_agent_profile" id="frm_agent_profile">
						<fieldset>
  							<legend>Personal Information:</legend>
							<div class="form-group">
								<label class="col-lg-2 control-label">Email:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->email) ? $agentDetails->email : ''); ?>" name="agent_email" id="agent_email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">First name:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->fname) ? $agentDetails->fname : ''); ?>" name="agent_fname" id="agent_fname">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Last name:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->lname) ? $agentDetails->lname : ''); ?>" name="agent_lname" id="agent_lname">
								</div>
							</div>
						</fieldset>
						<div class="form-group">
							<label class="col-lg-2 control-label">&nbsp;</label>
							<div class="col-lg-8">
							  	<div class="ui-select">
								    <button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
							  	</div>
							</div>
						</div>
					</form>
					<form class="form-horizontal" role="form" name="frm_agent_address" id="frm_agent_address">
						<fieldset>
  							<legend>Address Information:</legend>
  							<div class="form-group">
								<label class="col-lg-2 control-label">Address:</label>
								<div class="col-lg-8">
								  	<input type="text" name="agent_address" id="agent_address" class="form-control" value="<?php echo e(isset($agentDetails->address) ? $agentDetails->address : ''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Province:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_province" id="agent_province">
											<option value="">Select</option>
											<?php
											if( isset( $provinces ) &&  count( $provinces ) > 0 )
											{
												foreach ($provinces as $province)
												{
													if($agentDetails->province_id == $province->id) 
														$selected = 'selected';
													else
														$selected = ''; 
													echo '<option value="'. $province->id .'" '.$selected.'>'. ucwords( strtolower( $province->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">City:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_city" id="agent_city">
											<option value="">Select</option>
											<?php
											if( isset( $cityArray ) &&  count( $cityArray ) > 0 )
											{
												foreach ($cityArray as $city)
												{
													if($agentDetails->city_id == $city['id']) 
														$selected = 'selected';
													else
														$selected = ''; 
													echo '<option value="'. $city['id'] .'" '.$selected.'>'. ucwords( strtolower( $city['city'] ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Postal Code:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->postalcode) ? $agentDetails->postalcode : ''); ?>" name="agent_postalcode" id="agent_postalcode">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Country:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_country" id="agent_country">
											<?php
											if( isset( $countries ) &&  count( $countries ) > 0 )
											{
												foreach ($countries as $country)
												{
													if($agentDetails->country_id == $country->id) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $country->id .'" '.$selected.'>'. ucwords( strtolower( $country->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
						</fieldset>
						<div class="form-group">
							<label class="col-lg-2 control-label">&nbsp;</label>
							<div class="col-lg-8">
							  	<div class="ui-select">
								    <button type="submit" class="btn btn-primary" name="btn_update_agent_address" id="btn_update_agent_address">Submit</button>
							  	</div>
							</div>
						</div>
					</form>
					<form class="form-horizontal" role="form" name="frm_agent_social" id="frm_agent_social">
						<fieldset>
							<legend>Social Information:</legend>
							<div class="form-group">
								<label class="col-lg-2 control-label">Twitter:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->twitter) ? $agentDetails->twitter : ''); ?>" name="agent_twitter" id="agent_twitter">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">LinkedIn:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->linkedin) ? $agentDetails->linkedin : ''); ?>" name="agent_linkedin" id="agent_linkedin">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Skype:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->skype) ? $agentDetails->skype : ''); ?>" name="agent_facebook" id="agent_facebook">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Website:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($agentDetails->website) ? $agentDetails->website : ''); ?>" name="agent_website" id="agent_website">
								</div>
							</div>
						</fieldset>
						<div class="form-group">
							<label class="col-lg-2 control-label">&nbsp;</label>
							<div class="col-lg-8">
							  	<div class="ui-select">
								    <button type="submit" class="btn btn-primary" name="btn_update_agent_social" id="btn_update_agent_social">Submit</button>
							  	</div>
							</div>
						</div>
					</form>
					<form class="form-horizontal" role="form" name="frm_agent_company" id="frm_agent_company">
						<fieldset>
  							<legend>Company Information:</legend>
  							<div class="form-group">
								<label class="col-lg-2 control-label">Company Name:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($companyDetails[0]->company_name) ? $companyDetails[0]->company_name : ''); ?>" name="agent_company_name" id="agent_company_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Company Category:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_category" id="agent_company_category">
											<?php
											if( isset( $companyCategories ) &&  count( $companyCategories ) > 0 )
											{
												foreach ($companyCategories as $category)
												{
													if($companyDetails[0]->country_id == $country->id) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $category->id .'" '.$selected.'>'. ucwords( strtolower( $category->category ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Address:</label>
								<div class="col-lg-8">
								  	<!-- <textarea class="form-control autocomplete" name="agent_company_address" id="agent_company_address"><?php echo e(isset($companyDetails[0]->address) ? $companyDetails[0]->address : ''); ?></textarea> -->
								  	<input type="text" name="agent_company_address" id="agent_company_address" class="form-control" value="<?php echo e(isset($companyDetails[0]->address) ? $companyDetails[0]->address : ''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Province:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_province" id="agent_company_province">
											<option value="">Select</option>
											<?php
											if( isset( $provinces ) &&  count( $provinces ) > 0 )
											{
												foreach ($provinces as $province)
												{
													if($companyDetails[0]->province_id == $province->id) 
														$selected = 'selected';
													else
														$selected = ''; 
													echo '<option value="'. $province->id .'" '.$selected.'>'. ucwords( strtolower( $province->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">City:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_city" id="agent_company_city">
											<option value="0">Select</option>
											<?php
											if( isset( $cityArray ) &&  count( $cityArray ) > 0 )
											{
												foreach ($cityArray as $city)
												{
													if($companyDetails[0]->city_id == $city['id']) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $city['id'] .'" '.$selected.'>'. ucwords( strtolower( $city['city'] ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Postal Code:</label>
								<div class="col-lg-8">
								  	<input class="form-control" type="text" value="<?php echo e(isset($companyDetails[0]->postal_code) ? $companyDetails[0]->postal_code : ''); ?>" name="agent_company_postalcode" id="agent_company_postalcode">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Country:</label>
								<div class="col-lg-8">
								  	<div class="ui-select">
									    <select id="user_time_zone" class="form-control" name="agent_company_country" id="agent_company_country">
											<?php
											if( isset( $countries ) &&  count( $countries ) > 0 )
											{
												foreach ($countries as $country)
												{
													if($agentDetails->country_id == $country->id) 
														$selected = 'selected';
													else
														$selected = '';
													echo '<option value="'. $country->id .'" '.$selected.'>'. ucwords( strtolower( $country->name ) ) .'</option>';
												}
											}
											?>
									    </select>
								  	</div>
								</div>
							</div>
  						</fieldset>
  						<div class="form-group">
							<label class="col-lg-2 control-label">&nbsp;</label>
							<div class="col-lg-8">
							  	<div class="ui-select">
								    <button type="submit" class="btn btn-primary" name="btn_update_agent_company" id="btn_update_agent_company">Submit</button>
							  	</div>
							</div>
						</div>
  					</form>
				</div>
				<div class="col-md-4">
					<form class="form-horizontal" role="form" name="frm_agent_image" id="frm_agent_image">
						<div class="text-center">
							<!-- <img src="<?php echo e(isset($agentDetails->image) ? $agentDetails->image : url('/images/no_image.jpg')); ?>" id="agent_profile_image" class="avatar img-square" alt="avatar"> -->

							<?php
							if( $agentDetails->image != '' )
							{
								echo '<img src="'. url('/images/agents/' . $agentDetails->image) .'" id="agent_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">';
							}
							else
							{
								echo '<img src="'. url('/images/no_image.jpg') .'" id="agent_profile_image" height="150px" width="150px" class="avatar img-square" alt="avatar">';
							}
							?>

							<div class="top-buffer">
								<!-- To upload image -->
								<label for="agent_upload_image" class="">Select File <i class="fa fa-file-image-o" aria-hidden="true"></i></label>
								<input type="file" id="agent_upload_image" name="agent_upload_image" accept="image/*" style="display: none">
								<button type="submit" class="btn btn-primary" name="btn_update_agent_image" id="btn_update_agent_image">Upload</button>

								<div><label id="agent_upload_image-error" class="error" for="agent_upload_image"></label></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="message" class="tab-pane fade">
			<h3>Message</h3>
			<div>
				<form class="form-horizontal" role="form" name="frm_agent_message" id="frm_agent_message">
					<div class="form-group">
						<div class="col-lg-4">
						  	<textarea class="form-control" rows="10" name="agent_message" id="agent_message"><?php echo e($message->message); ?></textarea>
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
			<h3>Email Template</h3>
			<div>
				<form class="form-horizontal" role="form" name="frm_agent_email_template" id="frm_agent_email_template">
					<div class="form-group">
						<div class="col-lg-4">
						  	<!-- List of templates -->
						  	<?php
						  	if( isset( $templates ) && count( $templates ) > 0 )
						  	{
						  		foreach ($templates as $template)
						  		{
						  			$checked = '';
						  			if ( isset($agentTemplate->id) && ($agentTemplate->id == $template->id) )
						  			{
						  				$checked = 'checked="true"';
						  			}
						  			echo '<div><label class="control-label"><input type="radio" name="agent_email_template" value="'. $template->id .'" '. $checked .'> '. ucwords( strtolower( $template->template_name ) ) .'</label></div>';
						  		}
						  	}
						  	?>
						  	<label id="agent_email_template-error" class="error" for="agent_email_template"></label>
						</div>
					</div>
					<div>
						<h4>Template Preview</h4>
						<div id="email_template_preview" style="min-height: 500px; width:600px;">
							<?php
							if( isset( $agentTemplateContent ) && count( $agentTemplateContent ) > 0 )
							{
								echo $agentTemplateContent->template_content;
							}
							?>
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

		<br>

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
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('agent.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>