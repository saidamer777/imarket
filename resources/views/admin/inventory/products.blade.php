@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" style="font-family:'Cairo', sans-serif">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active" style="font-family:'Cairo', sans-serif"> جرد منتجات
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
                                    <h4 class="card-title" id="basic-layout-form" style="font-family:'Cairo', sans-serif ;color: #0A72E8"> جرد منتجات </h4>
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
                                        <form class="form" action="{{route('admin.inventory.products.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                @if(get_languages()->count() > 0)
                                                    @foreach($allCategories as $cat)
                                                        <div class="center" style="text-align: center ; font-weight: bold ;font-size: 20px;color:#0A72E8; ">
                                                            قسم ال{{$cat->name}} ( {{$cat->products->count()}} )

                                                        </div>

                                                        {{--                                                            <div class="center" style="text-align: center ; ;font-size: 16px;color:darkred;">--}}
                                                        {{--                                                                {{$product->name}}--}}

                                                        {{--                                                            </div>--}}


                                                        <div class="card-content collapse show">
                                                            <div class="card-body card-dashboard">

                                                                <table
                                                                    class="table display nowrap table-striped table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th> اسم المنتج </th>
                                                                        <th>العدد المتبقي</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    @isset($cat->products)
                                                                        @foreach($cat->products as $product)

                                                                            <tr>
                                                                                <td>{{$product->id}}</td>
                                                                                <td>{{$product->name}}</td>
                                                                                <td>{{$product->count}}</td>

                                                                            </tr>

                                                                        @endforeach
                                                                    @endisset

                                                                    </tbody>
                                                                </table>

                                                                <div class="justify-content-center d-flex">

                                                                </div>
                                                            </div>
                                                        </div>



                                                    @endforeach

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

@endsection

