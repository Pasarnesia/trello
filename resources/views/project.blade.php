@extends('home')
@section('extrajs')
    <script type="text/javascript" src="{{ asset('js/page/projects.js') }}"></script>
@endsection
@section('project-details')
    <div class="project-details">
        <b> {{ @$currentProject->name }} </b> 
        | {{ @$currentProject->createdBy->name }} 
        |
        | {{ @$currentProject->address }} <br/>
    </div>
@endsection
@section('container-full')
    @if(!empty(@$currentProject->listCard))
        @foreach (@$currentProject->listCard as $listItems)
        <div class="card-list">
            <div class="card-title">
                {{ $listItems->name }}
                <div class="card-setting-button" title="List Setting">
                    <span class="fa fa-circle"></span>
                    <span class="fa fa-circle"></span>
                    <span class="fa fa-circle"></span>
                </div>
            </div>
            @foreach (@$listItems->activityCard as $activityCardList)
                <div class="activity-card-list">
                    <div class="activity-card-title" title="Activity Card List">
                        {{ $activityCardList->name }}
                    </div>
                    <div class="activity-card-edit">
                        <span class="fa fa-pencil" style="float: right"></span>
                    </div>
                </div>
            @endforeach
            <div class="new-card">
                <span class="fa fa-plus"></span>
                Add New Card
            </div>
        </div>
        @endforeach
    @endif
    <div class="add-new-list">
        &nbsp;
        <span class="fa fa-plus"></span>
        &nbsp;
        Add a new list
    </div>
@endsection
@section('container-project')
    @foreach(@$projectList as $projectItem)
        <a href="/projects/{{ $projectItem->id }}" style="text-decoration: none">
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