@extends('layouts.admin')

@section('content')
    @isset($id)

        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2">


                        <h3 class="content-header-title" style="font-family:'Cairo', sans-serif"> صور منتج
                            {{\App\Models\Products::find($id)->name}} </h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a
                                            href="{{route('admin.dashboard')}}">الرئيسية</a>
                                    </li>
                                    <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a
                                            href="{{route('admin.maincategories')}}">الأقسام الرئيسية</a>
                                    </li>

                                    <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif"> صور
                                        منتج ال{{\App\Models\Products::find($id)->name}}

                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- DOM - jQuery events table -->
                    <section id="dom">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title" style="font-family:'Cairo', sans-serif"> جميع صور منتج
                                            ال{{\App\Models\Products::find($id)->name}}</h3>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    @include('admin.includes.alerts.success')
                                    @include('admin.includes.alerts.error')

                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                                    <table
                                                        class="table display nowrap table-striped table-bordered ">

                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th> الجهة</th>
                                                            <th> الصورة</th>
                                                            <th>الإجراءات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                      @isset($images)
                                                      @foreach($images as $image)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{$image->getOrientation()}}</td>
                                                            <td><img class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                                                     data-mdb-ripple-color="light" style="width: 150px; height: 100px;" src="{{asset($image->path)}}"></td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                     aria-label="Basic example">

                                                                    <a href="{{route('admin.products.edit_image',$image->id)}}"
                                                                       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                    <a href="{{route('admin.products.delete_image',$image->id)}}"
                                                                       class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                            @endforeach
                                                        @endisset

                                                        </tbody>
                                                    </table>


                                            <div class="justify-content d-flex">
                                                <div class="btn-group" role="group"
                                                     aria-label="Basic example">
                                                    <a href="{{route('admin.products.addimage',$id)}}"
                                                       class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1">إضافة
                                                        صورة</a>

                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <@endsection
