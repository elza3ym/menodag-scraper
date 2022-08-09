@extends('layout.master')

@section('content')
    <div class="breadcrumb">
        <h1 class="mr-2">Dashboard</h1>
        <ul>
            <li><a href="">Scrapper</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="avatar mb-3 text-40"><i class="i-Robot"></i></div>
                    <h5 class="m-0">Scraper Status</h5>
                    <p class="mt-0">{{ $isRunning ? "Running" : "Stopped" }}</p>
                    <form action="{{ $isRunning ? route('session.stop', \App\Models\Session::getRunning()->id) : route('session.start')  }}" method="POST" >
                        @csrf
                        @if ($isRunning)
                            @method('PUT')
                        @endif
                        <button type="submit" class="btn btn-{{ $isRunning ? "danger" : "primary" }} btn-rounded">{{ $isRunning ? "Stop Scraper" : "Start Scraper" }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    @if($sessions->count())
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="feature_disable_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Pattern</th>
                                    <th>Running ?</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Data Collected</th>
                                    <th>Time Taken</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sessions as $session)
                                    <tr>
                                        <td>{{ $session->pattern }}</td>
                                        <td>{{ $session->is_running ? "Yes": "No" }}</td>
                                        <td>{{ $session->start }}</td>
                                        <td>{{ $session->end }}</td>
                                        <td>{{ $session->data()->count() }}</td>
                                        <td>{{ \Carbon\CarbonInterval::seconds( $session->time )->cascade()->forHumans(null, true)  }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $sessions->links('layout.pagination') !!}
                    @else
                        <div class="card-header font-weight-bold">
                            There's No Data At the moment, Please Start The Scrapper.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end of main-content -->
@endsection
