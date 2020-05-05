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
    
    </footer> 