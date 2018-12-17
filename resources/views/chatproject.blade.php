@extends('chat')

@section('container-full')
    <div class="container-fluid container-chat">
        <div class="chat-body">
        	
        </div>
	    <div class="chat-box">
	    	<input type="text" name="chat-input" class="chat-input">
	    	<br>
	    	<button class="btn btn-default" style="float: right;">Send</button>
	    </div>
    </div>
@endsection