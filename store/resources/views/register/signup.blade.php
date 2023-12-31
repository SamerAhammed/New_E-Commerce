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
        <div class="bg-light w-75 p-5 m-auto">
            <form action="{{ route('submit_signup')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">User name</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" >
                    
                  </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="whatsapp_url" class="form-label">Whatsapp url</label>
                    <input type="text" class="form-control" id="whatsapp_url" name="whatsapp_url">
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                @if ($errors->any())
                <div class="alert alert-danger my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              </form>
             
        </div>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
