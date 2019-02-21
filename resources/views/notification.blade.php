@extends('index')
@section('extrajs')
    <script type="text/javascript" src="{{ asset('js/page/home.js') }}"></script>
    <script>
        $(document).ready(function(){
           $.ajax({
              type:'GET',
              url:'/api/project/',
              success:function(data){
                console.log(data);
              }
           });
        })
     </script>
@endsection
@section('container-project')
    <a href="/home/" style="text-decoration: none">
        <div class="project-items">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Your Projects
        </div>
    </a>
    <a href="/team/" style="text-decoration: none">
        <div class="project-items" >
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Your Teams
        </div>
    </a>
    <a href="/invitation/" style="text-decoration: none">
      <div class="project-items" >
          <span class="fa fa-circle"></span>&nbsp;&nbsp; Project Invitations
      </div>
    </a>
    <a href="#" style="text-decoration: none">
      <div class="project-items" style="background:#00003b;">
          <span class="fa fa-circle"></span>&nbsp;&nbsp; Notifications
      </div>
    </a>
@endsection

@section('project-details')
  <div class="project-details">
    <h4>
      <span class="fa fa-info"></span>
      Notification
    </h4>
  </div>
@endsection

@section('container-full')
    <div class="container-fluid">
      <table class="table table-hover table-bordered" style="background:#f7f7f7; width:80%;">
        <tr>
          <th>Content</th>
          <th>Date and Time</th>
          <th>Action</th>
        </tr>
        @foreach(@$user->notifications as $notif)
        @if($notif->status == 1)
          <tr>
            <td>
                <a href="{{ @$notif->route }}">
                    {{ @$notif->content }}
                </a>
            </td>
            <td>
                {{ @$notif->created_at }}
            </td>
            <td>
              <form method="post" action="/notification/delete">
                {{ csrf_field() }}
                <input type="hidden" name="notif_id" value="{{ @$notif->id }}"/>
                <button class="btn btn-danger" type="submit">
                    <span class="fa fa-trash"></span>
                </button>
              </form>
            </td>
          </tr>
        @endif
        @endforeach
      </table>
    </div>
@endsection