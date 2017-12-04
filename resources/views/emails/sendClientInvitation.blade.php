<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invitation</title>
</head>

<body>
<table width="650" border="0" cellspacing="0" cellpadding="0" style="margin: auto; padding: 10px; border: 1px solid #ccc; 

    font-family: 'Open Sans', sans-serif;

">
 <tr>
  <br />
  <td style="font-size:22px;">Hi {{ $emailData['clientName'] }},<br /><br /></td>
 </tr>
 <tr>
  <br />
  <td style="font-size:20px; font-style:italic;">Thank you for choosing {{ $emailData['companyName'] }}.<br /><br /></td>
 </tr>
 <tr>
  <td style=" line-height: 24px; text-align: justify;">{!! $emailData['finalTemplateContent'] !!}</td>
 </tr>
 <tr>
  <td align="center" style=" padding-top:30px; padding-bottom:30px;"><a href="{{ $emailData['invitationURL'] }}" style="background-color:#1976d2; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px; color:#fff; font-size:18px; font-weight:bold; text-transform:uppercase; border-radius:50px; border:none; text-decoration: none;">Get Started<a/></td>
 </tr>
 <tr>
  <td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" background-color:#e1e1e1; padding:20px;">
   <tr>
    <td width="15%" style="vertical-align:baseline;"><img src="{{ url('/images/agents/' . $emailData['agentDetails']['image']) }}" height="80" width="80" style="border-radius: 50px; border: 5px solid #ececec;" alt="{{ ucwords( strtolower( trim( $emailData['agentDetails']['fname']. ' ' .$emailData['agentDetails']['lname'] ) ) ) }}"></td>
    <td width="85%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td style="font-weight:bold;">Agent name</td>
     </tr>
     <tr>
      <td>{{ ucwords( strtolower( trim( $emailData['agentDetails']['fname']. ' ' .$emailData['agentDetails']['lname'] ) ) ) }}</td>
     </tr>
     <tr>
      <!--<td style="color:#d33039;">T | +61870891484</td>-->
     </tr>
     <tr>
      <td><a href="javascript:void(0)" style="color:#1976d2; text-decoration:underline;">{{ $emailData['agentDetails']['email'] }}</a></td>
     </tr>
     <tr>
      <td>{{ $emailData['agentDetails']['address'] }}</td>
     </tr>
    </table></td>
   </tr>
  </table></td>
 </tr>
 <tr>
  <td style=" background-color:#363636; padding:20px;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
   <tr>
    <td width="68%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td style="color:#fff; font-weight:bold;">{{ $emailData['companyName'] }}</td>
     </tr>
     <tr>
      <td style="color:#fff;">{{ $emailData['companyAddress'] }}</td>
     </tr>
     <tr>
      <!--<td style="color:#d33039;">1300 304 820</td>-->
     </tr>
     <tr>
      <!--<td><a href="javascript:void(0)" style="color:#d33039; text-decoration:none;">www.udistro.com</a></td>-->
     </tr>
    </table></td>
    <!--<td width="32%" style="text-align:right;"><img src="image/abc-homes.png" alt="" title=""/></td>-->
   </tr>
  </table></td>
 </tr>
 <tr>
  <td style=" background-color:#363636;"><table width="200" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-top:20px; padding-bottom:20px;">
 <tr>
    <td><?php echo ( $emailData['agentDetails']['twitter'] != '' ) ? '<a href="'. $emailData['agentDetails']['twitter'] .'"><img src="'. url('/images/emails/' . 'twitter_n.png') .'" alt="Twitter" width="24" height="24"></a>' : '' ?></td>
    <td><?php echo ( $emailData['agentDetails']['linkedin'] != '' ) ? '<a href="'. $emailData['agentDetails']['linkedin'] .'"><img src="'. url('/images/emails/' . 'linkedin_n.png') .'" alt="Linkedin" width="24" height="24"></a>' : '' ?></td>
    <td><?php echo ( $emailData['agentDetails']['skype'] != '' ) ? '<a href="'. $emailData['agentDetails']['skype'] .'"><img src="'. url('/images/emails/' . 'skype_n.png') .'" alt="Skype" width="24" height="24"></a>' : '' ?></td>
    <td><?php echo ( $emailData['agentDetails']['website'] != '' ) ? '<a href="'. $emailData['agentDetails']['website'] .'"><img src="'. url('/images/emails/' . 'website_n.jpg') .'" alt="Website" width="24" height="24"></a>' : '' ?></td>
</tr>
</table>
</td>
 </tr>
</table>
</body>
</html>
