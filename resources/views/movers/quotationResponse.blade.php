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

        <link rel="icon" type="image/png" href="{{ url('images/udistro-fav.png') }}" sizes="32x32" />

        <!-- Bootstrap Core CSS -->
        <!-- <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="{{ URL::asset('css/movers/bootstrap.min.css') }}" />



        <!-- Custom Fonts -->
        <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

        <!-- dataTables -->
        <link rel="stylesheet" href="{{ URL::asset('css/dataTables.min.css.css') }}" />

        <link rel="stylesheet" href="{{ URL::asset('css/style_other_pages.css') }}" />
    	<link rel="stylesheet" href="{{ URL::asset('css/style_landing_page.css') }}" />

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
        <style type="text/css">
            /* Absolute Center Spinner */
            .loading {
              position: fixed;
              z-index: 100000;
              height: 2em;
              width: 2em;
              overflow: show;
              margin: auto;
              top: 0;
              left: 0;
              bottom: 0;
              right: 0;
            }

            /* Transparent Overlay */
            .loading:before {
              content: '';
              display: block;
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0,0,0,0.3);
            }

            /* :not(:required) hides these rules from IE9 and below */
            .loading:not(:required) {
              /* hide "loading..." text */
              font: 0/0 a;
              color: transparent;
              text-shadow: none;
              background-color: transparent;
              border: 0;
            }

            .loading:not(:required):after {
              content: '';
              display: block;
              font-size: 10px;
              width: 1em;
              height: 1em;
              margin-top: -0.5em;
              -webkit-animation: spinner 1500ms infinite linear;
              -moz-animation: spinner 1500ms infinite linear;
              -ms-animation: spinner 1500ms infinite linear;
              -o-animation: spinner 1500ms infinite linear;
              animation: spinner 1500ms infinite linear;
              border-radius: 0.5em;
              -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
              box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
            }

            /* Animation */

            @-webkit-keyframes spinner {
              0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
              }
              100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
              }
            }
            @-moz-keyframes spinner {
              0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
              }
              100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
              }
            }
            @-o-keyframes spinner {
              0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
              }
              100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
              }
            }
            @keyframes spinner {
              0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
              }
              100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
              }
            }
            .navbar-fixed-bottom, .navbar-fixed-top {
			    position: relative;
			}
			.cr-h1 {
			    font-size: 35px;
			    text-align: center;
			    padding: 30px 0px;
			    border-bottom: 1px solid #eee;
			    font-weight: 700;
			}
			.company-response-data {
			    margin-bottom: 80px;
			}
        </style>

    </head>

    <body>

