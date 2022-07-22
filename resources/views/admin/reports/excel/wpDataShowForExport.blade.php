<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>Laravel 6 Import Export Excel with Heading using Laravel Excel 3.1 - MyNotePaper</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <a href="https://shouts.dev/" target="_blank"><img src="https://i.imgur.com/hHZjfUq.png"></a><br>
        <span class="text-secondary">Laravel 6 Import Export Excel with Heading using Laravel Excel 3.1</span>
    </div>
    <br/>

    <div class="clearfix">
        <div class="float-left">
            <form class="form-inline" action="{{url('books/import')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imported_file"/>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <button style="margin-left: 10px;" class="btn btn-info" type="submit">Import</button>
            </form>
        </div>
        <div class="float-right">
            <form action="{{url('books/export')}}" enctype="multipart/form-data">
                <button class="btn btn-dark" type="submit">Export</button>
            </form>
        </div>
    </div>
    <br/>
  <!--wp_regular_price`,`regular_price`,`wp_canada_price`,`canada_price`,`wp_ontario_price`,`ontario_price`,`view_type`,`save_type`,`serial`,`view_status`,`added_as_inhouse`,`categories`,`created_at`,`updated_at`-->
    @if(count($books))
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Description</td>
            </tr>
            </thead>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->wp_id}}</td>
                    <td>{{$book->wp_title}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->permalink}}</td>
                    <td>{{$book->image}}</td>
                    <td>{{$book->resize_image}}</td>
                    <td><?php echo  $book->wp_short_des; ?></td>
                    <td><?php echo  $book->short_des; ?></td>
                    <td>{{$book->wp_sku}}</td>
                    <td>{{$book->sku}}</td>
                    <td>{{$book->type}}</td>
                    <td>{{$book->wp_variable_product_price}}</td>
                    <td>{{$book->variable_product_price}}</td>

                  
                </tr>
            @endforeach
        </table>
    @endif

</div>

</body>
</html>