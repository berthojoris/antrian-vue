<?php

namespace App\Http\Controllers;

use App\Order;
use Faker\Factory;
use App\OrderDetail;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Events\OrderStatusUpdate;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        return Order::orderBy('id', 'desc')->get();
    }

    public function create(Request $request)
    {
        if($request->isMethod('post')) {

            if(empty(request('menu')) || empty(request('table_id'))) {
                flash('ID Tabel dan Menu belum dipilih')->error();
                return redirect('create');
            }

            DB::beginTransaction();

            $faker = Factory::create();
            $tableID = request('table_id');
            $uuid = Uuid::generate()->string;

            try {
                $save = Order::create([
                    'table_id' => $tableID,
                    'uuid' => $uuid,
                    'table_name' => $faker->name,
                    'user_order' => $faker->name
                ]);

                $menuForm = [];
                foreach(request('menu') as $m) {
                    array_push($menuForm, [
                        'uuid' => $uuid,
                        'table_id' => $tableID,
                        'menu_name' => $m,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }

                OrderDetail::insert($menuForm);

                DB::commit();
                flash('Order telah dibuat')->success();
                OrderStatusUpdate::dispatch($save, 'CREATED');
                return back();
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e);
            }
        }

        return view('create');
    }

    public function store(Request $request)
    {
        $faker = Factory::create();

        $save = Order::create([
            'table_id' => request('table_id'),
            'table_name' => $faker->name,
            'user_order' => $faker->name
        ]);

        OrderStatusUpdate::dispatch($save, 'CREATED');

        return response()->json([
            'data' => $save
        ], 201);
    }

    public function show(Order $order)
    {
        //
    }

    public function edit($id, $status)
    {
        $update = Order::whereId($id)->update([
            'status' => strtoupper($status)
        ]);

        $find = Order::whereId($id)->first();
        OrderStatusUpdate::dispatch($find, 'UPDATED');

        flash('Order telah diupdate')->success();
        return back();
    }

    public function editstatus()
    {
        $datas = Order::orderBy('id', 'desc')->get();
        return view('edit', ['datas' => $datas]);
    }

    public function update(Request $request, Order $order)
    {
        $update = Order::whereId($order->id)->update([
            'status' => request('status')
        ]);
        $find = Order::whereId($order->id)->first();
        OrderStatusUpdate::dispatch($find, 'UPDATED');

        return response()->json([
            'data' => $find
        ], 200);
    }

    public function destroy(Order $order)
    {
        dd($order);
        Order::find($order)->delete();
    }

    public function deleteall()
    {
        DB::table('orders')->truncate();
        DB::table('order_details')->truncate();
        return "OK";
    }
}
