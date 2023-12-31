<div>
    <nav class="navbar row fixed-top navbar-expand navbar-light " style="background-color: #eee;">
        <div class="row container-fluid">
            <a class="col-2 navbar-brand mx-0 px-5" href="/">Markit</a>
            <div class="row col-10">
               
                @auth  
                <a class="col-1 btn btn-secondary mx-1" href="/create">Create</a>
                @endauth 
                
                <a class="col-1 btn btn-secondary mx-1" href="/signup">SignUp</a>
                @guest
                <a class="col-1 btn btn-secondary mx-1" href="/login">Login</a>
                @endguest
                @auth  
                <a class="col-1 btn btn-secondary mx-1" href="/logout">Logout</a>
                @endauth 
                <a class="col-1 btn btn-secondary mx-1" href="/cpanel">Cpanel</a>
                
                 
            </div>
                     
      </nav>
</div>