
<form method="POST" action="{{ route('moderator.settings.accountinfo.update.send') }}">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <?php  inputfield("","text","name","form-control",'name',$moderatorInfoUpdate->name,'',"Your name",'','',"","readonly,'','','',$errors");   ?>
            @php isError($errors,'name') @endphp
        </div>
    </div>

    <div class="form-group row">
        <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('NID') }}</label>

        <div class="col-md-6">
            <?php  inputfield("","text","nid","form-control",'nid',$moderatorInfoUpdate->nid,'',"Your NID",'','',"","readonly,'','','',$errors");   ?>
            @php isError($errors,'nid') @endphp
        </div>
    </div>

    <div class="form-group row">
        <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Present address') }}</label>

        <div class="col-md-6">
            <?php textareaBox("","present_address",'','','Enter present address','','',$moderatorInfoUpdate->present_address,'','readonly'); ?>
            @php isError($errors,'present_address') @endphp
        </div>
    </div>

    <div class="form-group row">
        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Permanent address') }}</label>

        <div class="col-md-6">
            <?php textareaBox("","permanent_address",'','','Enter permanent address','','',$moderatorInfoUpdate->permanent_address,'','readonly'); ?>
            @php isError($errors,'permanent_address') @endphp
        </div>
    </div>

    <div class="form-group row">
        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

        <div class="col-md-6">
            <?php textareaBox("","note",'','','Enter note if you have any','','','','',''); ?>
            @php isError($errors,'note') @endphp
        </div>
    </div>


    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
        <a href="{{ route('moderator.settings.accountinfo.update') }}" class="btn btn-primary">Edit</a>

        <button  onclick="return confirmForPublishment()"  class="btn btn-success">Send for pubmishment</button>
        </div>
    </div>
</form>




<script  type="text/javascript">  
                function confirmForPublishment()
                {
                    var agree=confirm("Do you really want to send for publishment?");
                    if(agree)
                    return true;
                    else
                    return false;
                }
            </script> 