<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
	 <div class="container-fluid">
	  <div class="navbar-header logo"> <a href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}" alt="Udistro" /></a> </div>
	  <ul class="nav navbar-nav navbar-right navbar-top-link">
	   	<!-- <li>
		   	<a href="{{ url('/agent/home') }}">
		    	<button type="button" class="btn top-btn1"> I’m a Real-Estate Agent</button>
		    </a>
		</li> -->
	   <li>
	   		<a href="{{ url('/') }}">
	    		<button type="button" class="btn top-btn1"> Go to home page</button>
	    	</a>
		</li>
	  </ul>
	 </div>
	</nav>
	<!-- End Navbar --> 

        <div id="wrapper" class="container-fluid">
        	<div class="cr-h1">Company Response</div>
            <div id="page-wrapper">
                <div class="row company-response-data">
                    <div class="col-lg-12 top-buffer">
                        <input type="hidden" id="client_id" value="1">
                        <input type="hidden" id="invitation_id" value="3">
                        <table id="datatable_quotation" class="table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Company Name</td>
                                    <td>Budget</td>
                                    <td>Response Time</td>
                                    <td>Rating</td>
                                    <td>Review</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Modal to Tech Concierge Service Request -->
                    <div id="modal_tech_concierge_service_request" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tech Concierge Services Request</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="frm_tech_concierge" name="frm_tech_concierge">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td style="width: 30%;">Moving from</td>
                                                            <td id="moving_from_address"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td style="width: 30%;">Moving to</td>
                                                            <td id="moving_to_address"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td>Moving to house type</td>
                                                            <td id="moving_to_house_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to floor level</td>
                                                            <td id="moving_to_floor"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to no of bedroom</td>
                                                            <td id="moving_to_bedroom_count"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to property type</td>
                                                            <td id="moving_to_property_type"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td>Availability 1</td>
                                                            <td id="availability_day1"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Availability 2</td>
                                                            <td id="availability_day2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Availability 3</td>
                                                            <td id="availability_day3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Additional Information</td>
                                                            <td id="additional_information"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Items</th>
                                                                <th>User Input</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="user_requested_tech_concierge_other_details">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 30%">Items</th>
                                                                <th style="width: 40%">User Input</th>
                                                                <th style="width: 10%">Quantity</th>
                                                                <th style="width: 10%">Time Estimate</th>
                                                                <th style="width: 10%">Budget Estimate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="user_requested_tech_concierge_services">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped" id="tech_concierge_calculations">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Discount</td>
                                                                <td id="discount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Sub Total</td>
                                                                <td id="subtotal"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
                                                                <td id="gst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
                                                                <td id="hst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
                                                                <td id="pst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
                                                                <td id="service_charge_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Total</td>
                                                                <td id="total"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Total</td>
                                                                <td id="comment"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Accept &amp; Make Payment</td>
                                                                <td>
                                                                	<a href="javascript:void(0);" class="make_payment" data-amount="" data-service="tech_concierge_service" id="">
                                                                		<i class="fa fa-paypal" aria-hidden="true"></i>
                                                                	</a>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Modal to Home Cleaning Service Request -->
                    <div id="modal_home_cleaning_service_request" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Home Cleaning Services Request</h4>
                                </div>

                                <div class="modal-body" style="height: 800px; overflow-y: auto;">
                                    <form id="frm_home_cleaning_services" name="frm_home_cleaning_services">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td style="width: 30%;">Moving from</td>
                                                    <td id="moving_from_address"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td style="width: 30%;">Moving to</td>
                                                    <td id="moving_to_address"></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th style="width:70%">Items</th>
                                                    <th>User Input</th>
                                                </tr>
                                                <tr>
                                                    <td>Moving from house type</td>
                                                    <td id="moving_from_house_type"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving from floor level</td>
                                                    <td id="moving_from_floor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving from no of bedroom</td>
                                                    <td id="moving_from_bedroom_count"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving from property type</td>
                                                    <td id="moving_from_property_type"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving to house type</td>
                                                    <td id="moving_to_house_type"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving to floor level</td>
                                                    <td id="moving_to_floor"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving to no of bedroom</td>
                                                    <td id="moving_to_bedroom_count"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving to property type</td>
                                                    <td id="moving_to_property_type"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moving from address</td>
                                                    <td id="distance"></td>
                                                </tr>
                                                <tr>
                                                    <td>Home Condition</td>
                                                    <td id="home_condition"></td>
                                                </tr>
                                                <tr>
                                                    <td>How many levels do you have</td>
                                                    <td id="home_cleaning_level"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th style="width:70%">Items</th>
                                                    <th>User Input</th>
                                                </tr>
                                                <tr>
                                                    <td>Size of area you want to clean</td>
                                                    <td id="home_cleaning_area"></td>
                                                </tr>
                                                <tr>
                                                    <td>How many peoples live in the house</td>
                                                    <td id="home_cleaning_people_count"></td>
                                                </tr>
                                                <tr>
                                                    <td>How many pets live in the house</td>
                                                    <td id="home_cleaning_pet_count"></td>
                                                </tr>
                                                <tr>
                                                    <td>How many bathrooms</td>
                                                    <td id="home_cleaning_bathroom_count"></td>
                                                </tr>
                                                <tr>
                                                    <td>Cleaning behind the refrigerator and stove</td>
                                                    <td id="cleaning_behind_refrigerator_and_stove"></td>
                                                </tr>
                                                <tr>
                                                    <td>Would you like baseboard to be washed</td>
                                                    <td id="baseboard_to_be_washed"></td>
                                                </tr>
                                                <tr>
                                                    <td>Additional Information</td>
                                                    <td id="additional_information"></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30%">Items</th>
                                                        <th style="width: 40%">User Input</th>
                                                        <th style="width: 10%">Quantity</th>
                                                        <th style="width: 10%">Time Estimate</th>
                                                        <th style="width: 10%">Budget Estimate</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="user_requested_home_cleaning_services">
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <table class="table table-striped" id="home_cleaning_calculations">
                                                <thead>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">Discount</td>
                                                        <td id="discount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">Sub Total</td>
                                                        <td id="subtotal">$0</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
                                                        <td id="gst_amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
                                                        <td id="hst_amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
                                                        <td id="pst_amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
                                                        <td id="service_charge_amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">Total</td>
                                                        <td id="total"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">Comment</td>
                                                        <td id="comment"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="width: 80%;">Accept &amp; Make Payment</td>
                                                        <td>
                                                        	<a href="javascript:void(0);" class="make_payment" data-amount="" data-service="home_cleaning_service" id="">
                                                        		<i class="fa fa-paypal" aria-hidden="true"></i>
                                                        	</a>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>

                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Modal to Moving Companies Service Request -->
                    <div id="modal_moving_companies_service_request" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Moving Companies Services Request</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="frm_home_moving_companies" name="frm_home_moving_companies" autocomplete="off">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td style="width: 30%;">Moving from</td>
                                                            <td id="moving_from_address"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td style="width: 30%;">Moving to</td>
                                                            <td id="moving_to_address"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th style="width:70%">Items</th>
                                                            <th>User Input</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from house type</td>
                                                            <td id="moving_from_house_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from floor level</td>
                                                            <td id="moving_from_floor"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from no of bedroom</td>
                                                            <td id="moving_from_bedroom_count"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from property type</td>
                                                            <td id="moving_from_property_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to house type</td>
                                                            <td id="moving_to_house_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to floor level</td>
                                                            <td id="moving_to_floor"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to no of bedroom</td>
                                                            <td id="moving_to_bedroom_count"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to property type</td>
                                                            <td id="moving_to_property_type"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th style="width:70%">Items</th>
                                                            <th>User Input</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving date</td>
                                                            <td id="moving_date"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Distance</td>
                                                            <td id="distance"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Additional Information</td>
                                                            <td id="additional_information"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Items</th>
                                                                <th>User Input</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="user_requested_moving_other_services">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 30%">Items</th>
                                                                <th style="width: 40%">User Input</th>
                                                                <th style="width: 10%">Quantity/Weight</th>
                                                                <th style="width: 10%">Time Estimate</th>
                                                                <th style="width: 10%">Budget Estimate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="user_requested_moving_services">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped" id="moving_service_calculations">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Insurance</td>
                                                                <td id="insurance">
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Discount</td>
                                                                <td id="discount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Sub Total</td>
                                                                <td id="subtotal"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
                                                                <td id="gst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
                                                                <td id="hst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
                                                                <td id="pst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
                                                                <td id="service_charge_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Total</td>
                                                                <td id="total"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Comment</td>
                                                                <td id="comment"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Accept &amp; Make Payment</td>
                                                                <td>
                                                                	<a href="javascript:void(0);" class="make_payment" data-amount="" data-service="moving_service" id="">
                                                                		<i class="fa fa-paypal" aria-hidden="true"></i>
                                                                	</a>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal to Cable & Internet Service Request -->
                    <div id="modal_cable_internet_service_request" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Cable & Internet Services Request</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form id="frm_cable_internet_services" name="frm_cable_internet_services" autocomplete="off">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td style="width: 30%;">Moving from</td>
                                                            <td id="moving_from_address"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td style="width: 30%;">Moving to</td>
                                                            <td id="moving_to_address"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="clearfix"></div>

                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th style="width:70%">Items</th>
                                                            <th>User Input</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from house type</td>
                                                            <td id="moving_from_house_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from floor level</td>
                                                            <td id="moving_from_floor"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from no of bedroom</td>
                                                            <td id="moving_from_bedroom_count"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving from property type</td>
                                                            <td id="moving_from_property_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to house type</td>
                                                            <td id="moving_to_house_type"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to floor level</td>
                                                            <td id="moving_to_floor"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to no of bedroom</td>
                                                            <td id="moving_to_bedroom_count"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Moving to property type</td>
                                                            <td id="moving_to_property_type"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th style="width:70%">Items</th>
                                                            <th>User Input</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Do you have cable &amp; internet service before</td>
                                                            <td id="have_cable_internet_already"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Employment Status</td>
                                                            <td id="employment_status"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Would you like to receive your bill electronically</td>
                                                            <td id="want_to_receive_electronic_bill"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Would you consider any contract plan</td>
                                                            <td id="want_to_contract_plan"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Would you want to setup pre-authorise payment</td>
                                                            <td id="want_to_setup_preauthorise_payment"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Additional Information</td>
                                                            <td id="additional_information"></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Items</th>
                                                                <th>User Input</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="user_requested_cable_internet_additional_services">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 30%">Items</th>
                                                                <th style="width: 40%">User Input</th>
                                                                <th style="width: 10%">Quantity</th>
                                                                <th style="width: 10%">Time Estimate</th>
                                                                <th style="width: 10%">Budget Estimate</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="user_requested_cable_internet_services">
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <table class="table table-striped" id="cable_internet_calculations">
                                                        <thead>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Discount</td>
                                                                <td id="discount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Sub Total</td>
                                                                <td id="subtotal"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">GST (<span id="gst_percentage"></span>)</td>
                                                                <td id="gst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">HST (<span id="hst_percentage"></span>)</td>
                                                                <td id="hst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">PST (<span id="pst_percenateg"></span>)</td>
                                                                <td id="pst_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Service Charge (<span id="service_charge_percetage"></span>)</td>
                                                                <td id="service_charge_amount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Total</td>
                                                                <td id="total"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Comment</td>
                                                                <td id="comment"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="width: 80%;">Accept &amp; Make Payment</td>
                                                                <td>
                                                                	<a href="javascript:void(0);" class="make_payment" data-amount="" data-service="cable_internet_service" id="">
                                                                		<i class="fa fa-paypal" aria-hidden="true"></i>
                                                                	</a>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                                <div class="clearfix"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>

    <!-- Modal to show the payment options -->
    <div class="modal fade" id="make_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Make Payment</h4>
				</div>
				<!-- <form action="https://secure.paypal.com/uk/cgi-bin/webscr" method="post" name="paypal" id="paypal"> -->
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypal" id="paypal">
					<div class="modal-body">
						<div class="form-group">
							<label for="payment_against">Payment Against</label>
							<input type="text" name="payment_against" id="payment_against" class="form-control" placeholder="Payment against" value="" disabled="true">
						</div>
						<div class="form-group">
							<label for="payment_amount">Amount</label>
							<input type="text" name="payment_amount" id="payment_amount" class="form-control" placeholder="Amount" disabled="true">
						</div>
						<div class="form-group">
							<label for="payment_mode">Debit/Credit Card <input type="radio" name="payment_mode" class="payment_mode" value="1" checked=""></label>
							<label for="payment_mode">Paypal <input type="radio" name="payment_mode" class="payment_mode" value="2"></label>
						</div>

					    <!-- Prepopulate the PayPal checkout page with customer details -->
					    <div class="form-group" style="display: none;">
						    <input type="text" name="first_name" id="first_name" value="">
						    <input type="text" name="last_name" id="last_name" value="">
						    <input type="text" name="email" id="email" value="">
						    <input type="text" name="address1" id="address1" value="">
						    <input type="text" name="address2" id="address2" value="">
						    <input type="text" name="city" id="city" value="">
						   	<input type="text" name="zip" id="zip" value="">
							
							<input type="hidden" name="state" id="state" value="">

						    <!-- For country Canada -->
						    <input type="hidden" name="country" value="CA">
						    
						    <input type="text" name="day_phone_a" id="day_phone_a" value="">
						    <input type="text" name="day_phone_b" id="day_phone_b" value="">
					    </div>

					    <!-- We don't need to use _ext-enter anymore to prepopulate pages -->
					    <!-- cmd = _xclick will automatically pre populate pages -->
					    <!-- More information: https://www.x.com/docs/DOC-1332 -->
					    <div class="form-group" style="display: none;">
						    <input type="text" name="cmd" value="_xclick" />

						    <!-- Production -->
						    <!-- <input type="text" name="business" value="info@udistro.ca" /> -->
						    
						    <!-- Sandbox -->
						    <input type="text" name="business" value="sandboxbussiness@udistro.ca" />
						    <input type="text" name="cbt" value="Return to Udistro" />
						    <input type="text" name="currency_code" value="CAD" />
						</div>

					    <!-- Allow the customer to enter the desired quantity -->
					    <div class="form-group" style="display: none;">
						    <input type="text" name="quantity" id="quantity" value="1" />
						    <input type="text" name="item_name" id="item_name" value="" />
						</div>

					    <!-- Custom value you want to send and process back in the IPN -->
					    <div class="form-group" style="display: none;">
						    <!-- <input type="text" name="custom" value="" />
						    <input type="text" name="shipping" value="" /> -->
						    <input type="text" name="invoice" id="invoice" value="" />
						    <input type="text" name="amount" id="amount" value="" />
						    <input type="text" name="return" value="{{ Request::fullUrl() }}"/>		<!-- http://localhost/paypal_integration_php/success.php -->
						    <input type="text" name="cancel_return" value="{{ Request::fullUrl() }}" />		<!-- http://localhost/paypal_integration_php/cancel.php -->
						</div>

					    <!-- Where to send the PayPal IPN to. -->
					    <input type="text" name="notify_url" value="{{ url('/paypal/paymentstatus') }}" style="display: none;" />

					    <!-- Redirect the user to the billing page instead of paypal payment page -->
					    <input type="hidden" name="landing_page" id="landing_page" value="billing">
					</div>
					<div class="modal-footer">
						<!-- For production -->
						<!-- <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online"> 
						<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >  -->

						<!-- For development -->
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
 						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</div>
				</form>
			</div>
		</div>
    </div>
