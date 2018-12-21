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
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
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
                <div class="notification-button">
                    <div class="circle-button" onclick="notificationShow(1)">
                        <span class="fa fa-bell"></span>
                    </div>
                </div>
                <div class="notification-bar" id="notifBarId">
                    <div class="header-notification">
                        <h4 align="center">Notification</h4>
                        <span class="fa fa-close close-button" onclick="notificationShow(0)"></span>
                        <hr>
                    </div>
                </div>
    </body>
</html>