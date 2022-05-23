
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
		 <legend>Customer Information</legend>

         <table>
                    <tr>
                        <td><b><?php  txt("Name");?> </b></td>
                        <td>{{ $clientInfo->name }}</td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Email");?></b></td>
                        <td>{{ $clientInfo->email }}</td>
                    </tr>
                    <tr>
                        <td><b><?php  txt("Phone");?></b> </td>
                        <td>  {{ $clientInfo->phone }}</td>
                    </tr>

                    <tr>
                        <td><b><?php  txt("User name");?></b> </td>
                        <td>{{ $clientInfo->user_name }} </td>
                    </tr>

                      
                </table>

                @if($GenInfoStatus == "open")
                    <a href="{{ route('client.settings.accountinfo.update') }}" class="btn btn-success">Edit</a>
                @endif
                

</fieldset>
