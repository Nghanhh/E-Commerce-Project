@extends('Admin.layout.master')

@section('content')

<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Add Category</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin/category/list')}}">Category</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
</div>
               
<div class="container-fluid">
    <div class="form-group">
    
    <form action="" method="post">
    @csrf
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Notification</h4>
                {{session('success')}}
            </div>
        @endif
        <label>Name <span style="color: red;">(*)</span></label>
        <input type="text" class="form-control" rows="5" name="name"></textarea>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" style="background-color: #32CD32;color: white; border: none; padding: 10px 20px; margin-top: 10px; font-size: 15px; cursor: pointer;" >Add Category               </button>
    </form>
    </div>  
</div>

@endsection

