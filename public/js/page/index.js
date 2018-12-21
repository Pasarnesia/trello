$(document).ready(function(){
	// $('#notifButton').click(function(){
	// 	$('#notifBarId').fadeIn();
	// })
})

function notificationShow(val){
	(val == 1)?$('#notifBarId').fadeIn():$('#notifBarId').fadeOut();
}