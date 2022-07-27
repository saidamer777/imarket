@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">

                    @isset($title)

                        <h3 class="content-header-title" style="font-family:'Cairo', sans-serif">{{$title}} </h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a
                                            href="{{route('admin.dashboard')}}">الرئيسية</a>
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
                                    <h3 class="card-title" style="font-family:'Cairo', sans-serif">{{$title}}</h3>
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

                                @endisset
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.error')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form>
                                            @isset($notifications)
                                                @foreach($notifications as $notification)
                                                    <table
                                                        class="table display nowrap table-striped table-bordered ">
                                                        <thead>
                                                        <tr>
                                                            <th> رقم الطلب</th>
                                                            <th> اسم الزبون</th>
                                                            <th> رقم الموبايل</th>
                                                            <th> العنوان</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>


                                                        <tr>
                                                            {{--                                                    <td>{{$bills_products->id}}</td>--}}
                                                            {{--                                                    <td>{{\App\Models\Customer::find($bills_products->customer_id)->name}}</td>--}}
                                                            {{--                                                    <td>{{\App\Models\Customer::find($bills_products->customer_id)->phone}}</td>--}}
                                                            <td>{{$id=$notification->wholesales_bill_id}}</td>

                                                            <td>{{$customer_name=\App\Models\Wholesalers::find(\App\Models\Wholesales_bills::find($id)->wholesaler_id)->name}}</td>
                                                            <td>{{$email=\App\Models\Wholesalers::find(\App\Models\Wholesales_bills::find($id)->wholesaler_id)->email}}</td>
{{--                                                            <div style="display: none">{{$address=\App\Models\Address::where('customer_id',\App\Models\Bills::find($id)->customer_id)->first()}}</div>--}}
{{--                                                            <td>{{$address->region.' - '.$address->neighborhood.' - '.$address->lane.' - '.'البناء : '.$address->building.' - '.'الطابق : '.$address->floor.' - '.'الجهة : '.$address->side}}</td>--}}
                                                            <td></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <div class="justify-content d-flex">
                                                        <div class="btn-group" role="group" style="font-weight: bold"
                                                             aria-label="Basic example">
                                                            {{--                                                المنتجات ( {{ $bills_products->productsOrder->count() }} )--}}

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table
                                                        class="table display nowrap table-striped table-bordered ">
                                                        <thead>
                                                        <tr>
                                                            <th> اسم المنتج</th>
                                                            <th> السعر للمستهلك</th>
                                                            <th> العدد المطلوب</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach(\App\Models\Wholesales_bills::find($id)->wholesalesProductOrder as $product)
                                                            <tr>
                                                                <td>{{$product->name}}</td>
                                                                <td>{{$price=($product->price + ($product->price * $product->profit/100))}}</td>
                                                                <td>{{$count=$product->pivot->products_count}}</td>
                                                                @isset($totalprice)
                                                                    <td style="display: none">{{$totalprice += $price * $count}}</td>
                                                                @endisset

                                                            </tr>
                                                        @endforeach



                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        @isset($totalprice)
                                                            <div class="col-md-6" style="font-weight: bold ;font-size: 24px">
                                                                القيمة الكلية: {{$totalprice}} ل . س
                                                                @endisset
                                                                <div style="display: none">{{$totalprice=0}}</div>

                                                            </div>
                                                            <div class="col-md-6" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.wholesales_notification.update',$notification->id)}}"
                                                                   class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1">تأكيد
                                                                    الطلب</a>
                                                                <a href="{{route('admin.wholesales_notification.delete',$notification->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>


                                                            </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <br>


                                        @endforeach
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
