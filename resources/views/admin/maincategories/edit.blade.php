@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a href="{{route('admin.maincategories')}}"> الأقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif">تعديل قسم
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h3 class="card-title" id="basic-layout-form" style="font-family:'Cairo', sans-serif ;color: #0A72E8"> تعديل قسم </h3>
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
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.maincategories.update',$cat->id)}}" method="POST" enctype="multipart/form-data">
                                              @csrf

                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم القسم </label>
                                                            <input type="text" value="{{$cat->name}}" id="name"
                                                                   class="form-control"
                                                                   placeholder="ادخل اسم القسم "
                                                                   name="name">
                                                            @error('name')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختصار اللغة </label>
                                                            <input type="text" value="{{$cat->translation_lang}}" id="translation_lang"
                                                                   class="form-control"
                                                                   placeholder="ادخل اختصار اللغة "
                                                                   name="translation_lang">
                                                            @error('translation_lang')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">


                                                </div>




                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" name="active" value="1"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($cat->active == '1') checked @endif
                                                            />
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>
                                                            @error('active')
                                                            <span class="text-danger">{{$message}}</span>

                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <hr style="width:100%;">
                                            </div>
                                            <div class="form-group">
                                                <label> صوره القسم </label><br><br>
                                                <label id="projectinput7" class="file center-block btn-primary">
                                                    <input type="file" id="file" name="image_path">
                                                    <span class="file-custom"></span>
                                                </label>
                                            </div>
                                            @error('image_path')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-danger mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div><@endsection
