@extends('index')
@section('extrajs')
<script type="text/javascript" src="{{ asset('js/page/settings.js') }}"></script>
@endsection
@section('container-project')
    <a href="/settings/" style="text-decoration: none">
        <div class="project-items">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; User Settings
        </div>
    </a>
    <a href="#" style="text-decoration: none">
        <div class="project-items" style="background:#00003b;">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Reset Password
        </div>
    </a>
    <a href="/workspace/" style="text-decoration: none">
        <div class="project-items">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Workspace Setting
        </div>
    </a>
    <a href="/helps/" style="text-decoration: none">
        <div class="project-items">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Helps
        </div>
    </a>
    <a href="/feedback/" style="text-decoration: none">
        <div class="project-items">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Feedbacks
        </div>
    </a>
@endsection

@section('container-full')
    <div>
        <form>
            <div class="user-settings">
                <label>Old Password</label>
                <input type="password" name="oldpass" class="form-control">
                <label>New Password</label>
                <input type="password" name="pass1" class="form-control" >
                <label>Confirm New Password</label>
                <input type="password" name="pass2" class="form-control" >
                <br>
                <button class="btn btn-primary">
                    <span class="fa fa-save"></span>
                    Change Password
                </button>
            </div>
        </form>
    </div>
@endsection

@section('project-details')
    <div class="project-details">
        <b>Change Password</b>
    </div>
@endsection