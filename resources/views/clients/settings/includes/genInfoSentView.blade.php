<?php 

$clientUpdateTrackCnt = ClientUpdateCurrentRow($clientId,"count","approval_pending");
if($clientUpdateTrackCnt > 0){
    $clientInfoUpdate =  ClientUpdateCurrentRow($clientId,"row","approval_pending");
}
//dd($clientUpdateTrackCnt);
 
 ?>
    
<fieldset>
		 <legend>Client updated Information</legend>

         <table>
                    <tr>
                        <td><b><?php  txt("Name");?> </b></td>
                        <td>  {{ $clientInfoUpdate->name }}</td>
                    </tr>
                   <tr>
                        <td><b><?php  txt("Present Address");?></b> </td>
                        <td>{{ $clientInfoUpdate->present_address }} </td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Permanent Address");?></b> </td>
                        <td>{{ $clientInfoUpdate->permanent_address }} </td>
                    </tr>
                   

                    <tr>
                        <td><b><?php  txt("NID");?></b> </td>
                        <td>{{ $clientInfoUpdate->nid }} </td>
                    </tr>

                    <tr>
                        <td><b><?php  txt("Note");?></b> </td>
                        <td>{{ $clientInfoUpdate->note }} </td>
                    </tr>

                </table>

                @if($GenInfoStatus == "open")
                    <a href="{{ route('moderator.settings.accountinfo.update') }}" class="btn btn-success">Edit</a>
                @endif
                

</fieldset>


