$(document).ready(function(){
    $('#projectIconId').attr('class', 'icon-items icon-active');
})

function projectAddShow(val)
{
    if(val == 0){
        $('#addProject').hide();
    }
    else{
        $('#addProject').show();
    }
}