@extends('admin.layout.index')
 @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">The Loai
                            <small>{{ $theloai->Ten }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    	@if(count($errors) >0)
                         <div class="alert alert-danger">
                         	@foreach($errors->all() as $er)
                                 {{ $er }}
                         	@endforeach
                         </div>
                    	@endif
                    	@if(session('thongbao'))
                    	 <div class="alert alert-success">
                    	   {{ session('thongbao') }}	
                    	 </div>
                    	@endif
                        <form action="admin/theloai/sua/{{ $theloai->id }}" method="POST">
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Ten the loai</label>
                                <input class="form-control" name="Ten" placeholder="Please Enter Category Name" value="{{ $theloai->Ten }}" />
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
       