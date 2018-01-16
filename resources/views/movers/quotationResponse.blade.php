<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">

        <title>uDistro | Quotation Response</title>

        <!-- Bootstrap Core CSS -->
        <!-- <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="{{ URL::asset('css/movers/bootstrap.min.css') }}" />



        <!-- Custom Fonts -->
        <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />

        <!-- dataTables -->
        <link rel="stylesheet" href="{{ URL::asset('css/dataTables.min.css.css') }}" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
        .top-buffer { margin-top:20px; }
        </style>

        <!-- jQuery -->
        <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="{{ URL::asset('js/movers/bootstrap.min.3.3.7.js') }}"></script>

        <!-- Datatable -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js.js') }}"></script>

        <!-- JQuery Validation -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

        <!-- JS Alert Plug-in -->
        <script type="text/javascript" src="{{ URL::asset('js/alertify.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}" />

        <!-- Admin JS -->
        <script type="text/javascript" src="{{ URL::asset('js/custom/movers.js') }}"></script>

        <style type="text/css">
        .error {
        	color: red;
        }
        </style>

    </head>

    <body>
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12 top-buffer">
                        <input type="hidden" id="client_id" value="1">
                        <input type="hidden" id="invitation_id" value="3">
                        <table id="datatable_quotation" class="table table-striped">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Agent Name</td>
                                    <td>Agent Email</td>
                                    <td>Agent Contact Number</td>
                                    <td>Company Name</td>
                                    <td>Type</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                        </table>
                    </div>


                    <div id="modal_tech_concierge" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">1</h4>
                                </div>

                                <div class="modal-body">       
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal_home_cleaning" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">2</h4>
                                </div>

                                <div class="modal-body">       
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal_moving_item" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">3</h4>
                                </div>

                                <div class="modal-body">       
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal_digital" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">4</h4>
                                </div>

                                <div class="modal-body">       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>