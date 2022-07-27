@extends('layouts.admin')

@section('content')
    @isset($product_id)
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"
                                                                   style="font-family:'Cairo', sans-serif">الرئيسية </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.maincategories')}}"
                                                                   style="font-family:'Cairo', sans-serif"> الاقسام
                                            الرئيسية </a>
                                    </li>
                                    <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif"> تعديل
                                        صورة
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
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title" id="basic-layout-form"
                                            style="font-family:'Cairo', sans-serif ;color: #0A72E8"> تعديل صورة
                                            منتج {{\App\Models\Wholesales::find($product_id)->name}} </h4>
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
                                            @isset($product_image)
                                            <form class="form" action="{{route('admin.wholesales_products.update_image',$product_image->id)}}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-body">
                                                    @if(get_languages()->count() > 0)
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="projectinput2"> وجه الصورة </label>
                                                                        <select name="orientation"
                                                                                class="select2-container--classic form-control">
                                                                            @if($product_image->getOrientation()=="أمام")
                                                                                <option value="front" selected>أمام
                                                                                </option>
                                                                                <option value="back">خلف</option>
                                                                                <option value="right">يمين</option>
                                                                                <option value="left">يسار</option>
                                                                            @endif

                                                                                @if($product_image->getOrientation()=="خلف")
                                                                                    <option value="front" >أمام
                                                                                    </option>
                                                                                    <option value="back" selected>خلف</option>
                                                                                    <option value="right">يمين</option>
                                                                                    <option value="left">يسار</option>
                                                                                @endif

                                                                                @if($product_image->getOrientation()=="يمين")
                                                                                    <option value="front" >أمام
                                                                                    </option>
                                                                                    <option value="back" >خلف</option>
                                                                                    <option value="right" selected>يمين</option>
                                                                                    <option value="left">يسار</option>
                                                                                @endif

                                                                                @if($product_image->getOrientation()=="يسار")
                                                                                    <option value="front" >أمام
                                                                                    </option>
                                                                                    <option value="back" >خلف</option>
                                                                                    <option value="right">يمين</option>
                                                                                    <option value="left" selected>يسار</option>
                                                                                @endif


                                                                        </select>
                                                                        @error('orientation')
                                                                        <span class="text-danger">{{$message}} </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>


                                                            </div>


                                                            <hr style="width:100%;">

                                                </div>
                                                <div class="form-group">
                                                    <label> الصورة </label><br><br>
                                                    <label id="path" class="file center-block btn-primary">
                                                        <input type="file" id="file" name="path">
                                                        <span class="file-custom"></span>
                                                    </label>
                                                </div>
                                                @error('path')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror
                                                <hr style="width:100%;">
                                                @endisset
                                                @endif

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
        </div>
    @endisset
    <@endsection
