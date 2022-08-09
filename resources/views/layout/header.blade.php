<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ env('APP_NAME')  }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="/assets/css/themes/lite-purple.min.css" rel="stylesheet" />
    <link href="/assets/css/plugins/perfect-scrollbar.min.css" rel="stylesheet" />
</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large">
    <div class="main-header">
        <div class="logo">
            <img src="/assets/images/logo.png" alt="">
        </div>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="d-flex align-items-center">
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <i class="search-icon text-muted i-Magnifi-Glass1"></i>
            </div>
        </div>
        <div style="margin: auto"></div>
        <div class="header-part-right">
            <!-- User avatar dropdown -->
            <div class="dropdown">
                <div class="user col align-self-end">
                    <i class="nav-icon i-Lock-User text-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i> {{ Auth::user()->name }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

