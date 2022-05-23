<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Verification email send after registration of an moderator account</title>
</head>

<body style="background:#f5f5f5;padding:0px ">
   
    
         
    <div style="background:#fff; padding:10px; border:dotted 1px green; ">
        
        <p> <b>Dear {{ $paymentObj->client->name }},</b></p>
        <p>
           Your payment has been updated.<br>
           Update Type : {{ $paymentObj->approval_status  }} <br>
            Apartment : {{ $paymentObj->client->apartment_id }} <br>
            Amount : {{ $paymentObj->amount }} <br>
            Month  : {{ $paymentObj->month }} <br>
            Year  : {{ $paymentObj->year }} <br>
            Please log in to your account and check details in payment section.
        </p>
       

        
        <p> ============= <br>
        <b>Thanking You </b><br>
         
        <b>{{ config('app.name') }} </b>
        </p>
    </div>
</body>
</html>
