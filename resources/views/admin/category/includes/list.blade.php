@php 
  
    $categoryList = categoryList();
    //dd($categoryList);
    @endphp
    <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                        <th><?php txt("Id");?></th>
                        
                        <th><?php txt("Category Name");?></th>
                        <th><?php txt("Product Qty");?></th>
                        <th><?php txt("Added By");?></th>
                        <th><?php txt("Operation");?></th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($categoryList as $category)
                            @php 
                                $prQty = productQty($category->id);
                            @endphp
                             
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                          
                            <td>{{ $category->category }}</td> 
                            <td> @php if($prQty>0) small_label("danger",$prQty); else small_label("primary",$prQty); @endphp </td> 
                            
                            <td>{{ $category->added_admin->name }}</td>    
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.category.management.edit',['id' => $category->id]) }}" type="button" 
                                    class="btn btn-success btn-xs m-b-10">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>  Edit 
                                    </a>
                                </div>
                            </td>
                        </tr>                              
                        @endforeach                                            
                    </tbody>
                </table>
                {{ $categoryList->links() }} 
 

   
 