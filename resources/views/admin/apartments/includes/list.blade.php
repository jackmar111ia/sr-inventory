@php 
  
    $apartmentList = apartmentsList();
    //dd($apartmentList);
    @endphp
    <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                        <th><?php txt("Id");?></th>
                        
                        <th><?php txt("Apratment Name");?></th>
                        <th><?php txt("Status");?></th>
                        <th><?php txt("Client name");?></th>
                    
                        <th><?php txt("Added By");?></th>
                        <th><?php txt("Operation");?></th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($apartmentList as $apartment)

                             
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            
                            <td>{{ $apartment->apartment_name }}</td>    
                             

                            <td>  
                                <div class="btn-group">
                                    @if($apartment->status == "available")
                                        @php small_label("success","Available"); @endphp
                                    @else
                                        @php small_label("danger","Not Available"); @endphp
                                    @endif
                                    
                                </div>
                                
                            </td>
                            <td>  {{ $apartment->client_apartment->name }}  </td>        
                            <td>  {{ $apartment->added_admin->name }}  </td>        
                             
                            <td>
                                <div class="btn-group">
                                   

                                    
                                      <a href="{{ route('admin.apartment.management.edit',['id' => $apartment->id]) }}" type="button" 
                                      class="btn btn-success btn-xs m-b-10">
                                      <i class="fa fa-pencil" aria-hidden="true"></i>  Edit 
                                      </a>

                                       
                                       
                                </div>
                            </td>

                        </tr>                              
                        @endforeach                                            
                    </tbody>
                </table>
                {{ $apartmentList->links() }} 
 

   
 