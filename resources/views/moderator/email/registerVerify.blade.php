<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Verification email send after registration of an moderator account</title>
</head>

<body style="background:#f5f5f5;padding:0px ">
   
    
         
    <div style="background:#fff; padding:10px; border:dotted 1px green; ">
        <h3 style="   color:#fff; background:#B61F3F; text-align:center">
          Registration successful as a moderator!
        </h3>
        <p> <b>Dear {{ $name }},</b></p>
        <p>
            Welcome to <b>{{ config('app.name') }}</b> as a moderator !<br>
            You have successfully enlisted in our system as a moderator with our terms and condition.  <br>
            <a  href = "{{ route('moderator.account.activate', ['email' => $email, 'token' => $token ]) }}" >Please click the link to activate your account।!</a><br>
        </p>
       

        
        <p> ============= <br>
        <b>Thanking You </b><br>
        
        <br>
        <b>{{ config('app.name') }} </b>
        </p>
    </div>
</body>
</html>
