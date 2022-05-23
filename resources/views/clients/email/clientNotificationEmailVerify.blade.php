<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Verification email send after registration of an moderator account</title>
</head>

<body style="background:#f5f5f5;padding:0px ">
   
<div style="background:#fff; padding:10px; border:dotted 1px green; ">



        <p> <b>Dear {{ $name }},</b></p>
        <p>
          We are pleased dealing with you as SR customer.<br>
          From now you will need to see, the product list with offer price, in our newly developed marketing webpage.<br>
          So you need to create an account there with your SR account info.<br>
          Please follow the link below to explore the Marketing Web application.<br>
         <br>
          <b>Your login Information</b><br>
          Email : {{$email}}<br>
          Password : You will be asked to create<br>
          
           <br>
            <a  href = "{{ route('client.account.activate', ['email' => $email, 'token' => $token ]) }}" > Please follow the link to proceed.</a><br>
        </p>
       
        <p>
          For any query please contact at <a href="mailto: gillonkar@gmail.com"> gillonkar@gmail.com</a>
        </p>

        
        <p> ============= <br>
        <b>Thanking You </b><br>
        
        <br>
        <b>{{ config('app.name') }} </b>
      
        </p>
    </div>
</body>
</html>
