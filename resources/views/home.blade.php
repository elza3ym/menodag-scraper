@extends('layout.master')

@section('content')
    <div class="breadcrumb">
        <h1 class="mr-2">Dashboard</h1>
        <ul>
            <li><a href="">Home</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <!-- ICON BG-->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center"><i class="i-Add-User"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Data</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $dataCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center"><i class="i-Folder-Open"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Sessions</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $sessionCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center"><i class="i-Clock"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Time</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $sessionsTime }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center"><i class="i-Gear"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Status</p>
                      <p class="text-primary text-24 line-height-1 mb-2">{{ $isRunning ? 'Running' : 'Stopped' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of main-content -->
@endsection
