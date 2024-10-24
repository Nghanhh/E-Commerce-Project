@extends('Admin.layout.master')

@section('content')

<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
</div>
               
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                <!-- -------------------------------------------------------------- -->
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($blog as $value){
                                        ?>
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->title}}</td>
                                            <td>{{$value->image}}</td>
                                            <td>{{$value->description}}</td>
                                            <td>
                                            <a href="{{ url('/admin/editblog/'.$value->id)}}"><i class="mdi mdi-pencil"></i> Edit</a><br>
                                            <a href="{{ url('/admin/deleteblog/'.$value->id)}}"><i class="mdi mdi-delete"></i> Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                        } 

                                        ?>
                                
                                        @if(session('success'))
                                        <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check"></i>Notification</h4>
                                        {{session('success')}}
                                        </div>
                                        @endif

                                    </tbody>
                                </table>
                                
                                {{ $blog->links('pagination::bootstrap-4') }}
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <a href="{{ url('/admin/createblog') }}" style="background-color: #32CD32; color: white; border: none; padding: 10px 20px; font-size: 15px; cursor: pointer; text-decoration: none;">Add blog</a>
</div>

@endsection

