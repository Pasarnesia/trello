@extends('home')

@section('extrajs')
    <script type="text/javascript" src="{{ asset('js/page/projects.js') }}"></script>
@endsection

@section('project-details')
    <div class="project-details">
        @if(!empty(@$currentProject->listCard))
            <b> {{ @$currentProject->name }} </b> 
            | {{ @$currentProject->createdBy->name }} 
            |
            | {{ @$currentProject->address }} <br/>
        @else
            <b>Projects</b>
        @endif
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
        <div>
            <div class="project-items" id="projectAddId" onclick="projectAddShow(1)">
                <span class="fa fa-plus"></span>&nbsp;&nbsp;Add new project
            </div>
        </div>
@endsection

@section('popup')
    <div class="popup-modal" id="addProject">
        <div class="popup-content">
            <div class="close-button" onclick="projectAddShow(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Add New Project</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <form method="POST" action="/projects">
                    {{ csrf_field() }}
                    <span>
                        PIC of this project, is <b> {{ @$user->name }} </b>
                    </span>
                    <br/>
                    <label>Project Name</label>
                    <input type="text" name="name" class="form-control" required/><br>
                    <label>Project Cost</label>
                    <input type="number" name="cost" class="form-control" required/><br>
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" required/><br>
                    <div class="popup-footer">
                        <button class="btn btn-primary" style="background: #000066">
                            <span class="fa fa-save"></span>
                            &nbsp; Save
                        </button>
                        <div class="btn btn-default" onclick="projectAddShow(0)">
                            <span class="fa fa-close"></span>
                            &nbsp; Cancel
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection