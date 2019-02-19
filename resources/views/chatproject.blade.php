@extends('chat')

@section('container-full')
<input type="hidden" id="currentProjectId" value="{{ $currentProject->id }}">
    <div class="container-fluid container-chat">
        <div class="chat-body">
			@foreach(@$currentProject->chat as $chatItems)
				<div class="container-fluid">
					@if($chatItems->user->id == $user_id)
						<div class="chat-feed-receiver">
							<span class="chat-sender" >
					@else
						<div class="chat-feed-sender">
							<span class="chat-sender" >
					@endif
								{{ $chatItems->user->name }}
							</span>
								{{ $chatItems->message }}
							<span class="chat-time">{{ $chatItems->created_at }}</span>
					</div>
				</div>
			@endforeach
        </div>
	    <div class="chat-box">
			<form action="/chats/{{ @$currentProject->id }}/send" method="post">
				{{ csrf_field() }}
				<input type="text" name="message" class="chat-input">
				<br>
				<div class="btn btn-default" onclick="window.location.reload()">
					<span class="fa fa-refresh"></span>
				</div>
				<button type="submit" class="btn btn-default">Send</button>
			</form>			
		</div>
    </div>
@endsection