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
                    <form method="post" action="{{ route('session.start') }}">
                        <div class="form-group row mt-3">
                            @csrf
                            <label class="col-sm-2 col-form-label" for="inputEmail3">Scraper Pattern</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="pattern" placeholder="Pattern EX: 9*******">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary btn-rounded">New Scraper</button>
                            </div>
                        </div>
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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($sessions as $session)
                                    <tr>
                                        <td>{{ $session->pattern }}</td>
                                        <td>{{ $session->is_running ? "Yes": "No" }}</td>
                                        <td>{{ $session->start }}</td>
                                        <td>{{ $session->end }}</td>
                                        <td>
                                            <button class="btn btn-success btn-block" type="button" data-toggle="popover"  data-trigger="focus" data-session-id="{{ $session->id }}" title="Collected Data">
                                                <i class="i-Eye"></i>
                                            </button>
                                        </td>
                                        <td>{{ \Carbon\CarbonInterval::seconds( $session->time )->cascade()->forHumans(null, true)  }}</td>
                                        <td>
                                            @if ($session->is_running)
                                            <form action="{{ route('session.stop', $session->id) }}" method="POST" >
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger btn-rounded">Stop Scraper</button>
                                            </form>
                                            @endif
                                        </td>
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
@section('scripts')
    <script>
        $("[data-toggle=popover]").on('click', function () {
            let sessionId = $(this).data('sessionId');
            $.ajax({
                url: '{{ route('session.start') }}' + '/' + sessionId + '/count',
                method: 'get',
                success: function (data) {
                    $("[data-toggle=popover][data-session-id="+sessionId+"]").popover({
                        content: data
                    }).popover('show')
                }
            })
        });
    </script>
@endsection
