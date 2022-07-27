@extends('layouts.admin')

@section('content')

     <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">





                    <h3 class="content-header-title" style="font-family:'Cairo', sans-serif"> بيانات الطلب </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
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
                                    <h3 class="card-title" style="font-family:'Cairo', sans-serif" >بيانات الطلب </h3>
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
                                                <th > رقم الطلب</th>
                                                <th> اسم المحل </th>
                                                <th> رقم الموبايل </th>
                                                <th> العنوان </th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            @isset($bills_products)
                                            <tr>
                                                <td>{{$bills_products->id}}</td>
                                                <td>{{\App\Models\Wholesalers::find($bills_products->wholesaler_id)->name}}</td>
                                                <td>{{\App\Models\Wholesalers::find($bills_products->wholesaler_id)->phone}}</td>
                                                <td>جرمانا</td>

{{--                                                <td>--}}
{{--                                                    <div class="btn-group" role="group"--}}
{{--                                                         aria-label="Basic example">--}}

{{--                                                        <a href="{{route('admin.orders.get.products',$order->id)}}"--}}
{{--                                                           class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1">كل التفاصيل</a>--}}
{{--                                                        <a href=""--}}
{{--                                                           class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>--}}
{{--                                                        <a href=""--}}
{{--                                                           class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>--}}

{{--                                                    </div>--}}
{{--                                                </td>--}}
                                            </tr>

                                            </tbody>
                                        </table>
                                        <div class="justify-content d-flex">
                                            <div class="btn-group" role="group" style="font-weight: bold"
                                                 aria-label="Basic example">
                                                  المنتجات ( {{ $bills_products->wholesalesProductOrder->count() }} )

                                            </div>
                                        </div>
                                        <br>
                                        <table
                                            class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                            <tr>
                                                <th> اسم المنتج </th>
                                                <th> السعر للمستهلك </th>
                                                <th> العدد المطلوب </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($bills_products->wholesalesProductOrder as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->total_price}}</td>
                                                <td>1</td>



                                            </tr>

                                                @endforeach

                                                @endisset


                                            </tbody>
                                        </table>
                                        @isset($cost);
                                        <div class="justify-content d-flex">
                                            <div class="btn-group" role="group" style="font-weight: bold ;font-size: 24px"
                                                 aria-label="Basic example">
                                                  القيمة الكلية:  {{$cost}}   ل . س

                                            </div>
                                        </div>
                                        @endisset
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
