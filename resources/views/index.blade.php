<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/workspace.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        @yield('extrastyle')
        <script type="text/javascript" src="{{ asset('js/jquery/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/page/index.js') }}"></script>
        @yield('extrajs')
    </head>
        <body>
                <div class="project-name">
                    Work Plan App
                </div>
                <div class="container-project" onclick="notificationShow(0)">
                    @yield('container-project')
                </div>
                
                <div class="container-icon" onclick="notificationShow(0)">
                    <a href="/home/" style="text-decoration: none; color:unset;">
                        <div class="icon-items" title="Dashboard" id="dashboardIconId">
                            <span class="fa fa-home"></span>
                        </div>
                    </a>
                    <a href="/projects/" style="text-decoration: none; color:unset;">
                        <div class="icon-items" title="Project Lists" id="projectIconId">
                            <span class="fa fa-building"></span>
                        </div>
                    </a>
                    <a href="/chats/" style="text-decoration: none; color:unset;">
                        <div class="icon-items" title="Project Chats" id="chatIconId">
                            <span class="fa fa-comment"></span>
                        </div>
                    </a>
                    <a href="/settings/" style="text-decoration: none; color:unset;">
                        <div class="icon-items" title="User Settings" id="settingIconId">
                            <span class="fa fa-cog"></span>
                        </div>
                    </a>
                    <a href="#" style="text-decoration: none; color:unset;"
                        onclick="modalLogout(1)"
                    >
                        <div class="icon-items" title="Logout" id="logoutIconId">
                            <span class="fa fa-power-off"></span>
                        </div>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
                @yield('project-details')
                <div class="container-full" onclick="notificationShow(0)">
                    @yield('container-full')
                </div>
                @yield('chat')
                @yield('popup')
                  <div class="popup-modal" id="modalLogout">
                    <div class="popup-content" >
                        <div class="close-button" onclick="modalLogout(0)">
                            <span class="fa fa-close"></span>
                        </div>
                        <h4>Logout</h4>
                        <hr style="border: 2px solid #000066;">
                        <label>Are you sure to logout?</label>
                        <div>
                        </div>
                        <br>
                        <div class="popup-footer">
                            <button class="btn btn-default" onclick="modalLogout(0)">
                                <span class="fa fa-close"></span>
                                &nbsp; Cancel
                            </button>
                            <button class="btn btn-danger" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
                            <span class="fa fa-sign-out"></span>
                            Logout
                            </button>
                        </div>
                    </div>
                </div>



                <div class="notification-bar" id="notifBarId" >
                    <div class="header-notification">
                        <h4 align="center">Notification</h4>
                        <span class="fa fa-close close-button" onclick="notificationShow(0)"></span>
                        <hr style="margin-bottom:0px;">
                    </div>
                    @php $status=0; @endphp
                    @foreach(@$user->notifications as $notif)
                    @if($notif->status == 1)
                    @php $status+=1; @endphp
                    <a href="{{ @$notif->route }}" style="text-decoration: none; color:unset;">
                        <div class="notification-items">
                            {{ @$notif->content }}
                        </div>
                    </a>
                    @endif
                    @endforeach
                    <a href="/notification/" style="text-decoration: none; color:unset; position: absolute; bottom: 50px; width:100%;">
                        <div class="notification-items" style="font-weight: bold; text-align: center; font-size: 16px;">
                            View all notification
                        </div>
                    </a>
                </div>
                <div class="notification-button">
                    <div class="circle-button" onclick="notificationShow(1)">
                        @if($status > 0)
                            <span class="fa fa-bell" style="color:yellow"></span>
                        @else
                            <span class="fa fa-bell"></span>
                        @endif
                    </div>
                </div>
    </body>
</html>