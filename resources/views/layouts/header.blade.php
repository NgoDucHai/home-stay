<nav class="gtco-nav" role="navigation">
    <div class="gtco-container">

        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div id="gtco-logo"><a href="/">Homestay<em>.</em>VN</a></div>
            </div>
            <div class="col-xs-8 text-right menu-1">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li class="/">
                        <a href="services.html">Services</a>
                        {{--<ul class="dropdown">--}}
                            {{--<li><a href="#">Food Catering</a></li>--}}
                            {{--<li><a href="#">Wedding Celebration</a></li>--}}
                            {{--<li><a href="#">Birthday's Celebration</a></li>--}}
                        {{--</ul>--}}
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('auth/login') }}">Login</a></li>
                        <li><a href="{{ url('auth/register') }}">Register</a></li>
                    @else
                    <li class="has-dropdown">
                        <a href="#">
                            <img src="/upload/avatars/{{ Auth::user()->avatar }}" class="img-circle special-img">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown">
                            <li><a href="{{ url('/profile') }}">
                                    <i class="fa fa-btn fa-user"></i> Profile</a></li>
                            <li><a href="{{ url('#') }}"><i class="fa fa-home" aria-hidden="true"></i> My homestay</a>
                            </li>
                            <li><a href="{{ url('add') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create homestay</a></li>
                            <li><a href="{{ url('auth/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>

