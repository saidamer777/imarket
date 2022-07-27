@extends('layouts.admin')

@section('content')
@isset($id)
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" style="font-family:'Cairo', sans-serif">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.maincategories')}}" style="font-family:'Cairo', sans-serif"> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif">  إضافة منتج جملة
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
                                    <h4 class="card-title" id="basic-layout-form" style="font-family:'Cairo', sans-serif ;color: #0A72E8"> إضافة منتج جملة في قسم {{\App\Models\MainCategory::find($id)->name}} </h4>
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
                                        <form class="form" action="{{route('admin.wholesales.store',$id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                @if(get_languages()->count() > 0)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتج </label>
                                                            <input type="text" value="" id="name"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> السعر </label>
                                                            <input type="text" value="" id="price"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="price">
                                                            @error("price")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                        <hr style="width:100%;">

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> العدد </label>
                                                            <input type="text" value="" id="count"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="count">
                                                            @error("count")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> نسبة الربح   </label>
                                                            <input type="text" value="" id="profit"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="profit">
                                                            @error("profit")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <hr style="width:100%;">
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> الوصف </label>
                                                                <input type="text" value="" id="description"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       name="description">
                                                                @error("description")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>




                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox"  value="1" name="active"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                           checked/>
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1">الحالة </label>
                                                                    @error("active")
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



{{--                                                <div class="form-group">--}}
{{--                                                    <label> صوره القسم </label><br><br>--}}
{{--                                                    <label id="projectinput7" class="file center-block btn-primary">--}}
{{--                                                        <input type="file" id="file" name="photo">--}}
{{--                                                        <span class="file-custom"></span>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                @error('photo')--}}
{{--                                                <span class="text-danger"> {{$message}}</span>--}}
{{--                                                @enderror--}}
                                                @endif

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
