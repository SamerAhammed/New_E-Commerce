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
        <nav class="navbar navbar-expand  ">
            <div class="row w-100 d-flex justify-content-center px-3">
                <form class="col-6 col-sm-3">
                    <div>
                        <input class="form-control search" type="search" name="search" placeholder="Search" aria-label="Search">
                    </div>
                </form> 
                <div class="dropdown col-6 col-sm-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @auth
                        <li><a class="dropdown-item" href="{{route('create_category')}}">Create Category</a></li>
                        @endauth
                        
                        <li><a class="dropdown-item" href="/">All</a></li>
                        @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="{{route('category',['category_id'=>$category->id])}}">{{$category->name}}</a></li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>     
        </nav>
        <x-card >
            <h3 class=" text-center m-2">product List</h3>
            <div class="row px-5 d-flex justify-content-evenly">
                @foreach ($product as $item)
                <a href="{{route('show',['product'=>$item->id])}}" class="alert alert-dark col-10 col-md-5 text-center" style="text-decoration: none">{{$item->name}}</a>
                @endforeach
                
                
                
              </div>
            
            
        
        </x-card >
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
