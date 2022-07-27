@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">


                    @isset($title)
                        <h3 class="content-header-title" style="font-family:'Cairo', sans-serif">{{$title}}</h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" style="font-family:'Cairo', sans-serif"><a
                                            href="{{route('admin.dashboard')}}">الرئيسية</a>
                                    </li>

                                    <li class="breadcrumb-item active"
                                        style="font-family:'Cairo', sans-serif">{{$title}}

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
                                    @endisset
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
                                                <th> رقم المحل</th>
                                                <th> اسم المحل</th>
                                                <th> رقم الهاتف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($wholesalers)
                                                @foreach($wholesalers as $wholesaler)
                                                    <tr>
                                                        <td>{{$wholesaler->id}}</td>
                                                        <td>{{$wholesaler->name}}</td>
                                                        <td>{{$wholesaler->phone}}</td>
                                                    </tr>

                                                @endforeach
                                            @endisset

                                            </tbody>
                                        </table>

                                        <div class="justify-content-center d-flex">
                                            <div class="btn-group" role="group"
                                                 aria-label="Basic example">

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
