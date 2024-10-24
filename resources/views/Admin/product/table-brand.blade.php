@extends('Admin.layout.master')

@section('content')

<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Brand</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Brand</li>
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($brand as $value){
                                        ?>
                                        <tr>
                                            <td>{{$value['id']}}</td>
                                            <td>{{$value['name']}}</td>
                                            <td><a href="{{ url('/admin/brand/delete/'.$value['id'])}}">detele</a></td>
                                        </tr>

                                        <?php
                                            }
                                        ?>
                                        @if(session('success'))
                                        <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check"></i> Notification!</h4>
                                        {{session('success')}}
                                        </div>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <a href="{{ url('/admin/brand/add') }}" style="background-color: #32CD32; color: white; border: none; padding: 10px 20px; font-size: 15px; cursor: pointer; text-decoration: none;">Add Country</a>
</div>

@endsection

