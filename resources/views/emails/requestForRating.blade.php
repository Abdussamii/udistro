<table width="640" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 20px;  border: 2px solid #ddd; font-family:Verdana, Geneva, sans-serif; font-size:14px;">
 <tr>
  <td align="left" valign="top"><table align="center" width="640" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td><img style="width:100px;" src="{{ url('images/review-email-logo.png') }}" alt="" /></td>
     <td><table width="0" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td><h1>Confirm payment</h1></td>
       </tr>
       <tr>
        <td><p style="margin:0 0 20px 0; font-size:13px; font-style: italic;">If we did not hear from you in 24 hours,</br> we will assume your work is completed and well done...</p></td>
       </tr>
      </table></td>
     <td><img src="{{ url('images/udistro-logo-pop.png') }}" alt="" /></td>
    </tr>
    <!-- Header table end -->
   </table></td>
 </tr>
 <tr>
  <td align="left" valign="top"><table bgcolor="#f9f9f9" width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #d7d7d7; padding:20px;">
    <tr>
     <td><p style="margin:0;"><strong>Date of purchase : </strong> <span>{{ $emailData['dateOfPayment'] or '' }}</span></p></td>
    </tr>
    <tr>
     <td><p style="margin:0;"><strong>Your order details : </strong> <span>{{ $emailData['orderDetails'] or '' }}</span></p></td>
    </tr>
   </table></td>
 </tr>
 <tr>
  <td align="left" valign="top">&nbsp;</td>
 </tr>
 <tr>
  <td align="left" valign="top"> Dear <strong>{{ $emailData['clientName'] or '' }}</strong></td>
 </tr>
 <tr>
  <td align="left" valign="top">&nbsp;</td>
 </tr>
 <tr>
  <td align="left" valign="top" style="line-height:24px;"> Your service provider is waiting to get paid, you need to confirm payment before we make payment. </br>
   </br>
   <strong>{{ $emailData['companyName'] or '' }}</strong> asked us to contact you about your experience regarding your recent order. Your rating and comments whether positive or negative will help <strong>{{ $emailData['companyName'] or '' }}</strong> improve their customer service. Your feedback go to <strong>{{ $emailData['companyName'] or '' }}</strong> and will affect how uDistro does business with them afterwards.</td>
 </tr>
 <tr>
  <td align="left" valign="top">&nbsp;</td>
 </tr>
 <tr>
  <!-- <td align="left" valign="top">officia deserunt mollit anim id est laborum.</td> -->
 </tr>
 <tr>
  <td align="left" valign="top">&nbsp;</td>
 </tr>
 <tr>
  <td align="left" valign="top"><table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td width="150">&nbsp;</td>
     <td>
     <table width="300" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td align="center"><a style=" color: #fff;	background: #2e63c1;	padding: 10px;	display: block;	margin-top: 20px;	font-size: 18px;	text-transform: uppercase;	text-decoration: navajowhite;	border-radius: 4px;" href="{{ $emailData['url'] }}">Click here to confirm</a></td>
       </tr>
      </table></td>
    </tr>
   </table></td>
 </tr>
</table>