<!-- Footer Starts -->
	<footer class="footer-main section-pd">
	 <div class="container">
	  <div class="row">
	   <div class="col-md-4">
	    <div class="foot_logo">
	    	<!-- <img src="images/logo-foot.png" alt=""/> -->
	    	<img src="{{ url('/images/landing_image/logo-foot.png') }}" alt="">
	    </div>
	    <ul class="footer_social_icon">
	     <li><a href="https://www.facebook.com/udistro.rakoomi" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	     <li><a href="https://www.linkedin.com/in/udistro-rakoomi-043323153/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	     <li><a href="https://twitter.com/udistroca" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	     <li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	     <li><a href="https://www.instagram.com/udistroca" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	     <!-- <li><a href="" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li> -->
	    </ul>
	    <address>
	    <h4></h4>
	    <ul>
	     <li class="address-post">Winnipeg, Manitoba</li>
	     <li><i class="fa fa-phone" aria-hidden="true"></i> Fongo Phone: 204-202-3377</li>
	     <li><i class="fa fa-map-marker" aria-hidden="true"></i> 610 Kirkbridge Drive</li>
	    </ul>
	    </address>
	   </div>
	   <div class="col-md-3 col-sm-4">
	    <div class="media-body client-achive-step">
	     <h2 class="media-heading">Company</h2>
	    </div>
	    <ul class="list-group custom-listgroup">
	     <li class="list-group-item"><a href="{{ url('/aboutus') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>About</a></li>
	     <li class="list-group-item"><a href="{{ url('/ourteam') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Our Team</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Management</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Our Customers</a></li>
	    </ul>
	   </div>
	   <div class="col-md-3 col-sm-4">
	    <div class="media-body client-achive-step">
	     <h2 class="media-heading">Important Links</h2>
	    </div>
	    <ul class="list-group custom-listgroup">
	     <li class="list-group-item"><a href="{{ url('/login') }}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Login</a></li>
	     <li class="list-group-item"><a href="{{ url('/freetrial') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Free Trial</a></li>
	     <li class="list-group-item"><a href="{{ url('/helpcenter') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Support</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Schedule Demo</a></li>
	    </ul>
	   </div>
	   <div class="col-md-2 col-sm-4">
	    <div class="media-body client-achive-step">
	     <h2 class="media-heading">Resources</h2>
	    </div>
	    <ul class="list-group custom-listgroup">
	     <li class="list-group-item"><a href="{{ url('/events') }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Events</a></li>
	     <li class="list-group-item"><a href="{{ url('/helpcenter') }}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>Help Center</a></li>
	     <li class="list-group-item"><a href="https://udistro424000759.wordpress.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Blog</a></li>
	     <li class="list-group-item"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>Videos</a></li>
	    </ul>
	   </div>
	  </div>
	  
	  <!-- -->
	  <div class="footerAdditional">
	   <ul>
	    <li> <a href="{{ url('/faqs') }}">FAQs</a> </li>
	    <li> <a href="https://termsfeed.com/privacy-policy/78d745deeed0b145a84dbc4b46e88912" target="_blank">Privacy</a> </li>
	    <li> <a href="https://termsfeed.com/terms-conditions/ecb999172c16298afdddc8eb94b9a21b" target="_blank">Terms</a> </li>
	    <li> <a href="{{ url('/agent/home') }}">I’m a Real-Estate Agent</a> </li>
	    <li> <a href="{{ url('/getinvitation') }}">I'm a Moving</a> </li>
	    <li class="footerAdditional-item--copyright"> © uDistro {{ date('Y') }} All Rights Reserved </li>
	   </ul>
	  </div>
	  <!-- --> 
	  
	 </div>

	 <!-- SSL Secure Site Seal -->
	 <div class="cot_tl_fixed">
	 	<a href="https://www.positivessl.com/trusted-ssl-site-seal.php" style="font-family: arial; font-size: 10px; color: #212121; text-decoration: none;"><img src="https://www.positivessl.com/images-new/comodo_secure_seal_113x59_transp.png" alt="Trusted Site Seal" title="Trusted Site Seal for Transparent background" border="0" /></a>
	 </div>

	</footer>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.errMode = 'ignore';
        $('#datatable_quotation').dataTable({
            "sServerMethod": "get", 
            "bProcessing": true,
            "bServerSide": true,
            "searching": false,
            "paging": false,
            "ajax": {
                "url": $('meta[name="route"]').attr('content') + '/movers/getquotationresponse',
                "data": function ( d ) {
                    d.clientId = $('#client_id').val();
                    d.invitationId = $('#invitation_id').val();
                }
            },
            "columnDefs": [
                { "className": "dt-center", "targets": [ 0, 3, 4, 5, 6 ] }
            ],
            "aoColumns": [
                { 'bSortable' : false },
                { 'bSortable' : false },
                { 'bSortable' : false },
                { 'bSortable' : false },
                { 'bSortable' : false },
                { 'bSortable' : false },
                { 'bSortable' : false }
            ],
            "language": {
              "emptyTable": "You don't have response yet, please check back within the next 24 hours"
            }
        });

        // To toggle the paypal payment from credit card and login
        $('.payment_mode').click(function(){
        	if( $(this).val() == '1' )
        	{
        		$('#landing_page').remove();
        		$('#paypal').append('<input type="hidden" name="landing_page" id="landing_page" value="billing">');
        	}
        	else
        	{
        		$('#landing_page').remove();
        	}
        });
    });
</script>

</html>