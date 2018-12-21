@extends('chat')

@section('container-full')
<input type="hidden" id="currentProjectId" value="{{ $currentProject->id }}">
    <div class="container-fluid container-chat">
        <div class="chat-body">
        	<div class="container-fluid">
        		<div class="chat-feed-sender">
        			<span class="chat-sender">Sender</span>
        			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        			<span class="chat-time">Sender</span>
        		</div>
        	</div>
        	<div class="container-fluid">
        		<div class="chat-feed-receiver">
        			<span class="chat-sender">Sender</span>
        			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        			<span class="chat-time">Sender</span>
        		</div>
        	</div>
        	<div class="container-fluid">
        		<div class="chat-feed-sender">
        			<span class="chat-sender">Sender</span>
        			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        			<span class="chat-time">Sender</span>
        		</div>
        	</div>
        </div>
	    <div class="chat-box">
	    	<input type="text" name="chat-input" class="chat-input">
	    	<br>
	    	<button class="btn btn-default">Send</button>
	    </div>
    </div>
@endsection