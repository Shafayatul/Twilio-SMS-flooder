<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {{-- Meta, title, CSS, favicons, etc. --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Twilio Call Flooder</title>

    {{-- Bootstrap --}}
    <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- Custom Theme Style --}}
    <link href="{{ URL::asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/call.custom.css') }}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title">
                <i class="fa fa-volume-control-phone"></i> 
                <span>Call Flooder</span>
              </a>
            </div>
            <div class="clearfix"></div>
            <br />

            {{-- sidebar menu --}}
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-music"></i> Audio files <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('audios.create')}}">Add Audio</a></li>
                      <li><a href="{{route('audios.index')}}">Audio List</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-phone"></i> Call Flooder <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('callFlooders.create')}}">Add Call Flooder</a></li>
                      <li><a href="{{route('callFlooders.index')}}">Call Flooder List</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-calendar" aria-hidden="true"></i> Schedules <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('schedules.create')}}">Add Schedule</a></li>
                      <li><a href="{{route('schedules.index')}}">Schedule List</a></li>
                    </ul>
                  </li>



                  <li><a href="{{route('twilioCredentials.edit',1)}}"><i class="fa fa-info-circle"></i>Twilio Login Credentials</a>
                  </li>
                </ul>
              </div>
            </div>
            {{-- /sidebar menu --}}

            {{-- /menu footer buttons --}}
            <div class="sidebar-footer hidden-small">

            </div>
            {{-- /menu footer buttons --}}
          </div>
        </div>

        {{-- top navigation --}}
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                {{--                                 
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li> --}}
              </ul>
            </nav>
          </div>
        </div>
        {{-- /top navigation --}}

        {{-- page content --}}
        <div class="right_col" role="main">

          <div class="row">
            <div class="col-md-12">
              @if(Session::has('success'))
              <div class="alert alert-success">
                <strong>Success!</strong> {{ Session::get('success') }}
              </div>
              @endif
              
              @if(Session::has('error'))
              <div class="alert alert-danger">
                <strong>Error!</strong> {{ Session::get('error') }}
              </div>
              @endif   
                         
              @if(count($errors)>0)
              <div class="alert alert-danger">
                <strong>Error!</strong> 
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
              </div>
              @endif


            </div>
          </div>


          @yield('content')
          <br />
        </div>
        {{-- /page content --}}

        {{-- footer content --}}
        <footer>
          <div class="pull-right">
            
          </div>
          <div class="clearfix"></div>
        </footer>
        {{-- /footer content --}}
      </div>
    </div>

    {{-- jQuery --}}
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    {{-- Custom Theme Scripts --}}
    <script src="{{ URL::asset('build/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('js/call.custom.js') }}"></script>
    {{-- Font Awesome --}}
    <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    {{-- add script according to page --}}
    @stack('scripts')



    
  </body>
</html>
