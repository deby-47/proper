@auth()
    @include('layouts.navbars.navs.auth')
@endauth
    
@guest()
    @include('layouts.welcome.guest')
@endguest