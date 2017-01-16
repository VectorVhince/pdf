<div class="wd100P mgt40">
    <div class="wd100P mgv20 bgc-red" style="height: 100px;">
        <div class="container">
            <a href=" {{ url('/') }} ">
                <div style="row">
                    <div class="col-xs-1 pdl0">
                        <img src="{{ asset('/img/TheAngelite.png') }}" style="height: 150px; margin-top: -30px; margin-left: -50px;">                
                    </div>
                    <div class="fc-white col-xs-4 pdh0 mgv15">
                        <span class="dp-bl"  style="font-size: 50px; font-family: arongrotesque">
                            THE ANGELITE
                        </span>
                        <span class="dp-bl" style="font-style: italic; font-size: 15px;">
                            The Official Student Publication of Holy Angel University
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="container pdh0">
    <nav class="navbar navbar-default navbar-static-top bgc0 bd0">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="fs17 pdh20"><a class="fc-black" href=" {{ route('index.news') }} ">NEWS</a></li>
                <li class="fs17 pdh20"><a class="fc-black" href=" {{ route('index.editorial') }} ">EDITORIAL</a></li>
                <li class="fs17 pdh20"><a class="fc-black" href=" {{ route('index.opinion') }} ">OPINION</a></li>
                <li class="fs17 pdh20"><a class="fc-black" href=" {{ route('index.feature') }} ">FEATURE</a></li>
                <li class="fs17 pdh20"><a class="fc-black" href=" {{ route('index.humor') }} ">HUMOR</a></li>
                <li class="fs17 pdh20"><a class="fc-black" href=" {{ route('index.sports') }} ">SPORTS</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                    <li class="mgr10 pdv10">
                        <form action="{{ route('search') }}" method="get">
                            <div style="display: flex;">
                                <input type="text" name="search" class="form-control input-sm" placeholder="Search..." style="flex: 1;">
                                <button type="submit" class="mgr20 mgl10 pdv5 bgc0 bd0"><i class="glyphicon glyphicon-search pointer"></i></button>
                            </div>
                        </form>
                    </li>
                @if (Auth::guest())
                    <li class="mg15 hidden"><a href="{{ url('/login') }}" class="pdv0 pdh15 mgh15 bdb0"><button class="btn-red-o bd-rad10 fc-white pd15"><i class="glyphicon glyphicon-user"></i> Log In</button></a></li>
                    <li class="hidden"><a href="{{ url('/register') }}" class="fc-black">Register</a></li>
                @else
                    <li class="dropdown mgr15 hidden">
                        <a href="#" class="dropdown-toggle fc-black" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('create') }}">Add New Post</a></li>
                            <li><a href="{{ url('create/announcement') }}">Make Announcement</a></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>        
</div>
@if (Auth::user())
<div class="user-notifications-container">
    <div class="dropup">
        <a href="#" class="dropdown-toggle fc-black" data-toggle="dropdown" role="button" aria-expanded="false" id="dropdownMenu1">
            <div class="user-notifications">
                @if(!$notifs->isEmpty())
                    @if(!$notifs->where('active','1')->count() == 0)
                        <span class="notification-count">{{ $notifs->where('active','1')->count() }}</span>
                    @endif
                @endif
                <span class="glyphicon glyphicon-globe"></span>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
            <div class="box-arrow"></div>
            @if(!$notifs->isEmpty())
                @foreach($notifs as $notif)
                    <li><a href="{{ route('posts.show',$notif->post_id) }}">
                        @if($notif->active == '1')
                        <span class="fc-green">
                        @else
                        <span>
                        @endif
                            {{ $notif->message }}
                        </span>
                    </a></li>
                @endforeach
            @else
                <li><a href="#">No new notifications.</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="user-menu-container">
    <div class="dropup">
        <a href="#" class="dropdown-toggle fc-black" data-toggle="dropdown" role="button" aria-expanded="false" id="dropdownMenu2">
            <div class="user-menu">                  
                <i class="glyphicon glyphicon-user fc-white"></i>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu2">
            <div class="box-arrow"></div>
            <li><a href="{{ url('settings') }}"><span class="glyphicon glyphicon-cog"></span> Account Settings</a></li>
            <li><a href="{{ route('myposts',Auth::user()->id) }}"><span class="glyphicon glyphicon-list-alt"></span> My Posts</a></li>
            <li><a href="{{ route('posts.create') }}"><span class="glyphicon glyphicon-pencil"></span> Add New Post</a></li>
            @if(Auth::user()->role == 'superadmin')
            <li><a href="{{ route('pending.posts') }}"><span class="glyphicon glyphicon-time"></span> Pending Posts</a></li>
            <li><a href="{{ url('create/announcement') }}"><span class="glyphicon glyphicon-plus-sign"></span> Make Announcement</a></li>
            <li><a href="{{ url('accounts') }}"><span class="glyphicon glyphicon-user"></span> Manage Members</a></li>
            <li><a href="{{ url('register') }}"><span class="glyphicon glyphicon-plus"></span> Register an Account</a></li>
            @endif
            <li>
                <a href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-log-out"></span>  Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>
@endif