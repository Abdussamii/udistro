@extends('administrator.layouts.app')
@section('title', 'Udistro | Generate Invoice')

@section('content')

	<style type="text/css">
		body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857143; color: #333; }
				#invoice-wrapper {
		    width: 820px;
		    margin: auto;
		    position: relative;
		}
		.logo {
		    height: 80px;
		    text-align: center;
		    border-bottom: 1px solid #eee;
		}
		.logo img {
		    height: 80px;
		}
		#invoice {
		    position: relative;
		    opacity: 0.99;
		    width: 790px;
		    min-height: 500px;
		    padding: 15px 50px;
		    overflow: hidden;
		    -webkit-border-radius: 5px;
		    -moz-border-radius: 5px;
		    border-radius: 5px;
		    border: 1px solid #eee;
		    -webkit-box-shadow: -1px -1px 5px rgba(0,0,0,0.7);
		    -moz-box-shadow: 0px 0px 5px rgba(0,0,0,0.7);
		    box-shadow: 0px 0px 5px rgba(0,0,0,0.7);
		    margin: 50px auto;
		}
		div#header {
		    display: inline-block;
		    width: 100%;
		}
		#company { width: 49%; display: inline-block; font-size: 25px; font-weight: bold; padding-top: 15px; line-height: 56px; height: 56px; }
		#title { width: 49%; display: inline-block; font-size: 35px; font-weight: bold; height: 50px; margin-bottom: 0; text-align: right; }
		#address,
		#meta { width: 49%; display: inline-block; line-height: 30px; font-size: 16px; }
		#meta { text-align: right; }
		hr { background: #eee; border: 1px solid #eee; margin-top: 50px; margin-bottom: 50px; }
		.message { display: block; }
		.messageBox { font-size: 18px; }
		.bold { font-weight: bolder; font-size: 18px; }
		.unpaid-tag {
		    background: #f00e0e;
		    padding: 10px;
		    color: #fff;
		    text-transform: uppercase;
		    font-size: 18px;
		    font-weight: 600;
		    text-align: center;
		    position: absolute;
		    top: 15px;
		    right: -65px;
		    -ms-transform: rotate(35deg);
		    -webkit-transform: rotate(35deg);
		    transform: rotate(35deg);
		    width: 200px;
		}
		.paid-tag {
		    background: #008000;
		    padding: 10px;
		    color: #fff;
		    text-transform: uppercase;
		    font-size: 18px;
		    font-weight: 600;
		    text-align: center;
		    position: absolute;
		    top: 15px;
		    right: -65px;
		    -ms-transform: rotate(35deg);
		    -webkit-transform: rotate(35deg);
		    transform: rotate(35deg);
		    width: 200px;
		}
		table { font-family: arial, sans-serif; border-collapse: collapse; width: 100%; margin: 50px 0px; }
		td,
		th { border: 1px solid #aaa; text-align: left; padding: 8px; }
		tr:nth-child(even) { background-color: #dddddd; }
		.noteditable { cursor: not-allowed; }
		.invoice-controller { display: inline-block; position: absolute; left: -120px; background: #fff; padding: 5px 10px; border-top-left-radius: 4px; color: #fff; font-size: 18px; border-bottom-left-radius: 4px; top: 200px; line-height: 40px; border: 1px solid #d7d7d7; }
		.pdf-download { background: #ff6633; color: #fff; padding: 0px 10px; border-radius: 3px; cursor: pointer; margin: 5px 0; }
		.pdf-download:hover { background: #363B4D; }
		.add-row,
		.delete-row { background: #363B4D; color: #fff; padding: 0px 10px; border-radius: 3px; cursor: pointer; margin: 5px 0; }
		.add-row:hover,
		.delete-row:hover { background: #ff6633; }
	</style>

	<script type="text/javascript">
	$(document).ready(function(){
		// To add new row
		/*$('#add_row').click(function(){

			let row = '<tr><td class="noteditable" title="This field is done automatically">'+ ( $("#table_invoice_details tbody").find('tr').length + 1 ) +'</td><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true"></td><td contenteditable="true" class="invoice_amout"></td></tr>';

			$("#table_invoice_details tbody").append(row);
		});*/

		// Delete row
		/*$('#delete_row').click(function(){
			if( $("#table_invoice_details tbody tr").length > 1 )
			{
				$('#table_invoice_details tbody tr:last').remove();
			}
			else
			{
				alertify.error('You cannot delete last row');
			}
		});*/

		// To download the pdf
		$('#download_invoice').click(function(){

			// Fill all the entered data in the form and submit the form
			$('#frm_invoive_data').submit();

		});

		// To show/hide the paid and unpaid thing
		$('.invoice_type').change(function(){
			if( $("input[name='invoice_type']:checked").val() == '1' )
			{
				$('.unpaid-tag').show();
				$('.paid-tag').hide();
			}
			else
			{
				$('.unpaid-tag').hide();
				$('.paid-tag').show();
			}
		});

		// To calculate row wise amount sum
		$('.row_quantity, .row_price, .tax_amount, .tax_percentage').blur(function(){

			let quantity = parseFloat( $(this).closest('tr').find('.row_quantity').text() );
			let rowPrice = parseFloat( $(this).closest('tr').find('.row_price').text() );

			$(this).closest('tr').find('.invoice_amout').text( (quantity * rowPrice).toFixed(2) );

			var subTotal = 0;
			$('.invoice_amout').each(function(){
				subTotal += parseFloat( $(this).text() );
			});

			$('.subtotal').text( subTotal.toFixed(2) );

			var taxPercentage = parseFloat( $('.tax_percentage').text() );

			var taxCalc = ( taxPercentage / 100 ) * subTotal;

			$('.tax_amount').text( taxCalc.toFixed(2) );

			var taxAmount = parseFloat( $('.tax_amount').text() );

			$('.total_amount').text( ( subTotal + taxAmount ).toFixed(2) );

		});
	});
	</script>
	
	<div id="invoice-wrapper">
		<div id="invoice"> 
		<!--Unpaid Starts-->
			<div class="unpaid-tag" contenteditable="true">Unpaid</div>
			<div class="paid-tag" contenteditable="true" style="display: none;">Paid</div>
		<!--Unpaid Ends--> 
		<!-- Company Logo Starts -->
		<div class="logo">
			<img src="{{ url('/images/logo.png') }}" alt="Company Logo">
		</div>
		<!-- Company Logo Ends -->
		<!-- Header Starts -->
		<div id="header">
			<div style="margin-top: 10px;">
				<label>Invoice Type</label>
		   		<label><input type="radio" name="invoice_type" class="invoice_type" checked="" value="1">Unpaid</label>
		   		<label><input type="radio" name="invoice_type" class="invoice_type" value="2">Payment Received</label>
		   	</div>
			<div class="top-row">
				  <div contenteditable="true" id="company" id="company_name">Your Company Name</div>
				  <div contenteditable="true" id="title" id="invoice_title">INVOICE</div>
			 </div>
			<div id="address" class="col-sm-6">
				<div contenteditable="true" id="address1">123 Your Street</div>
				<div contenteditable="true" id="address2">Your Town</div>
				<div contenteditable="true" id="address3">Address Line 3</div>
				<div contenteditable="true" id="contact_no">(123) 456 789</div>
				<div contenteditable="true" id="email_id">email@yourcompany.com</div>
			</div>
			<div id="meta" class="col-sm-6">
				<div contenteditable="true" id="invoice_date">12/11/2010</div>
				<div contenteditable="true" id="invoice_no1">Invoice #2334889</div>
				<div contenteditable="true" id="invoice_no2">PO 456001200</div>
				<div contenteditable="true" id="invoice_recipient_fname" class="bold">Att: Ms. Jane Doe</div>
				<div contenteditable="true" id="invoice_recipient_lname" class="bold">Client Company Name</div>
			</div>
		</div>

		<!-- Header Starts -->

		<hr>

		<!-- Message Starts -->
			<div contenteditable="true" class="messageBox" id="invoice_message">
				<span class="message">Dear Ms. Jane Doe,</span>
				<p>Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
				<span class="message">Many thanks,</span> <span class="message">Your Name</span>
			</div>
		<!-- Message Starts --> 

		<!-- Table Starts -->
		<table id="table_invoice_details">
			<thead>
				<tr>
					<th>#</th>
					<th>Item Description</th>
					<th>Quotes</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="noteditable" title="This field is done automatically">1</td>
					<td contenteditable="true">Supporting of in-house project (hours worked)</td>
					<td contenteditable="true" id="quantity1" class="row_quantity">10</td>
					<td contenteditable="true" id="unit_price1" class="row_price">100</td>
					<td contenteditable="true" id="item_wise_total1" class="invoice_amout">1000.00</td>
				</tr>
				<tr>
					<td class="noteditable" title="This field is done automatically">2</td>
					<td contenteditable="true">Supporting of in-house project (hours worked)</td>
					<td contenteditable="true" id="quantity2" class="row_quantity">10</td>
					<td contenteditable="true" id="unit_price2" class="row_price">100</td>
					<td contenteditable="true" id="item_wise_total2" class="invoice_amout">1000.00</td>
				</tr>
				<tr>
					<td class="noteditable" title="This field is done automatically">3</td>
					<td contenteditable="true">Supporting of in-house project (hours worked)</td>
					<td contenteditable="true" id="quantity3" class="row_quantity">10</td>
					<td contenteditable="true" id="unit_price3" class="row_price">100</td>
					<td contenteditable="true" id="item_wise_total3" class="invoice_amout">1000.00</td>
				</tr>
				<tr>
					<td class="noteditable" title="This field is done automatically">4</td>
					<td contenteditable="true">Supporting of in-house project (hours worked)</td>
					<td contenteditable="true" id="quantity4" class="row_quantity">10</td>
					<td contenteditable="true" id="unit_price4" class="row_price">100</td>
					<td contenteditable="true" id="item_wise_total4" class="invoice_amout">1000.00</td>
				</tr>
				<tr>
					<td class="noteditable" title="This field is done automatically">5</td>
					<td contenteditable="true">Supporting of in-house project (hours worked)</td>
					<td contenteditable="true" id="quantity5" class="row_quantity">10</td>
					<td contenteditable="true" id="unit_price5" class="row_price">100</td>
					<td contenteditable="true" id="item_wise_total5" class="invoice_amout">1000.00</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th id="subtotallabel" colspan="4">Subtotal</th>
					<th id="formsubtotal" class="span-4 subtotal">5000.00</th>
				</tr>
				<tr>
					<th id="taxrate" colspan="3">Sales Tax (In Percentage)</th>
					<th id="formtax" class="span-4 tax_percentage" contenteditable="true">0</th>
					<th id="formtax" class="span-4 tax_amount" contenteditable="true">0</th>
				</tr>
				<tr id="total">
					<th id="totallabel" colspan="4">Total</th>
					<th id="formtotal" class="span-4 total_amount">5000.00</th>
				</tr>
			</tfoot>
		</table>
		<!-- Table Ends -->

		<div contenteditable="true" id="closing_message"> Many thanks for your custom! I look forward to doing business with you again in due course.

		Payment terms: to be received within 60 days. </div>
		</div>

		<!-- Invoice Controller Starts -->
		<div class="invoice-controller">
			<div class="pdf-download" id="download_invoice">Get PDF</div>
			<!-- <a href="{{ url('/administrator/htmltopdfview?download=pdf') }}">Download</a> -->
		   	<!-- <div class="resize-table">
		   		<div class="add-row" id="add_row">Add Row</div>
		      	<div class="delete-row" id="delete_row">Delete Row</div>
		   	</div> -->
		</div>
		<!-- Invoice Controller Ends -->

		<!-- Form to hold the data entered by user -->
		<form name="frm_invoive_data" id="frm_invoive_data" action="{{ url('/administrator/htmltopdfview') }}" style="display: none;">
			<input type="hidden" name="download" value="pdf">

			<!-- PDF fields -->
		</form>

	</div>

@endsection