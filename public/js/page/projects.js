$(document).ready(function(){

    $('#projectIconId').attr('class', 'icon-items icon-active');

// content title
    $('#contentTitleId').click(function(){
        $('#addActivityTitle').attr('disabled', false);
        $('#addActivityTitle').focus();
    });
    $('#addActivityTitle').keyup(function(e) {
        dataText = $('#addActivityTitle').val();
        $('#activityCardId').text(dataText);
        if(e.which == 13) {
            $('#addActivityTitle').attr('disabled', true);
            updateDescriptions($('#activityCardDataId').val(), $('#addActivityTitle').val(), 'name');
            getProject();
        }
    });
    $('#addActivityTitle').blur(function() {
        $('#addActivityTitle').attr('disabled', true);
        updateDescriptions($('#activityCardDataId').val(), $('#addActivityTitle').val(), 'name');
        getProject();
    });

// content descriptions
    $('#contentDescriptionId').click(function(){
        $('#addActivityDescription').attr('disabled', false);
        $('#addActivityDescription').focus();
    })
    $('#addActivityDescription').keypress(function(e) {
        if(e.which == 13) {
            $('#addActivityDescription').attr('disabled', true);
            updateDescriptions($('#activityCardDataId').val(), $('#addActivityDescription').val(), 'description');
        }
    });
    $('#addActivityDescription').blur(function() {
        $('#addActivityDescription').attr('disabled', true);
        updateDescriptions($('#activityCardDataId').val(), $('#addActivityDescription').val(), 'description');
    });

// content due date
    $('#contentDueDateId').click(function(){
        $('#addActivityDueDate').attr('disabled', false);
        $('#addActivityDueDate').focus();
    })
    $('#addActivityDueDate').keypress(function(e) {
        if(e.which == 13) {
            $('#addActivityDueDate').attr('disabled', true);
            updateDescriptions($('#activityCardDataId').val(), $('#addActivityDueDate').val(), 'due_date');
        }
    });
    $('#addActivityDueDate').blur(function() {
        $('#addActivityDueDate').attr('disabled', true);
        updateDescriptions($('#activityCardDataId').val(), $('#addActivityDueDate').val(), 'due_date');
    });

// list title update
    $('#contentTitleUpdateId').click(function(){
        $('#listTitleUpdateId').attr('disabled', false);
        $('#listTitleUpdateId').focus();
    })
    $('#listTitleUpdateId').keypress(function(e) {
        if(e.which == 13) {
            $('#listTitleUpdateId').attr('disabled', true);
            updateTitle($('#activityCardDataId').val(), $('#listTitleUpdateId').val(), 'due_date');
        }
    });
    $('#listTitleUpdateId').blur(function() {
        $('#listTitleUpdateId').attr('disabled', true);
        updateTitle($('#listUpdateId').val(), $('#listTitleUpdateId').val(), 'due_date');
    });

// delete list
    $('#deleteListModal').click(function(){
        deleteList($('#listUpdateId').val());
    })

// delete activity
    $('#deleteActivityCardId').click(function(){
        deleteActivity($('#activityCardDataId').val());
    })

// list name
    $('#addMemberList').select2({ width: 'resolve' });

})

function projectAddShow(val)
{
    (val == 0)?$('#addProject').hide():$('#addProject').show();
}

function addMemberModal(val)
{
    (val == 0)?$('#modalAddMember').hide():$('#modalAddMember').show();
}

function projectUpdateShow(val, name, cost, address)
{
    (val == 0)?$('#updateProject').hide():$('#updateProject').show();
    $('#projectNameIdUpdate').val(name);
    $('#projectCostIdUpdate').val(cost);
    $('#projectAddressIdUpdate').val(address);
}

function detailListModal(val, data)
{
    (val == 0) ? $('#listDetailModalId').hide() : $('#listDetailModalId').show();
    getList(data, 'detailListModal');
}


function listAddShow(val)
{
    (val == 0)?$('#addList').hide():$('#addList').show();
}

function cardAddShow(val, listId)
{
    (val == 0)?$('#addCard').hide():$('#addCard').show();
    $('#listCardId').val(listId);
}

function checklistViewShow(val, data)
{
    (val == 0)?$('#checklistView').hide():$('#checklistView').show();
    getActivity(data, 'checklistViewShow');
}

function addCheckList(val)
{
    (val == 0)?$('#addCheckList').hide():$('#addCheckList').show();
}

function getList(listId, type){
    csrf_token = $("input[name='_token']").val();
    return $.ajax({
        data: {
            _token: csrf_token,
            listId : listId,
        },
        type: 'POST',
        url: '/api/project/list/',
        success: function(response) {
            if(type == 'detailListModal'){
                $('#listTitleUpdateId').val(response.name);
                $('#listUpdateId').val(response.id);
            }
        },
    });
}

