<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="images/trafficity_logo.png" class="logo" alt="Trafficity"/> Trafficity</a>
        </div>

        <div class="collapse navbar-collapse" id="my-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"> Home</span></i></a></li>
                <li><a href="{{ url('roadevent') }}"><i class="fa fa-map-marker" aria-hidden="true"> RoadEvent</i></a></li>
                <li><a href="{{ url('roadcongestion') }}"><i class="fa fa-road" aria-hidden="true"> RoadCongestion</i></a></li>
                <li><a href="{{ url('prediction') }}"><i class="fa fa-bar-chart" aria-hidden="true"> RoadPrediction</i></a></li>
                <li><a href="{{ url('https://drive.google.com/open?id=1MX3DkhB4FUHRrg37kt-5jg-i7wDp0rnxAclB1dXcvmA') }}"><i class="fa fa-envelope" aria-hidden="true"> Feedback</i></a></li>
            </ul>

            <!-- <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul> -->
        </div>
    </div>
</nav>
