   
@extends('admin.layout.index')

@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User {{ $user->name }}
                            <small>Sua</small>
                       
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         @if(count($errors) > 0)
                         <div class="alert alert-danger">
                             @foreach($errors->all() as $er)
                              {{ $er }}<br>
                             @endforeach
                         </div>     
                         
                        @endif

                        @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                         </div>   
                        @endif
                        <form action="admin/users/sua/{{ $user->id }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Ho Ten</label>
                                <input class="form-control" name="name" value="{{ $user->name }}" placeholder="Nhap ten nguoi dung" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" name="email" placeholder="Nhap dia chi email" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePassword" name="changePassword">
                                <label>Doi mat khau</label>
                                <input disabled="" type="password" class="form-control password" name="password" placeholder="Nhap password cua ban" />
                            </div>
                            <div class="form-group">
                                <label>Nhap lai mat khau</label>
                                <input disabled="" type="password" class="form-control password" name="passwordAgain" placeholder="Nhap lai password cua ban" />
                            </div>
                           
                            <div class="form-group">
                                <label>Phan quyen nguoi dung</label>
                                <label class="radio-inline"> 
                                    <input name="quyen" value="0"
                                    @if($user->quyen == 0)
                                    {{'checked'}} 
                                    @endif
                                    
                                     type="radio">Thuong
                                </label>
                                <label class="radio-inline">
                                    
                                    <input name="quyen" value="1" 
                                      @if($user->quyen == 1)
                                      {{'checked'}} 
                                      @endif
                                   
                                    type="radio">Admin
                                </label>
                                
                            </div>
                            <button type="submit" class="btn btn-default">Sua</button>
                            <button type="reset" class="btn btn-default">Lam moi</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#changePassword').change(function(){
           if($(this).is(':checked'))
           {
            $('.password').removeAttr('disabled');
           }
           else
           {
            $('.password').attr('disabled','');
           }
        });
    });
</script>
@endsection













