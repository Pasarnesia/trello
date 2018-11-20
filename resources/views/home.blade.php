@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Your Projects</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($projectList as $projectItem)
                        <div class="col-md-3" style="padding:5px;">
                            <a href="/projects/{{ $projectItem->id }}/" style="text-decoration: none;">
                            <div style="border:1px solid #dadade; min-height: 50px; border-radius: 10px; padding: 10px; text-align: center; text-decoration: none;">
                                <span style="text-transform: uppercase; text-decoration: none; font-weight: bold; color: black; font-size: 16px;">{{ $projectItem->name }}</span>
                                <br/>
                                <span style="text-transform: uppercase; text-decoration: none; color: black; font-size: 10px;">{{ $projectItem->createdBy->name }}</span>
                            </div>
                            </a>
                        </div>
                    @endforeach
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
