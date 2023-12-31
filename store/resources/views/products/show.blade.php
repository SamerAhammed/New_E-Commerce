<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Markit</title>
        
        <link rel="stylesheet" href="/css/bootstrap.css" />
        <link rel="stylesheet" href="/css/login.css" />
        <link rel="stylesheet" href="/css/pcstyle.css" />
      
    </head>
    <body> 
      <x-header />
        <div class="container">
            <table class="table">
                <table class="table table-bordered prescription">
                    <thead>
                    <tr>
                        <th scope="col" class="text-black" >Product Name</th>
                        <th scope="col" class="text-black">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-light">
                        <td scope="row">{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                    </tr>
                    </tbody>
                </table>
            </table>
            <div class="card text-dark prescription " >
                <div class="card-header text-black h5">Description</div>
                <div class="card-body bg-light">
                  <p class="card-text">{{$product->description}}</p>
                </div>
            </div>
            <form class="col-4 px-0 px-sm-2 px-md-3 px-lg-4" style=""  action="{{route('destroy',['product'=>$product->id])}}"  method="post">
                @method('DELETE')
                @csrf
                <input type="number" value={{$product->id}} class="d-none" name="id" >
                <button type="submit" class=" w-75" style="text-align: center;border: none">Delete</button>
                
            </form>
        </div>
        <script src="js/bootstrap.min.js"></script>
</body>
</html>
