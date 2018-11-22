@extends('index')
@section('extrajs')
<script type="text/javascript" src="{{ asset('js/page/chats.js') }}"></script>
@endsection
@section('container-project')
    @foreach(@$projectList as $projectItem)
        <a href="/chats/{{ $projectItem->id }}" style="text-decoration: none">
            @if(@$currentProject->id == $projectItem->id)
            <div class="project-items" style="background:#00003b;">
                <span class="fa fa-circle"></span>&nbsp;&nbsp;{{ $projectItem->name }}
            </div>
            @else
            <div class="project-items">
                <span class="fa fa-circle"></span>&nbsp;&nbsp;{{ $projectItem->name }}
            </div>
            @endif
        </a>
    @endforeach
@endsection