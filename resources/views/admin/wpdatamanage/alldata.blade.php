   
<div class="card card-topline-green">
   
      
   <div class="panel-body">
       <div class="tab-content">

       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
       <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
       <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">

       <table class="table table-bordered pagin-table" id="table1" name="table1">
           <tbody id="sortable">
               <tr>
                   <th>Sl No</th>
                   <th>Name</th>
                   <th>Course</th>
                   <th>Mobile No</th>
               </tr>
               <form action="{{route('check')}}">
                   @php($i=1)
                   @foreach ($all as $test)
                   
                   <tr id="item-{{$test->id}}">
                       <td>{{$i}}</td>
                       <td>{{$test->title}}</td>
                       <td>{{$test->sku}}</td>
                       <td>{{$test->regular_price}}</td>
                   </tr>
                   @php($i++)
                   @endforeach                
               </form>
           </tbody>
       </table>
       <script>
           $('tbody').sortable(
           {
               axis: 'y',
               update: function (event, ui) {
                   var data = $(this).sortable('serialize');
                    $.ajax({
                       data: data,
                       type: 'GET',
                       // url: '/check'
                       url: "{{route('check')}}"
                   });
               }
           }
           );
       </script>



         <?php /*  @include('admin.wpdatamanage.includes.data.all') */?>

       </div>
   </div>

</div>
