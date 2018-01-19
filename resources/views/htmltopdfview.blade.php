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
		<div class="unpaid-tag">Unpaid</div>
		<!--Unpaid Ends--> 
		<!-- Company Logo Starts -->
		<div class="logo">
			<img src="{{ url('/images/logo.png') }}" alt="Company Logo">
		</div>
		<!-- Company Logo Ends -->
		<!-- Header Starts -->
		<div id="header">
			<div class="top-row">
				  <div contenteditable="true" id="company">Your Company Name</div>
				  <div contenteditable="true" id="title">INVOICE</div>
			 </div>
			<div id="address" class="col-sm-6">
				<div contenteditable="true">123 Your Street</div>
				<div contenteditable="true">Your Town</div>
				<div contenteditable="true">Address Line 3</div>
				<div contenteditable="true">(123) 456 789</div>
				<div contenteditable="true">email@yourcompany.com</div>
			</div>
			<div id="meta" class="col-sm-6">
				<div contenteditable="true">12/11/2010</div>
				<div contenteditable="true">Invoice #2334889</div>
				<div contenteditable="true">PO 456001200</div>
				<div contenteditable="true" class="bold">Att: Ms. Jane Doe</div>
				<div contenteditable="true" class="bold">Client Company Name</div>
			</div>
		</div>

		<!-- Header Starts -->

		<hr>

		<!-- Message Starts -->
			<div contenteditable="true" class="messageBox">
				<span class="message">Dear Ms. Jane Doe,</span>
				<p>Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
				<span class="message">Many thanks,</span> <span class="message">Your Name</span>
			</div>
		<!-- Message Starts --> 

		<!-- Table Starts -->
		<table contenteditable="true">
		<thead>
			<tr>
				<th>#</th>
				<th>Item Description</th>
				<th>Quantity</th>
				<th>Unit price</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="noteditable" title="This field is done automatically">1</td>
				<td>Supporting of in-house project (hours worked)</td>
				<td>40</td>
				<td>125</td>
				<td class="noteditable" title="This field is done automatically">5000.00</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">2</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">3</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">4</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">5</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">6</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">7</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
			<tr>
				<td class="noteditable" title="This field is done automatically">8</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="noteditable" title="This field is done automatically">-</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th id="subtotallabel" colspan="4">Subtotal</th>
				<th id="formsubtotal" class="span-4 noteditable">5000.00</th>
			</tr>
			<tr>
				<th id="taxrate" colspan="4">Sales Tax (20%)</th>
				<th id="formtax" class="span-4 noteditable">1000.00</th>
			</tr>
			<tr id="total">
				<th id="totallabel" colspan="4">Total</th>
				<th id="formtotal" class="span-4 noteditable">6000.00</th>
			</tr>
		</tfoot>
		</table>
		<!-- Table Ends -->

		<div contenteditable="true"> Many thanks for your custom! I look forward to doing business with you again in due course.

		Payment terms: to be received within 60 days. </div>
		</div>

</div>
</body>
</html>