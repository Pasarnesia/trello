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
                <div class="activity-card-list" onclick="checklistViewShow(1, '{{ @$activityCardList->id }}', '{{ @$activityCardList->name }}', '{{ @$activityCardList->description }}', '{{ @$activityCardList->due_date }}')">
                    <div class="activity-card-title" title="Activity Card List">
                        {{ $activityCardList->name }}
                    </div>
                    <div class="activity-card-edit">
                        <span class="fa fa-pencil" style="float: right"></span>
                    </div>
                </div>
            @endforeach
            <div class="new-card" onclick="cardAddShow(1, '{{ $listItems->id }}')">
                <span class="fa fa-plus"></span>
                Add New Card
            </div>
        </div>
        @endforeach
    @endif
    <div class="add-new-list" onclick="listAddShow(1)">
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

    <div class="popup-modal" id="addList">
        <div class="popup-content">
            <div class="close-button" onclick="listAddShow(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Add New List</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <form method="POST" action="/lists">
                    {{ csrf_field() }}
                    <label>List Name</label>
                    <input type="text" name="name" class="form-control" required/><br>
                    <input type="hidden" name="project_id" class="form-control" value="{{ @$currentProject->id }}"/><br>
                    <div class="popup-footer">
                        <button class="btn btn-primary" style="background: #000066">
                            <span class="fa fa-save"></span>
                            &nbsp; Save
                        </button>
                        <div class="btn btn-default" onclick="listAddShow(0)">
                            <span class="fa fa-close"></span>
                            &nbsp; Cancel
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="popup-modal" id="addCard">
        <div class="popup-content">
            <div class="close-button" onclick="cardAddShow(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Add New Activity Card</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <form method="POST" action="/cards">
                    {{ csrf_field() }}
                    <label>Activity Card Name</label>
                    <input type="text" name="name" class="form-control" required/><br>
                    <input type="hidden" name="list_id" class="form-control" id="listCardId"/><br>
                    <div class="popup-footer">
                        <button class="btn btn-primary" style="background: #000066">
                            <span class="fa fa-save"></span>
                            &nbsp; Save
                        </button>
                        <div class="btn btn-default" onclick="cardAddShow(0)">
                            <span class="fa fa-close"></span>
                            &nbsp; Cancel
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="popup-modal" id="checklistView" style="overflow-y: auto; ">
        <div class="popup-content" style="margin-bottom: 20%;" id="checklistContentId">
            <div class="close-button" onclick="checklistViewShow(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4 id="activityCardId"></h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <input type="hidden" id="activityCardDataId">
                <div class="popup-panel-title">
                    <span class="fa fa-bars"></span>
                    <label>Description</label><br/>
                    <div class="popup-panel-content" id="contentDescriptionId">
                        <input class="form-control form-update" placeholder="Add descriptions here" disabled id="addActivityDescription"/>
                    </div>
                </div>
                <div class="popup-panel-title">
                    <span class="fa fa-clock-o"></span>
                    <label>Due Date</label><br/>
                    <div class="popup-panel-content" id="contentDueDateId">
                        <input type="date" class="form-control form-update" disabled id="addActivityDueDate"/>
                    </div>
                </div>
                <div class="popup-panel-title">
                    <span class="fa fa-random"></span>
                    <label>Transactions</label><br/>
                    <div class="popup-panel-content" onclick="viewTransaction(1)">
                        <button class="btn btn-default">
                            <span class="fa fa-eye"></span>
                            View Transaction
                        </button>
                    </div>
                </div>
                <div class="popup-panel-title">
                    <span class="fa fa-check-square"></span>
                    <label>Checklist</label><br/>
                    <div class="popup-panel-content">
                        <button class="btn btn-default">
                            <span class="fa fa-plus"></span>
                            Add Checklist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup-content" style="margin-bottom: 20%; display:none;" id="transactionContentId">
            <div class="close-button" onclick="viewTransaction(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Transaction List</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                adadasdasdasd
            </div>
        </div>

    </div>
@endsection