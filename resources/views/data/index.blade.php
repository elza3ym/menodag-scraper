@extends('layout.master')

@section('content')
    <div class="breadcrumb">
        <h1 class="mr-2">Dashboard</h1>
        <ul>
            <li><a href="">Data</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    @if($data->count())
                    <div class="table-responsive">
                        <table class="display table table-striped table-bordered" id="feature_disable_table" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Source</th>
                                <th>Spam</th>
                                <th>Verified</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $datum)
                            <tr>
                                <td>{{ $datum->name }}</td>
                                <td>{{ $datum->phone }}</td>
                                <td>{{ $datum->source }}</td>
                                <td>{!! $datum->spam ? '<i class="i-Like text-danger"></i>' : '<i class="i-Unlike text-success"></i>' !!}</td>
                                <td>{!! $datum->verified ? '<i class="i-Like text-success"></i>' : '<i class="i-Unlike text-danger"></i>' !!}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        {!! $data->links('layout.pagination') !!}
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
