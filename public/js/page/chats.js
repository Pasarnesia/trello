$(document).ready(function(){
    $('#chatIconId').attr('class', 'icon-items icon-active');
    getChat();
})

function getChat(){
    csrf_token = $("input[name='_token']").val();
    projectId = $('#currentProjectId').val();
    return $.ajax({
        data: {
            // _token: csrf_token,
        },
        type: 'GET',
        url: '/api/project/chat/get/',
        success: function(response){
        	console.log(response);
            // window.store = response.data;
            // $('#currentProjectTitle').text(window.store.name);
            // $('#currentProjectCreator').text(window.store.created_by.name);
            // $('#currentProjectCity').text(window.store.address);
            // var User = "";
            // i = 0;
            // window.store.user_project.forEach(function(element) {
            //     User = (i==0)?element.user.name:User + ", " + element.user.name;
            //     i++;
            // });
            // $('#currentProjectUser').text(User);
            // listItems(window.store.list_card);
        },
    });
}