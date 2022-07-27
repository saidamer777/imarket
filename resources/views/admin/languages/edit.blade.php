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
                                <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a href="{{route('admin.languages')}}"> اللغات </a>
                                </li>
                                <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif">تعديل لغة
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
                                    <h3 class="card-title" id="basic-layout-form" style="font-family:'Cairo', sans-serif ;color: #0A72E8"> تعديل لغة </h3>
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
                                        <form class="form" action="{{route('admin.languages.update',$language->id)}}" method="POST" enctype="multipart/form-data">
                                              @csrf

                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم اللغة </label>
                                                            <input type="text" value="{{$language->name}}" id="name"
                                                                   class="form-control"
                                                                   placeholder="ادخل اسم اللغة  "
                                                                   name="name">
                                                            @error('name')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختصار اللغة </label>
                                                            <input type="text" value="{{$language->abbr}}" id="abbr"
                                                                   class="form-control"
                                                                   placeholder="ادخل اختصار اللغة "
                                                                   name="abbr">
                                                            @error('abbr')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">


                                                </div>


                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> الاتجاة </label>
                                                            <select name="direction" class="select2-container--classic  form-control">
                                                                    <option value="rtl" @if($language->direction=="rtl") selected @endif>من اليمين الي اليسار</option>
                                                                    <option value="ltr" @if($language->direction=="ltr") selected @endif >من اليسار الي اليمين</option>
                                                            </select>
                                                            @error('direction')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" name="active" value="1"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($language->active == '1') checked @endif
                                                            />
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>
                                                            @error('active')
                                                            <span class="text-danger">{{$message}}</span>

                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


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
