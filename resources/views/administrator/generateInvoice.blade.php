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

			$('#invoiceType').val( $('input[name="invoice_type"]:checked').val() );
			$('#companyName').val( $('.company_name').text() );
			$('#invoiceTitle').val( $('.invoice_title').text() );
			$('#invoiceDate').val( $('.invoice_date').text() );
			$('#invoiceNo1').val( $('.invoice_no1').text() );
			$('#invoiceNo2').val( $('.invoice_no2').text() );
			$('#invoiceRecipientName').val( $('.invoice_recipient_name').text() );
			$('#invoiceRecipientCompanyName').val( $('.invoice_recipient_company_name').text() );
			
			$('#address1').val( $('.address_1').text() );
			$('#address2').val( $('.address_2').text() );
			$('#address3').val( $('.address_3').text() );
			$('#contactNo').val( $('.contact_no').text() );
			$('#emailId').val( $('.email_id').text() );
			
			$('#invoiceMessage').val( $('.invoice_message').html().trim() );

			// Iterate over the table header rows
			var colCount = 1;
			$('#table_invoice_details thead tr th').each(function(){
				$('#tableHeader' + colCount).val( $(this).text() );

				colCount++;
			});

			// Iterate over the table body rows
			var rowCount = 1;
			$('#table_invoice_details tbody tr').each(function(){
				
				var colCount = 1;
				$(this).find('td').each(function(){
					$('#tableRow'+ rowCount +'Col' + colCount).val( $(this).text() );

					colCount++;
				});

				rowCount++;

			});

			$('#tableSubtotal').val( $('.subtotal').text() );
			$('#tableTaxPercentage').val( $('.tax_percentage').text() );
			$('#tableTaxAmount').val( $('.tax_amount').text() );
			$('#tableTotalAmount').val( $('.total_amount').text() );

			$('#closingMessage').val( $('#closing_message').text() );

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

			let quantity = ( $(this).closest('tr').find('.row_quantity').text() != '' ) ? parseFloat( $(this).closest('tr').find('.row_quantity').text() ) : 0;
			let rowPrice = ( $(this).closest('tr').find('.row_price').text() != '' ) ? parseFloat( $(this).closest('tr').find('.row_price').text() ) : 0;

			$(this).closest('tr').find('.invoice_amout').text( (quantity * rowPrice).toFixed(2) );

			var subTotal = 0;
			$('.invoice_amout').each(function(){
				subTotal += ( $(this).text() != '' ) ? parseFloat( $(this).text() ) : 0;
			});

			$('.subtotal').text( subTotal.toFixed(2) );

			var taxPercentage = ( $('.tax_percentage').text() != '' ) ? parseFloat( $('.tax_percentage').text() ) : 0;

			var taxCalc = ( taxPercentage / 100 ) * subTotal;

			$('.tax_amount').text( taxCalc.toFixed(2) );

			var taxAmount = ( $('.tax_amount').text() != '' ) ? parseFloat( $('.tax_amount').text() ) : 0;

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
				<div contenteditable="true" id="company" class="company_name">Your Company Name</div>
				<div contenteditable="true" id="title" class="invoice_title">INVOICE</div>
			</div>
			<div id="address" class="col-sm-6">
				<div contenteditable="true" class="address_1">123 Your Street</div>
				<div contenteditable="true" class="address_2">Your Town</div>
				<div contenteditable="true" class="address_3">Address Line 3</div>
				<div contenteditable="true" class="contact_no">(123) 456 789</div>
				<div contenteditable="true" class="email_id">email@yourcompany.com</div>
			</div>
			<div id="meta" class="col-sm-6">
				<div contenteditable="true" class="invoice_date">12/11/2010</div>
				<div contenteditable="true" class="invoice_no1">Invoice #2334889</div>
				<div contenteditable="true" class="invoice_no2">PO 456001200</div>
				<div contenteditable="true" class="invoice_recipient_name" class="bold">Att: Ms. Jane Doe</div>
				<div contenteditable="true" class="invoice_recipient_company_name" class="bold">Client Company Name</div>
			</div>
		</div>

		<!-- Header Starts -->

		<hr>

		<!-- Message Starts -->
			<div contenteditable="true" class="messageBox invoice_message">
				<span class="message">Dear Ms. Jane Doe,</span>
				<p>Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
				<span class="message">Many thanks,</span> <span class="message">Your Name</span>
			</div>
		<!-- Message Starts --> 

		<!-- Table Starts -->
		<table id="table_invoice_details">
			<thead>
				<tr>
					<th contenteditable="true">#</th>
					<th contenteditable="true">Item Description</th>
					<th contenteditable="true">Quotes</th>
					<th contenteditable="true">Unit Price</th>
					<th contenteditable="true">Total</th>
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
			<!-- This is for URL purpose -->
			<input type="hidden" name="download" id="download" value="pdf">

			<!-- PDF fields -->
			<input type="hidden" name="invoiceType" id="invoiceType" value="">

			<!-- PDF header fields -->
			<input type="hidden" name="companyName" id="companyName" value="">
			<input type="hidden" name="invoiceTitle" id="invoiceTitle" value="">
			<input type="hidden" name="invoiceDate" id="invoiceDate" value="">
			<input type="hidden" name="invoiceNo1" id="invoiceNo1" value="">
			<input type="hidden" name="invoiceNo2" id="invoiceNo2" value="">
			<input type="hidden" name="invoiceRecipientName" id="invoiceRecipientName" value="">
			<input type="hidden" name="invoiceRecipientCompanyName" id="invoiceRecipientCompanyName" value="">
			<input type="hidden" name="address1" id="address1" value="">
			<input type="hidden" name="address2" id="address2" value="">
			<input type="hidden" name="address3" id="address3" value="">
			<input type="hidden" name="contactNo" id="contactNo" value="">
			<input type="hidden" name="emailId" id="emailId" value="">

			<!-- Invoice Message -->
			<input type="hidden" name="invoiceMessage" id="invoiceMessage" value="">

			<!-- Table calculation part -->
			<input type="hidden" name="tableHeader1" id="tableHeader1" value="">
			<input type="hidden" name="tableHeader2" id="tableHeader2" value="">
			<input type="hidden" name="tableHeader3" id="tableHeader3" value="">
			<input type="hidden" name="tableHeader4" id="tableHeader4" value="">
			<input type="hidden" name="tableHeader5" id="tableHeader5" value="">

			<input type="hidden" name="tableRow1Col1" id="tableRow1Col1" value="">
			<input type="hidden" name="tableRow1Col2" id="tableRow1Col2" value="">
			<input type="hidden" name="tableRow1Col3" id="tableRow1Col3" value="">
			<input type="hidden" name="tableRow1Col4" id="tableRow1Col4" value="">
			<input type="hidden" name="tableRow1Col5" id="tableRow1Col5" value="">

			<input type="hidden" name="tableRow2Col1" id="tableRow2Col1" value="">
			<input type="hidden" name="tableRow2Col2" id="tableRow2Col2" value="">
			<input type="hidden" name="tableRow2Col3" id="tableRow2Col3" value="">
			<input type="hidden" name="tableRow2Col4" id="tableRow2Col4" value="">
			<input type="hidden" name="tableRow2Col5" id="tableRow2Col5" value="">

			<input type="hidden" name="tableRow3Col1" id="tableRow3Col1" value="">
			<input type="hidden" name="tableRow3Col2" id="tableRow3Col2" value="">
			<input type="hidden" name="tableRow3Col3" id="tableRow3Col3" value="">
			<input type="hidden" name="tableRow3Col4" id="tableRow3Col4" value="">
			<input type="hidden" name="tableRow3Col5" id="tableRow3Col5" value="">

			<input type="hidden" name="tableRow4Col1" id="tableRow4Col1" value="">
			<input type="hidden" name="tableRow4Col2" id="tableRow4Col2" value="">
			<input type="hidden" name="tableRow4Col3" id="tableRow4Col3" value="">
			<input type="hidden" name="tableRow4Col4" id="tableRow4Col4" value="">
			<input type="hidden" name="tableRow4Col5" id="tableRow4Col5" value="">

			<input type="hidden" name="tableRow5Col1" id="tableRow5Col1" value="">
			<input type="hidden" name="tableRow5Col2" id="tableRow5Col2" value="">
			<input type="hidden" name="tableRow5Col3" id="tableRow5Col3" value="">
			<input type="hidden" name="tableRow5Col4" id="tableRow5Col4" value="">
			<input type="hidden" name="tableRow5Col5" id="tableRow5Col5" value="">

			<input type="hidden" name="tableSubtotal" id="tableSubtotal" value="">
			<input type="hidden" name="tableTaxPercentage" id="tableTaxPercentage" value="">
			<input type="hidden" name="tableTaxAmount" id="tableTaxAmount" value="">
			<input type="hidden" name="tableTotalAmount" id="tableTotalAmount" value="">

			<!-- Invoice Message -->
			<input type="" name="closingMessage" id="closingMessage" value="">

		</form>

	</div>

@endsection