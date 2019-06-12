<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a class="site_title" href="{{ url('/home') }}">
                <i class="fa fa-cog mainSpinner"></i>
                <span> INVENTORY </span>
            </a>
        </div>
        <div class="profile">
            <div class="profile_pic">
                @if( isset(Auth::User()->people->image) )
                    <img src="{{URL::asset('repository/users/'.Auth::User()->people->image )}}" alt=""
                         class="img-circle profile_img">
                @elseif( Auth::User()->people->sex=='male' )
                    <img src="{{URL::asset('repository/users/boy_icon.png' )}}" alt="" class="img-circle profile_img">
                @else
                    <img src="{{URL::asset('repository/users/girl_icon.png' )}}" alt="" class="img-circle profile_img">
                @endif
            </div>
            <div class="profile_info">                                
                <span>
                    Bienvenid{{(Auth::User()->people->sex=='male')? 'o': 'a'}}
                </span>
                <h2>{{ Auth::User()->people->name }} {{ Auth::User()->people->surname }}</h2>
            </div>
        </div>

        <br/><br/>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{url('/home')}}" class="mainMenuLink">
                            <i class="fa fa-home "></i>Inicio <span class="fa "></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('parts/list')}}" class="mainMenuLink">
                            <i class="fa fa-search"></i>Buscar
                        </a>
                    </li>
                    <li>
                        <a href="{{url('branches')}}" class="mainMenuLink">
                            <i class="fa fa-search"></i>tester
                        </a>
                    </li>
                    <li>
                        <a href="{{url('branches/list')}}" class="mainMenuLink">
                            <i class="fa fa-bank"></i>Sucursales
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-shopping-cart"></i>Solicitudes
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{url('application/list')}}" class="mainMenuLink">Todas las Solicitudes <span
                                            class="fa fa-table"></span></a>
                            </li>
                        </ul>
                    </li>
                    <li title="Configuración">
                        <a>
                            <i class="fa fa-cog"></i> Config. <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li><a href="#" class="mainMenuLink">Usuarios</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>