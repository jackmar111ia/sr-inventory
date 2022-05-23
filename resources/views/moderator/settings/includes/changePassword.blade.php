<div class="col-md-6 col-sm-6">
        
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {!! Form::open(['url' => 'moderator/settings/change-password','method'=>'post', 'enctype'=> 'multipart/form-data', 'role'=>'form', 'name'=>'addform']) !!}        
    @csrf
        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
            <label for="new-password" class="col-md-6 control-label"><?php txt("Your current password");?></label>

            <div class="col-md-12">
                <input id="current-password" type="password" class="form-control" name="current-password" required>

                @if ($errors->has('current-password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('current-password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
            <label for="new-password" class="col-md-6 control-label"><?php txt("Your New password");?> </label>

            <div class="col-md-12">
                <input id="new-password" type="password" class="form-control" name="new-password" required>

                @if ($errors->has('new-password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="new-password-confirm" class="col-md-6 control-label"> <?php txt("Confirm password");?></label>

            <div class="col-md-12">
                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                Save Password
                </button>
            </div>
        </div>
    {!! Form::close() !!}
</div>

