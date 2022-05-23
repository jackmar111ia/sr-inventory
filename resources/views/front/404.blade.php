@extends('front.master')
 @section('page-title')
    Access denied
 @endsection
 @section('middle-content')

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
    body{
        font-size: 1em;
        }
        @media only screen and (max-width: 320px) {
        body { 
        font-size: 1em; 
        }

        
    }

    td {
         word-break: break-all;
        }
</style>
 <div class="col-sm-12">
        <div class="card "  style="margin-top:10px">
             
            <div class="card-body">

            

                <div class="alert alert-warning" role="alert">
                   Opps! Something went wrong!<br>
                   You need to register/log in our site to see the report.<br>
                   please click the link <a href="https://www.simplyretrofits.com/my-account/">Register/Login</a> 
                </div>
                
            </div>
        </div>
    </div>
@endsection