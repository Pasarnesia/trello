@extends('home')

@section('extrastyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('extrajs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
            <b onclick="projectUpdateShow(1, '{{ @$currentProject->name }}', '{{ @$currentProject->description }}', '{{ @$currentProject->cost }}', '{{ @$currentProject->address }}')" style="cursor: pointer;" >
                <span id="currentProjectTitle"></span>
                &nbsp;
                <span class="fa fa-pencil"></span>
            </b> 
            {{-- | <span id="currentProjectCreator"></span> --}}
            {{-- | 
                <div class="userProject" id="currentProjectUser">
                </div>
            | <span id="currentProjectCity"></span> --}}
            |
            <button class="btn btn-primary" style="padding: 2px 10px;" title="Add Member" onclick="addMemberModal(1)">
                <span class="fa fa-user-plus"></span>
            </button>
            <button class="btn btn-primary" style="padding: 2px 10px;" title="Add Member" onclick="listMemberModal(1)">
                <span class="fa fa-list"></span>
            </button>
            <button class="btn btn-danger" style="padding: 2px 10px;" title="Delete Project" onclick="modalDeleteProject(1)">
                <span class="fa fa-trash"></span>
            </button>

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
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea><br>
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
            <h4>Detail Project</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <label>Project Name</label>
                <input type="text" name="name" class="form-control" id="projectNameIdUpdate" /><br>
                <label>Project Description</label>
                <textarea type="text" name="desc" class="form-control" id="projectDescIdUpdate" ></textarea>
                <br>
                <label>Project Cost</label>
                <input type="number" name="cost" class="form-control" id="projectCostIdUpdate"/><br>
                <label>Address</label>
                <input type="text" name="address" class="form-control" id="projectAddressIdUpdate"/><br>
                <div class="popup-footer">
                    <button class="btn btn-primary" style="background: #000066" onclick="updateProject()">
                        <span class="fa fa-save"></span>
                        &nbsp; Update
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
                    <div id="transactionButton">
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
                <div class="popup-panel-title">
                    <span class="fa fa-paperclip"></span>
                    <label>Attachment</label><br/>
                    <div class="popup-panel-content">
                        <div style="display: flex;">
                            <!-- <img id="jajal_id" src="#"> -->
                            <div id="jajal_id"></div>
                            <div class="upload-image" id="upload_image1">
                                <div id="content_upload_1">
                                    <span class="fa fa-camera upload-button"></span>
                                    <br>
                                    Upload
                                </div>
                            </div>	
                            <div class="upload-image" id="upload_image2">
                                <div id="content_upload_2">
                                    <span class="fa fa-camera upload-button"></span>
                                    <br>
                                    Upload
                                </div>
                            </div>	
                            <div class="upload-image" id="upload_image3">
                                <div id="content_upload_3">
                                    <span class="fa fa-camera upload-button"></span>
                                    <br>
                                    Upload
                                </div>
                            </div>	
                        </div>
            
                        <input type='file' id="image1" name="image1" style="display: none;" />
                        <input type='file' id="image2" name="image2" style="display: none;" />
                        <input type='file' id="image3" name="image3" style="display: none;" />
                    </div>
                </div>
                <button class="btn btn-danger" id="deleteActivityCardId">
                    <span class="fa fa-trash"></span> Delete
                </button>
                <button class="btn btn-default" onclick="checklistViewShow(0)">
                    <span class="fa fa-close"></span> Close
                </button>
            </div>
        </div>

        <div class="popup-content" style="display: none; width:70% !important;" id="transactionContentId">
            <div class="close-button" onclick="viewTransaction(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Transaction List</h4>
            <hr style="border: 2px solid #000066;">
            <div class="popup-form">
                <label>Transaction Name</label>
                <input type="text" class="form-control" id="transactionName" placeholder="Transaction Name" disabled>
                <br/>
                <label>Transaction Lists</label>
                <div id="transactionListData">
                    <table class='table table-hover table-stripped'>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <tr id="transactionListRows"></tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="text" class="form-control" id="trans_name" placeholder="Name"></td>
                            <td><input type="text" class="form-control" id="trans_qty" placeholder="Quantity"></td>
                            <td><input type="text" class="form-control" id="trans_price" placeholder="Price"></td>
                            <td><button class='btn btn-primary' style="margin-right:2px;"><span class='fa fa-save'></span></button></td>
                        </tr>
                    </table>
                </div>
                <button class='btn btn-primary'>
                    <span class='fa fa-save'></span>&nbsp; Save
                </button>
                <button class='btn btn-default' onclick="viewTransaction(0)">
                    <span class='fa fa-close'></span>&nbsp; Cancel
                </button>
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

    <div class="popup-modal" id="modalAddMember">
        <div class="popup-content" >
        <form method="POST" action="/projects/{{ @$projectItem->id }}/user-project/">
        {{ csrf_field() }}
            <div class="close-button" onclick="addMemberModal(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Add Member to Project</h4>
            <hr style="border: 2px solid #000066;">
            <label>Find Member</label>
            <div>
                <select id="addMemberList" name="user_id">
                    <option value="0">---</option>
                    @if(isset($userList))
                    @foreach ($userList as $userItem)
                    <option value="{{ $userItem->id }}">{{ $userItem->name }} ({{ $userItem->email }})</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <br>
            <label>Assign Role</label>
            <div>
                <select id="addMemberListRole" name="role_id">
                    <option value="0">---</option>
                    @if(isset($roleList))
                    @foreach ($roleList as $items)
                    <option value="{{ $items->id }}">{{ $items->title }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <br>
            <div class="popup-footer">
                <button class="btn btn-primary" type="submit">
                    <span class="fa fa-envelope"></span>
                    &nbsp; Invite
                </button>
                <div class="btn btn-danger" onclick="addMemberModal(0)">
                    <span class="fa fa-close"></span>
                    &nbsp; Close
                </div>
            </div>
        </form>
        </div>
    </div>

    <div class="popup-modal" id="modalListMember">
        <div class="popup-content" >
            <div class="close-button" onclick="listMemberModal(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>List Member of Project</h4>
            <hr style="border: 2px solid #000066;">
            <div>
                <table class="table table-hover">
                    <tr>
                        <th>Member Name</th>
                        <th>Roles</th>
                    </tr>
                    <tr id="memberListRows"></tr>
                </table>
            </div>
        </div>
    </div>


    <div class="popup-modal" id="modalDeleteProject">
        <div class="popup-content" >
            <div class="close-button" onclick="modalDeleteProject(0)">
                <span class="fa fa-close"></span>
            </div>
            <h4>Delete Project</h4>
            <hr style="border: 2px solid #000066;">
            <label>Are you sure to delete this project?</label>
            <div>
            </div>
            <br>
            <div class="popup-footer">
                <a href="#" class="btn btn-default" onclick="modalDeleteProject(0)">
                    <span class="fa fa-close"></span>
                    &nbsp; Cancel
                </a>
                <button class="btn btn-danger" onclick="deleteProject({{ @$projectItem->id }})">
                    <span class="fa fa-trash"></span>
                    Delete
                </button>
            </div>
        </div>
    </div>

@endsection