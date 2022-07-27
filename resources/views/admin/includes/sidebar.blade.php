<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>



            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\MainCategory::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">أضافة
                            قسم جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الأقسام الأكثر تفضيلا</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">3</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories.extra')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات الأكثر تفضيلا</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">7</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products.extra')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المستخدمين</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Customer::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.customers.all')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li class="active"><a class="menu-item" href="{{route('admin.customers.vip')}}"
                                          data-i18n="nav.dash.ecommerce"> VIP </a>
                    </li>
                </ul>

            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المحلات التجارية</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Wholesalers::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.wholesalers.all')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>   <li class="active"><a class="menu-item" href="{{route('admin.wholesalers.vip')}}"
                                          data-i18n="nav.dash.ecommerce"> VIP </a>
                    </li>
                </ul>   <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.wholesalers.create')}}"
                                          data-i18n="nav.dash.ecommerce"> إضافة محل </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item "><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الطلبات   </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Bills::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.customer.orders')}}"
                                          data-i18n="nav.dash.ecommerce"> طلبات المستخدمين </a>
                    <li class="active"><a class="menu-item" href="{{route('admin.wholesaler.orders')}}"
                                          data-i18n="nav.dash.ecommerce"> طلبات تجار الجملة </a>
                    </li>
                    <li class="active"><a class="menu-item" href="{{route('admin.orders.create')}}"
                                          data-i18n="nav.dash.ecommerce"> إعداد طلب  </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الجرد </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">3</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.inventory')}}"
                                          data-i18n="nav.dash.ecommerce"> انشاء جرد </a>
                    <li class="active"><a class="menu-item" href=""
                                          data-i18n="nav.dash.ecommerce"> عرض الجرود السابقة </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Languages::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.languages')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.languages.create')}}" data-i18n="nav.dash.crypto">إضافة لغة جديدة
                        </a>
                    </li>
                </ul>

            </li>


        </ul>
    </div>
</div>
