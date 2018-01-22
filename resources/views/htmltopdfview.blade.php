<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>

<style type="text/css">
	body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.42857143; color: #333; }
	#invoice-wrapper { width: auto; margin: auto; position: relative; }
	.logo {
	    height: 80px;
	    text-align: center;
	    border-bottom: 1px solid #eee;
	}
	.logo img {
	    height: 80px;
	}
	#invoice { position: relative; opacity: 0.99; width: 640px; min-height: 500px; padding: 15px 50px; overflow: hidden; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; border: 1px solid #eee; -webkit-box-shadow: -1px -1px 5px rgba(0,0,0,0.7); -moz-box-shadow: 0px 0px 5px rgba(0,0,0,0.7); box-shadow: 0px 0px 5px rgba(0,0,0,0.7); margin: 50px auto; }
	#company { width: 49%; display: inline-block; font-size: 25px; font-weight: bold; padding-top: 15px; line-height: 56px; height: 56px; }
	#title { width: 49%; display: inline-block; font-size: 35px; font-weight: bold; height: 50px; margin-bottom: 0; text-align: right; }
	#address,
	#meta { width: 49%; display: inline-block; line-height: 30px; font-size: 16px; }
	#meta { text-align: right; }
	div#header {
	    display: inline-block;
	    width: 100%;
	}
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
</head>
<body>
	
	<!-- <a href="http://localhost/udistro/public/administrator/htmltopdfview?download=pdf">Get PDF</a> -->
	
	<div id="invoice-wrapper">
		<div id="invoice"> 
			<!--Unpaid Starts-->
				<?php
				if( isset( $userInput['invoiceType'] ) && ( $userInput['invoiceType'] == 1 ) )	// Unpaid
				{
					echo '<div class="unpaid-tag">Unpaid</div>';
				}
				else 																			// Paid
				{
					echo '<div class="paid-tag" contenteditable="true">Paid</div>';
				}
				?>
			<!--Unpaid Ends--> 

			<!-- Company Logo Starts -->
			<div class="logo">
				<img src="{{ url('/images/logo.png') }}" alt="Company Logo">
			</div>
			<!-- Company Logo Ends -->

			<!-- Header Starts -->
			<div id="header">
				<div class="top-row">
					  <div contenteditable="true" id="company">{{ $userInput['companyName'] }}</div>
					  <div contenteditable="true" id="title">{{ $userInput['invoiceTitle'] }}</div>
				 </div>
				<div id="address" class="col-sm-6">
					<div contenteditable="true">{{ $userInput['address1'] }}</div>
					<div contenteditable="true">{{ $userInput['address2'] }}</div>
					<div contenteditable="true">{{ $userInput['address3'] }}</div>
					<div contenteditable="true">{{ $userInput['contactNo'] }}</div>
					<div contenteditable="true">{{ $userInput['emailId'] }}</div>
				</div>
				<div id="meta" class="col-sm-6">
					<div contenteditable="true">{{ $userInput['invoiceDate'] }}</div>
					<div contenteditable="true">{{ $userInput['invoiceNo1'] }}</div>
					<div contenteditable="true">{{ $userInput['invoiceNo2'] }}</div>
					<div contenteditable="true" class="bold">{{ $userInput['invoiceRecipientName'] }}</div>
					<div contenteditable="true" class="bold">{{ $userInput['invoiceRecipientCompanyName'] }}</div>
				</div>
			</div>
			<!-- Header Starts -->

		<hr>

		<!-- Message Starts -->
			<div contenteditable="true" class="messageBox">
				{!! $userInput['invoiceMessage'] !!}
			</div>
		<!-- Message Starts -->

		<!-- Table Starts -->
		<table contenteditable="true">
		<thead>
			<tr>
				<th>{{ $userInput['tableHeader1'] }}</th>
				<th>{{ $userInput['tableHeader2'] }}</th>
				<th>{{ $userInput['tableHeader3'] }}</th>
				<th>{{ $userInput['tableHeader4'] }}</th>
				<th>{{ $userInput['tableHeader5'] }}</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for( $row=1; $row<=5; $row++ )
			{
				if( $userInput['tableRow'. $row .'Col1'] != '' && $userInput['tableRow'. $row .'Col2'] != '' && $userInput['tableRow'. $row .'Col3'] != '' && $userInput['tableRow'. $row .'Col4'] != '' && $userInput['tableRow'. $row .'Col5'] != '' )
				{
				?>
					<tr>
						<td class="noteditable" title="This field is done automatically">{{ $userInput['tableRow'. $row .'Col1'] }}</td>
						<td>{{ $userInput['tableRow'. $row .'Col2'] }}</td>
						<td>{{ $userInput['tableRow'. $row .'Col3'] }}</td>
						<td>{{ $userInput['tableRow'. $row .'Col4'] }}</td>
						<td class="noteditable" title="This field is done automatically">{{ $userInput['tableRow'. $row .'Col5'] }}</td>
					</tr>
				<?php
				}
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th id="subtotallabel" colspan="4">Subtotal</th>
				<th id="formsubtotal" class="span-4 noteditable">{{ $userInput['tableSubtotal'] }}</th>
			</tr>
			<tr>
				<th id="taxrate" colspan="4">Sales Tax ({{ $userInput['tableTaxPercentage'] }}%)</th>
				<th id="formtax" class="span-4 noteditable">{{ $userInput['tableTaxAmount'] }}</th>
			</tr>
			<tr id="total">
				<th id="totallabel" colspan="4">Total</th>
				<th id="formtotal" class="span-4 noteditable">{{ $userInput['tableTotalAmount'] }}</th>
			</tr>
		</tfoot>
		</table>
		<!-- Table Ends -->

		<div contenteditable="true">{!! $userInput['closingMessage'] !!}</div>
		</div>

</div>
</body>
</html>