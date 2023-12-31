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

        <div class="my-3 searching" >
            <div class="container h-100 w-50">
                <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col col-xl-10" id="searchlist"></div>
                </div>
              </div>
        </div>

        <div class=" d-flex justify-content-center ">
            @if ($product->lastPage() > 1)
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="{{ $product->url($product->currentPage() - 4) }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 0; $i < 5; $i++)
                        @if ($product->lastPage() >= $product->currentPage()+$i)
                        <li class="page-item">
                            <a class="page-link" href="{{ $product->url($product->currentPage()+$i) }}"> {{ $product->currentPage()+$i}}</a>
                        </li>
                        @endif
                    
                    @endfor
                    <li class="page-item">
                        <a class="page-link" href="{{ $product->url($product->currentPage() + 4) }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>   
                </ul>
            </nav>
        @endif
        
        </div>
        <x-card >
            <h3 class=" text-center m-2">product List</h3>
            <div class="row px-5 d-flex justify-content-evenly">
                @foreach ($product as $item)
                <a href="{{route('show',['product'=>$item->id])}}" class="alert alert-dark col-10 col-md-5 text-center" style="text-decoration: none">{{$item->name}}</a>
                @endforeach
                
                
                
              </div>
            
            
        
        </x-card >
        @if ($message =Session::get('faild'))
        <div class="container  my-2">
            <div class="alert alert-primary" role="alert">
                {{$message}}
            </div>
        </div>
           
        @endif
        <script src="/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <script type="text/javascript">
        $('.search').on('keyup',function(){
            $value= $(this).val();
            
            
            $.ajax({
                        url:'{{URL::to('search')}}',
                        type:"GET",
                        data:{'search':$value},
                        success:function(data){
                            $('#searchlist').html(data);
                        }
                        

                    });
                });
           
        </script>
    </body>
</html>
