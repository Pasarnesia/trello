@extends('home')

@section('extrajs')
    <script type="text/javascript" src="{{ asset('js/page/projects.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            getProject();
        });
        
        // function getProjectData(){
        //     window.store = JSON.parse(@json(@$projectArray));
        //     $('#currentProjectTitle').text(window.store.name);
        //     $('#currentProjectCreator').text(window.store.created_by.name);
        //     $('#currentProjectCity').text(window.store.address);
        //     var User = "";
        //     i = 0;
        //     window.store.user_project.forEach(function(element) {
        //         User = (i==0)?element.user.name:User + ", " + element.user.name;
        //         i++;
        //     });
        //     $('#currentProjectUser').text(User);
        //     listItems(window.store.list_card);
        // }
    </script>

@endsection

@section('project-details')
<input type="hidden" id="currentProjectId" value="{{ @$currentProject->id }}"/>
    <div class="project-details">
        @if(!empty(@$currentProject->listCard))
            <b onclick="projectUpdateShow(1, '{{ @$currentProject->name }}', '{{ @$currentProject->cost }}', '{{ @$currentProject->address }}')" style="cursor: pointer;" >
                <span id="currentProjectTitle"></span>
                &nbsp;
                <span class="fa fa-pencil"></span>
            </b> 
            | <span id="currentProjectCreator"></span>
            | <span id="currentProjectUser"></span>
            | <span id="currentProjectCity"></span>
            <br/>
        @else
            <b>Projects</b>
            <div class="container-fluid" style="margin-top: 20px;">
              @foreach($projectList as $projectItems)
              <div class="col-md-3" style="margin-bottom:35px;">
                <a href="/projects/{{ $projectItems->id }}">
                <div class="btn btn-info btn-block" style="
                  height: 90px;
                  font-size: 16px;
                  overflow: hidden;
                  text-overflow: ellipsis;
                  white-space: nowrap;
                  text-align: left;
                  background-image: linear-gradient(to right, #000066, #03183b);
                ">
                  <span style="font-weight: bold; text-transform: uppercase;">{{ $projectItems->name }}</span>
                </div>
                </a>
              </div>
              @endforeach
            </div>
        @endif
    </div>
@endsection

@section('container-full')
    <div id="cardListId">
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

<!-- update project details -->
    <div class="popup-modal" id="updateProject">
        <div class="popup-content">
            <div class="close-button" onclick="projectUpdateShow(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Update Project</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <label>Project Name</label>
                <input type="text" name="name" class="form-control" id="projectNameIdUpdate" /><br>
                <label>Project Cost</label>
                <input type="number" name="cost" class="form-control" id="projectCostIdUpdate"/><br>
                <label>Address</label>
                <input type="text" name="address" class="form-control" id="projectAddressIdUpdate"/><br>
                <div class="popup-footer">
                    <button class="btn btn-primary" style="background: #000066" onclick="updateProject()">
                        <span class="fa fa-save"></span>
                        &nbsp; Save
                    </button>
                    <div class="btn btn-default" onclick="projectUpdateShow(0)">
                        <span class="fa fa-close"></span>
                        &nbsp; Cancel
                    </div>
                </div>
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
                    <span class="fa fa-info"></span>
                    <label>Title</label><br/>
                    <div class="popup-panel-content" id="contentTitleId">
                        <input class="form-control form-update" disabled id="addActivityTitle"/>
                    </div>
                </div>
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
                        <button class="btn btn-default" onclick="addCheckList(1)">
                            <span class="fa fa-plus"></span>
                            Add Checklist
                        </button>
                    </div>
                </div>
                <button class="btn btn-danger" id="deleteActivityCardId">
                    <span class="fa fa-trash"></span> Delete
                </button>
                <button class="btn btn-default" onclick="checklistViewShow(0)">
                    <span class="fa fa-trash"></span> Close
                </button>
            </div>
        </div>

        <div class="popup-content" style="display: none;" id="transactionContentId">
            <div class="close-button" onclick="viewTransaction(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Transaction List</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                adadasdasdasd
            </div>
        </div>

        <div class="popup-content-children" style="display:none;" id="addCheckList">
            <div class="close-button" onclick="addCheckList(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Add Checklist</h4>
            <hr style="margin: 0px;">
            <div class="popup-form">
                <label>Checklist Name</label>
                <input type="text" class="form-control" id="addNewChecklistName" style="margin: ">
                <button class="btn btn-default"><span class="fa fa-plus"></span> Add</button>
            </div>
        </div>

    </div>

    <div class="popup-modal" id="listDetailModalId">
        <div class="popup-content" >
            <div class="close-button" onclick="detailListModal(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>List Details</h4>
            <hr style="border: 2px solid #000066;">
            <label>List Name</label>
            <div id="contentTitleUpdateId">
                <input type="hidden" id="listUpdateId"/>
                <input type="text" id="listTitleUpdateId" class="form-control" disabled style="cursor:text;"/>
            </div>
            <br>
            <div class="popup-footer">
                <div class="btn btn-danger" id="deleteListModal">
                    <span class="fa fa-trash"></span>
                    &nbsp; Delete
                </div>
                <div class="btn btn-default" onclick="detailListModal(0)">
                    <span class="fa fa-close"></span>
                    &nbsp; Cancel
                </div>
            </div>
        </div>
    </div>
@endsection