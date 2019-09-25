<header>
        <div class="container">
          <div class="title">
            Music <br>Compass
          </div>
         <nav>
           <ul class="clearfix">
             <div class="row forMenu">
                    <li class="col-md-4"><a href="{{('/home')}}">Home</a></li>
                 @if(Auth::check())
                    <li class="col-md-4"><a href="/users">Friends</a></li>
                    <li class="col-md-4"><a href="{{route('profile.index')}}">Profile</a></li>
                 @endif
             </div>
           </ul>
          </nav>
          @if(Session::has('result'))
          <div class="alert alert-info text-center">
              {{session()->get('result')}}
          </div>
          @endif
              @if (session('success'))
                  <div class="alert alert-success text-center" role="alert">
                      {{ session('success') }}
                  </div>
              @endif
        </div>
       </header>