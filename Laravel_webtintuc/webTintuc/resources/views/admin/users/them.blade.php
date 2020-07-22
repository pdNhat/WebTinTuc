   
@extends('admin.layout.index')

@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Users
                            <small>Them</small>
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
                        <form action="admin/users/them" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Ho Ten</label>
                                <input class="form-control" name="name" placeholder="Nhap ten nguoi dung" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhap dia chi email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhap password cua ban" />
                            </div>
                            <div class="form-group">
                                <label>Nhap lai password</label>
                                <input type="password" class="form-control" name="passwordAgain" placeholder="Nhap lai password cua ban" />
                            </div>
                           
                            <div class="form-group">
                                <label>Phan quyen nguoi dung</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio">Thuong
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" checked="" type="radio">Admin
                                </label>
                                
                            </div>
                            <button type="submit" class="btn btn-default">Them</button>
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