function getProject(){
    csrf_token = $("input[name='_token']").val();
    projectId = $('#currentProjectId').val();
    return $.ajax({
        data: {
            _token: csrf_token,
        },
        type: 'GET',
        url: '/api/project/'+projectId,
        success: function(response) {
            window.store = response.data;
            $('#currentProjectTitle').text(window.store.name);
            $('#currentProjectCreator').text(window.store.created_by.name);
            $('#currentProjectCity').text(window.store.address);
            var User = "";
            window.store.user_project.forEach(function(element) {
                User = User + '<span class="btn btn-warning userProjectBundle" title="'+element.user.name+'">'+element.user.name.substr(0,1)+"</span>";
            });
            $('#currentProjectUser').html(User);
            listItems(window.store.list_card);
        },
    });
}

function updateProject(){
    csrf_token = $("input[name='_token']").val();
    projectId = $('#currentProjectId').val();
    name = $('#projectNameIdUpdate').val();
    cost = $('#projectCostIdUpdate').val();
    address = $('#projectAddressIdUpdate').val();
    return $.ajax({
        data: {
            _token: csrf_token,
            name: name,
            cost: cost,
            address: address,
        },
        type: 'PUT',
        url: '/api/project/'+projectId+'/update/',
        success: function(response) {
           if(response.status == 'success'){
            // projectUpdateShow(0);
            // getProject();
            window.location.reload();
           }
        },
    });
}

function getActivity(activityId, type){
    csrf_token = $("input[name='_token']").val();
    return $.ajax({
        data: {
        _token: csrf_token,
        activityId : activityId,
        },
        type: 'POST',
        url: '/api/project/activity/',
        success: function(response) {
            if(type == 'checklistViewShow'){
                $('#activityCardId').text(response.name);
                $('#addActivityTitle').val(response.name);
                $('#addActivityDescription').val(response.description);
                $('#addActivityDueDate').val(response.due_date);
                $('#activityCardDataId').val(response.id);
            }
        },
    });
}

function viewTransaction(val)
{
    if (val == 1){
        $('#transactionContentId').show()
        $('#checklistContentId').hide()
    }
    else{
        $('#transactionContentId').hide()
        $('#checklistContentId').show()
    }
}

function updateDescriptions(activityId, value, type){
    csrf_token = $("input[name='_token']").val();
    return $.ajax({
      data: {
        _token: csrf_token,
        activityId : activityId,
        value : value,
        type : type,
      }, // get the form data
      type: 'POST', // GET or POST
      url: '/api/project/activity/description/', // the file to call
      success: function(response) {
          console.log(response);
      },
    });
  }

  function updateTitle(listId, value){
    csrf_token = $("input[name='_token']").val();
    return $.ajax({
      data: {
        _token: csrf_token,
        name : value,
      },
      type: 'PUT',
      url: '/api/project/list/'+listId+'/update/',
      success: function(response) {
        //   window.location.reload();
        getProject();
      },
    });
  }

  function deleteList(listId){
    csrf_token = $("input[name='_token']").val();
    return $.ajax({
      data: {
        _token: csrf_token,
      },
      type: 'DELETE',
      url: '/api/project/list/'+listId+'/delete/',
      success: function(response) {
          getProject();
          detailListModal(0);
      },
    });
  }

  function deleteActivity(activityId){
    csrf_token = $("input[name='_token']").val();
    return $.ajax({
      data: {
        _token: csrf_token,
      },
      type: 'DELETE',
      url: '/api/project/activity/'+activityId+'/delete/',
      success: function(response) {
        getProject();
        checklistViewShow(0);
      },
    });
  }


function listItems(list){
    htmlData = '<div class="add-new-list" onclick="listAddShow(1)">&nbsp;<span class="fa fa-plus"></span>&nbsp;Add a new list</div>';
    list.forEach(function(data){
        htmlData = htmlData + '<div class="card-list"><div onclick="detailListModal(1, '+data.id+')" class="card-title" style="cursor:pointer;">'+data.name+'<div class="card-setting-button" title="List Setting"><div style="cursor:pointer;"><span class="fa fa-circle"></span><span class="fa fa-circle"></span><span class="fa fa-circle"></span></div></div></div>';
        data.activity_card.forEach(function(activity){
             htmlData = htmlData + "<div class='activity-card-list' onclick='checklistViewShow(1, "+activity.id+")'><div class='activity-card-title' title='Activity Card List'>"+activity.name+"</div><div class='activity-card-edit'><span class='fa fa-pencil' style='float: right'></span></div></div>";
        })

        htmlData = htmlData + '<div class="new-card" onclick="cardAddShow(1, '+data.id+')"><span class="fa fa-plus"></span>&nbsp;Add New Card</div></div>';
    });

    $('#cardListId').html(htmlData);
}