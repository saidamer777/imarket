@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">


            <div class="grey-bg container-fluid">
                <section id="minimal-statistics">
                    <main>
                        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                                <div class="col">
                                    <div class="card h-100 shadow-sm "><img
                                                src="/public/asset/logo.png" style="width: 400px;height: 300px"
                                                class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3">
                                                <h1 style="font-family:'Cairo', sans-serif">جرد منتجات</h1></div>
                                            <h5 class="card-title" style="font-family:'Cairo', sans-serif">في هذا النوع من الجرد سيتم احصاء كل بيانات المنتجات في المتجر </h5>
                                            <div class="text-center my-4"><a href="{{route('admin.inventory.products')}}" class="btn btn-warning" style="font-family:'Cairo', sans-serif">إنشاء</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 shadow-sm"><img
                                            src="/public/asset/istockphoto-1140827660-170667a.jpg" style="width: 350px;height: 300px"
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <div class="clearfix mb-3">
                                                <h1 style="font-family:'Cairo', sans-serif">جرد حسابي</h1></div>
                                            <h5 class="card-title" style="font-family:'Cairo', sans-serif">في هذا النوع من الجرد سيتم احصاء كل ما يتعلق بعمليات المحاسبة</h5>
                                            <div class="text-center my-4"><a href="#" class="btn btn-warning" style="font-family:'Cairo', sans-serif">إنشاء</a></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </main>

                </section>


            </div>
        </div>
    </div>
@endsection
