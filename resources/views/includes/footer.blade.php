<head>
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
</head>

<footer>
        <ul>
          <li><a href="{{('/home')}}">Home</a></li>
          @if(Auth::check())
          <li><a href="/users">Friends</a></li>
          <li><a href="{{route('profile.index')}}">Profile</a></li>
      @endif
        </ul>
        
        {{-- @guest
        <ul>
                <li><a href="{{ route('login') }}" class="footerList">Login</a></li>
             @if (Route::has('register'))
                <li><a href="{{ route('register') }}" class="footerList">Register</a></li>
             @endif
             @else
             <li><div class=" dropdown">
                     <a id="Dropdown" class="dropdown-toggle footerList" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                         {{ Auth::user()->name }} <span class="caret"></span>
                     </a>
                     <li><div class="dropdown-menu dropdown-menu-right" aria-labelledby="Dropdown"></li>
                         <a class="dropdown-item links footerList" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </div>
                 </div></li>
                 @endguest
             <li><a href="{{ route('home.about')}}" class="footerList">About us</a></li>
     </ul>    --}}
    
    </footer> 