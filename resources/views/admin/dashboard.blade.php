@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">


            <div class="grey-bg container-fluid">
                <section id="minimal-statistics">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-list primary font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>{{\App\Models\MainCategory::get()->count()}}</h3>
                                                <span>الأقسام الرئيسية</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-user warning font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>{{\App\Models\Customer::get()->count()}}</h3>
                                                <span> المستخدمين</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-user success font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>{{\App\Models\Customer::where('active',1)->get()->count()}}</h3>
                                                <span> المتسخدمين النشطين</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="align-self-center">
                                                <i class="icon-note danger font-large-2 float-left"></i>
                                            </div>
                                            <div class="media-body text-right">
                                                <h3>{{\App\Models\Bills::get()->count()}}</h3>
                                                <span>طلبات المستخدمين</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="danger">{{\App\Models\Wholesalers::get()->count()}}</h3>
                                                <span>تجار الجملة</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-basket warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="success">{{\App\Models\Wholesales_bills::get()->count()}}</h3>
                                                <span>طلبات تجار الجملة</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-note success font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="warning">{{\App\Models\Products::get()->count()}}</h3>
                                                <span>منتجات المفرق</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body text-left">
                                                <h3 class="primary">{{\App\Models\Wholesales::get()->count()}}</h3>
                                                <span>منتجات الجملة</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-support primary font-large-2 float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>

                <section id="stats-subtitle">


{{--                    <div class="row">--}}
{{--                    <div class="col-xl-6 col-md-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-content">--}}
{{--                                    <div class="card-body cleartfix">--}}
{{--                                        <div class="media align-items-stretch">--}}
{{--                                            <div class="align-self-center">--}}
{{--                                                <h1 class="mr-2">$36,000.00</h1>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h4>رأس المال الحالي</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="align-self-center">--}}
{{--                                                <i class="icon-wallet success font-large-2"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-xl-6 col-md-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-content">--}}
{{--                                    <div class="card-body cleartfix">--}}
{{--                                        <div class="media align-items-stretch">--}}
{{--                                            <div class="align-self-center">--}}
{{--                                                <i class="icon-arrow-up warning font-large-2 mr-2"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h4>الربح</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="align-self-center">--}}
{{--                                                <h1>84,695</h1>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <h1 class="mr-2">$0</h1>
                                            </div>
                                            <div class="media-body">
                                                <h4>Total Sales</h4>
                                                <span>Monthly Sales Amount</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-heart danger font-large-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="media align-items-stretch">
                                            <div class="align-self-center">
                                                <h1 class="mr-2">$500</h1>
                                            </div>
                                            <div class="media-body">
                                                <h4>Total Cost</h4>
                                                <span>Monthly Cost</span>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="icon-wallet success font-large-2"></i>
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
@endsection
