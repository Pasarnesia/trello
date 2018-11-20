@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-transform: uppercase">
                    {{ $projectList->name }}
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br/>
                        {{ $projectList->listCard }}
                    <div class="col-md-4" style="padding:5px;">
                        <div></div>
                    </div>
                </div>
                <form method="POST">
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
