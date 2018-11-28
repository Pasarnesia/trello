@extends('index')
@section('extrajs')
    <script type="text/javascript" src="{{ asset('js/page/home.js') }}"></script>
    <script>
        $(document).ready(function(){
           $.ajax({
              type:'GET',
              url:'/api/project/',
            //   data:'_token = <?php echo csrf_token() ?>',
              success:function(data){
                console.log(data);
              }
           });
        })
     </script>
@endsection
@section('container-project')
    <a href="/home/" style="text-decoration: none">
        <div class="project-items" style="background:#00003b;">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Your Projects
        </div>
    </a>
    <a href="/home/" style="text-decoration: none">
        <div class="project-items">
            <span class="fa fa-circle"></span>&nbsp;&nbsp; Your Teams
        </div>
    </a>
@endsection

@section('container-full')
    asdsdasdas
@endsection