<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
</head>
<body>
    <div class="container mt-4">
        <input type="color">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Change Color</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($hotels as $hotel)
                
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td >{{$hotel->name}}</td>
                    <td class="target" style="background-color: #{{$hotel->color}}" data-id="{{$hotel->id}}"></td>
                </tr>
                @php $i=$i+1; @endphp
                @endforeach
                
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        
        $(function () {
          
            $(".target").on('click', function () {
                
                let colorValue = $("input[type=color]").val().substring(1);
                console.log(colorValue);
                this.style.backgroundColor = '#'+colorValue;
                let id = $(this).attr('data-id');
                $.ajax({
                    
                    type: "get",
                    url: `./update1/${id}/${colorValue}`,
                    dataType: "json", 

                });
            });     
        });
        
    </script>
</body>

</html>