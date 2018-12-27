$(document).ready(function(){
})

function notificationShow(val){
	(val == 1)?$('#notifBarId').fadeIn():$('#notifBarId').fadeOut();
}

function modalLogout(val){
	(val == 1)?$('#modalLogout').show():$('#modalLogout').hide();
}