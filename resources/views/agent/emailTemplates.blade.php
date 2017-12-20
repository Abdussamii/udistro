@extends('agent.layouts.app')
@section('title', 'Udistro | Email Templates')

@section('content')
	<!-- TinyMCE -->
	<script type="text/javascript" src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
	
	<script type="text/javascript">
    $(document).ready(function(){
    	// TinyMCE initialization
		tinymce.init({
			selector: "#email_template_content",
			height: 400,
    		// width: 750,
			theme: "modern",
			paste_data_images: true,
			plugins: [
			  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
			  "searchreplace wordcount visualblocks visualchars code fullscreen",
			  "insertdatetime media nonbreaking save table contextmenu directionality",
			  "emoticons template paste textcolor colorpicker textpattern"
			],
			toolbar1: "code fullpage insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			file_picker_callback: function(callback, value, meta) {
			  if (meta.filetype == 'image') {
			    $('#upload').trigger('click');
			    $('#upload').on('change', function() {
			      var file = this.files[0];
			      var reader = new FileReader();
			      reader.onload = function(e) {
			        callback(e.target.result, {
			          alt: ''
			        });
			      };
			      reader.readAsDataURL(file);
			    });
			  }
			}
		});
    });
    </script>

    <style type="text/css">
    .hidden{display:none;}
    </style>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Email Templates</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
      		<button type="button" class="btn btn-primary" data-toggle="modal" id="btn_modal_email_template">Add Template</button>
      	</div>

      	<div class="col-lg-12 top-buffer">
	      	<!-- Table to show all the navigation menus -->
			<table id="datatable_email_templates" class="table table-striped">
				<thead>
					<tr>
						<td>#</td>
						<td>Template Name</td>
						<td>Template Content</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
			</table>
		</div>

		<!-- Modal to add navigation category menu -->
		<div id="modal_email_template" class="modal fade" role="dialog">
		  	<div class="modal-dialog" style="width:1000px;">
			    <!-- Modal content-->
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Template</h4>
					</div>

					<div class="modal-body">
						<form name="frm_email_template" id="frm_email_template" autocomplete="off">
							<div class="form-group">
								<label for="email_template_name">Template Name</label>
								<input type="text" class="form-control" id="email_template_name" name="email_template_name" placeholder="Enter template name">
								<input type="hidden" name="email_template_id" id="email_template_id" value="">
							</div>
							<div class="form-group">
								<label for="email_template_content">Template Content <span class="alert-danger"> (Put [Content] for the content part, that is replaced with the actual content) </span></label>
								<textarea class="form-control" name="email_template_content" id="email_template_content"></textarea>
								<!-- To upload file -->
								<input name="image" type="file" id="upload" class="hidden" onchange="">
							</div>
							<div class="form-group">
								<label for="email_template_status">Status</label>
								<div class="radio">
								 	<label><input type="radio" name="email_template_status" value="1" checked="true">Active</label>
								</div>
								<div class="radio">
								 	<label><input type="radio" name="email_template_status" value="0">Inactive</label>
								</div>
								<label id="email_template_status-error" class="error" for="email_template_status"></label>
							</div>
							<div class="form-group">
								<button type="submit" id="btn_add_email_template" name="btn_add_email_template" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
			    </div>
		  	</div>
		</div>
    </div>
@endsection