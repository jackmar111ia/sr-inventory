
@if(Auth::guard('web')->check())
you are looged in as User 
@else
you are looged out as User
@endif

<br>

@if(Auth::guard('admin')->check())
you are looged in as Admin
@else
you are looged out as Admin
@endif




<br>

@if(Auth::guard('moderator')->check())
you are looged in as Moderator
@else
you are looged out as Moderator
@endif