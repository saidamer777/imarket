<?php

namespace App\Http\Controllers\Admin;

use App\Events\Confirmation;
use App\Http\Controllers\Controller;
use App\Models\Bills;
use App\Models\MainCategory;
use App\Models\Notification;
use App\Models\Wholesales_bills;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function getorders()
    {
        $orders = Bills:: select()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function getordersproducts($id)
    {
        $bills_products = Bills::with('productsOrder')->find($id);
        $cost = 0;
        foreach ($bills_products->productsOrder as $product) {
            $cost = $cost + ($product->total_price);
        }
        return view('admin.orders.products', compact('bills_products', 'cost'));
    }
    public function getorderswholesales($id)
    {
        $bills_products = Wholesales_bills::with('wholesalesProductOrder')->find($id);
        $cost = 0;
        foreach ($bills_products->wholesalesProductOrder as $product) {
            $cost = $cost + ($product->total_price);
        }
        return view('admin.wholesalers_orders.products', compact('bills_products', 'cost'));
    }
    public function getWholesalersOrder()
    {
        $orders = Wholesales_bills:: select()->get();

        return view('admin.wholesalers_orders.index', compact('orders'));
    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }

    public function create()
    {
        $allCategories = MainCategory::with('products')->get();
        return view('admin.orders.create', compact('allCategories'));
    }

    public function store(Request $request)
    {/// edit user id said
        ///
        try {
            if(!$request->has('counts'))
            {
                return redirect()->route('admin.orders.create')->with(['error' => 'هناك خطأ في الطلب']);

            }

            $request->request->add(['customer_id' => '140']);
            $firstorder = Bills::create($request->except(['_token', 'products']));

//                event(new Confirmation($orderandProducts));
            $products = collect($request->input('counts', []))->map(function ($product) {
                return ['products_count' => $product];
            });

            $firstorder->productsOrder()->sync(
                $products);
            Notification::create(['bill_id' => $firstorder->id]);
            $orderandProducts = Bills::with('productsOrder')->find($firstorder->id);
            event(new Confirmation($orderandProducts));

            return redirect()->route('admin.orders.create')->with(['success' => 'تم الطلب بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.orders.create')->with(['error' => 'هناك خطأ في الطلب']);

        }


    }
}
