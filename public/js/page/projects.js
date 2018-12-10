$(document).ready(function(){
    $('#projectIconId').attr('class', 'icon-items icon-active');

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

})

function projectAddShow(val)
{
    (val == 0)?$('#addProject').hide():$('#addProject').show();
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

function checklistViewShow(val, id_, title, description, duedate)
{
    (val == 0)?$('#checklistView').hide():$('#checklistView').show();
    $('#activityCardId').text(title);
    $('#addActivityDescription').val(description);
    $('#addActivityDueDate').val(duedate);
    $('#activityCardDataId').val(id_);
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