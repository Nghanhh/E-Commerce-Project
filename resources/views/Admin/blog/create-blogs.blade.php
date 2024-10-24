@extends('Admin.layout.master')

@section('content')

<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Create Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/admin/bloglist')}}">Blog</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
</div>            
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
                @endif

                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label class="col-md-12">Title <span style="color: red;">(*)</span></label>
                        <div class="col-md-12">
                            <input name="title" type="text" class="form-control form-control-line" value="">
                        </div>
                        @error('title')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Image </label>
                        <div class="col-md-12">
                            <input name="image" type="file" class="form-control form-control-line" value="">
                        </div>
                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-12">Description </label>
                        <div class="col-md-12">
                            <textarea rows="5" class="form-control form-control-line" name="description"></textarea>
                        </div>
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Content </label>
                        <div class="col-md-12">
                            <textarea name="content" rows="5" class="form-control form-control-line" id="content"></textarea>
                        </div>
                        @error('content')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" style="background-color: #32CD32;color: white; border: none; padding: 10px 20px; margin-top: 10px; font-size: 15px; cursor: pointer;" >Create Blog</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

