@php
    $moderatorId = Auth::user()->id;
    $moderatorInfo = moderatorInfo($moderatorId);

    $moderatorUpdateTrackCnt = ModeratorUpdateCurrentRow($moderatorId,"count","approval_pending");
    if($moderatorUpdateTrackCnt > 0){
        $moderatorInfoUpdate =  ModeratorUpdateCurrentRow($moderatorId,"row","approval_pending");
    }
     //dd($moderatorInfoUpdate);
   
@endphp
 
         
<fieldset>
		 <legend>Moderator updated Information</legend>

         <table>
                    <tr>
                        <td><b><?php  txt("Name");?> </b></td>
                        <td>  {{ $moderatorInfoUpdate->name }}</td>
                    </tr>
                   <tr>
                        <td><b><?php  txt("Present Address");?></b> </td>
                        <td>{{ $moderatorInfoUpdate->present_address }} </td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Permanent Address");?></b> </td>
                        <td>{{ $moderatorInfoUpdate->permanent_address }} </td>
                    </tr>
                   

                    <tr>
                        <td><b><?php  txt("NID");?></b> </td>
                        <td>{{ $moderatorInfoUpdate->nid }} </td>
                    </tr>

                    <tr>
                        <td><b><?php  txt("Note");?></b> </td>
                        <td>{{ $moderatorInfoUpdate->note }} </td>
                    </tr>

                </table>

                @if($GenInfoStatus == "open")
                    <a href="{{ route('moderator.settings.accountinfo.update') }}" class="btn btn-success">Edit</a>
                @endif
                

</fieldset>


 