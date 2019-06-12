{{--<div class="col-md-3 left_col menu_fixed">--}}
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a class="site_title" href="{{ url('/home') }}">
                <i class="fa fa-cog mainSpinner"></i>
                <span> MONITOREO </span>
            </a>
        </div>
        <div class="profile">
            <div class="profile_pic">
                @if( Auth::check() && (session('rol')=='SUP' || session('rol')=='ADM'))
                    <img src="{{URL::asset('repository/users/admin_icon.png' )}}" alt="" class="img-circle profile_img">
                @endif
                @if( Auth::check() && (session('rol')=='CLI'))
                    <img src="{{URL::asset('repository/users/boy_icon.png' )}}" alt="" class="img-circle profile_img">
                @endif
            </div>
            <div class="profile_info">
                <span>
                    Bienvenid@
                </span>
                <h2>
                    <?=session('name.usuario')?>
                </h2>
            </div>
        </div>

        <br/><br/>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">

                <h3>Menu</h3>

                <ul class="nav side-menu">
                    <li>
                        <a href="{{url('/home')}}" class="mainMenuLink">
                            <i class="fa fa-home "></i>Inicio <span class="fa "></span>
                        </a>
                    </li>
                    <?php if(session('rol')=='SUP'){?>
                    <li><a><i class="fa fa-desktop"></i> Administración <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('admin/user')}}">Usuarios</a></li>
                            <li><a href="{{url('admin/person')}}">Personas</a></li>
                        </ul>
                    </li>
                    <?php }?>

                    <?php if(session('rol')=='SUP' || session('rol')=='ADM'){?>
                    <li><a><i class="fa fa-table"></i> Paramétros <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('param/central')}}">Centrales</a></li>
                            <li><a href="{{url('param/sensor')}}">Alarmas</a></li>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if(session('rol')!='CLI'){?>
                    <li><a><i class="fa fa-bar-chart-o"></i> Reporte <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('report/reporte')}}">Reporte</a></li>
                        </ul>
                    </li>
                    <?php }?>
                    <li><a><i class="fa fa-area-chart "></i> Bítacora <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="general_elements.html">Reporte</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>