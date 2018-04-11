<!-- Administrator Login -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">

        <title>Udistro | Forgot Password</title>

        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

        <!-- JS Alert Plug-in -->
		<script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/custom/administrator.js') }}"></script>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        body {
            background: #eee !important;
        }
        .error {
        	color: red;
        }
        </style>
    </head>
    <body>
        <?php if($type == 1) { ?>
        <div class="container col-md-offset-4">
            <form class="col-sm-6 col-md-6 col-lg-6" name="frm_forgot_password" id="frm_forgot_password" autocomplete="off">
            	<center><h2>Forgot Password</h2></center>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Please Enter Email">
                    <input type="hidden" id="type" name="type" value="<?=$type?>">
                </div>
                <button type="submit" class="btn btn-primary" id="btn_forgot_password" name="btn_forgot_password">Send Link</button>
            </form>
        </div>
        <?php } elseif ($type == 2) { ?>
        <div class="container col-md-offset-4">
            <form class="col-sm-6 col-md-6 col-lg-6" name="frm_forgot_password" id="frm_forgot_password" autocomplete="off">
                <center><h2>Update Password</h2></center>
                <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password">
                    <input type="hidden" id="type" name="type" value="<?=$type?>">
                    <input type="hidden" id="q" name="q" value="<?=$q?>">
                    <input type="hidden" id="hash" name="hash" value="<?=$hash?>">
                </div>

                <div class="form-group">
                    <label for="cnfpassword">Confirm Password</label>
                    <input type="text" name="cnfpassword" id="cnfpassword" class="form-control" placeholder="Enter Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary" id="btn_forgot_password" name="btn_forgot_password">Send Link</button>
            </form>
        </div>
        <?php } ?>

        <!-- Alert Box Modal -->
        <div class="modal fade" id="alert_box_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
        <!-- Alert Box Modal -->

    </body>
</html>