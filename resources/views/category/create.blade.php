<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Medication</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/bootstrap.css" />
        <link rel="stylesheet" href="/css/login.css" />
        <link rel="stylesheet" href="/css/pcstyle.css" />
    </head>
    <body>
        <x-header />
        <x-card >
            
            <form action="{{ route('store_category')}}" method="POST"  >
                @csrf
                <div class="w-50 m-auto my-5">
                    <input type="text" class="form-control"name="name" placeholder="Category">
                  </div>
                  <div class="w-50 m-auto my-5">
                    <button type="submit" class=" btn mt-3">Save</button> 
                  </div>
            </form>
        </x-card >
        
        
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
