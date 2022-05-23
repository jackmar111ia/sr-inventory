
 @if (!empty(old('pp_upload')))
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            @php
                txt("Sorry! There were some problems with your input.");
            @endphp
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
 
    @endif

    @php 
    //dd($moderatorInfo);
    @endphp
    
    @if((session('success')) AND (empty(old('pp_upload'))))
                <div class="alert alert-success">
                {{ session('success') }}
                </div> 
            @endif
 
           
<fieldset>
		 <legend>Moderator Information</legend>

         <table>
                    <tr>
                        <td><b><?php  txt("Name");?> </b></td>
                        <td>{{ $moderatorInfo->name }}</td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Email");?></b></td>
                        <td>{{ $moderatorInfo->email }}</td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Phone");?></b> </td>
                        <td>{{ $moderatorInfo->country_code }} {{ $moderatorInfo->phone }}</td>
                    </tr>

                   
                    <tr>
                        <td><b><?php  txt("Present Address");?></b> </td>
                        <td>{{ $moderatorInfo->present_address }} </td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Permanent Address");?></b> </td>
                        <td>{{ $moderatorInfo->permanent_address }} </td>
                    </tr>
                   

                    <tr>
                        <td><b><?php  txt("NID");?></b> </td>
                        <td>{{ $moderatorInfo->nid }} </td>
                    </tr>

                    <tr>
                        <td><b><?php  txt("Notification Type");?></b> </td>
                        <td>@php small_label("primary",$moderatorInfo->notiType); @endphp </td>
                    </tr>

                </table>

                @if($GenInfoStatus == "open")
                    <a href="{{ route('moderator.settings.accountinfo.update') }}" class="btn btn-success">Edit</a>
                @endif
                

</fieldset>
