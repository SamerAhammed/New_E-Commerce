<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Markit</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/bootstrap.css" />
        <link rel="stylesheet" href="/css/login.css" />
        <link rel="stylesheet" href="/css/pcstyle.css" />
    </head>
    <body>
        <x-header />
        <div class="wrapper " style="max-width: 80%  ">
        <form action="{{ route('store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row my-1">
            <div class="col-12 col-md-6">
              <input type="text" class="form-control"name="name" placeholder="Product Name">
            </div>
            <div class="col-12 col-md-6">
              <input type="number" class="form-control"name="price" placeholder="Price">
            </div>
            <div class="col-12 col-md-12 my-5">
              <input type="text" class="form-control"name="description" placeholder="Description">
            </div>
            <div class="col-12 col-md-12 my-5">
            <input type="file" class="form-control" id="inputGroupFile01" name="img_url">
          </div>
            <div class="col-12">
              <select class="form-select form-select-lg" name="category_id" aria-label=".form-select-lg example">
                <option value="0">unclassified</option>
                @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <hr style=" color: #747474;"/>
          <div style="text-align: center ; margin:auto  ;max-width: 40% " >
            <button type="submit" class=" btn mt-3">Save</button> 
          </div>
        </form>
        @if ($message =Session::get('faild'))
        <div class="container">
            <div class="alert alert-primary" role="alert">
                {{$message}}
            </div>
        </div>
           
        @endif
        
    </div>
    

        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
