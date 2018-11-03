<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller{
    //登录后才能进行操作
    public function __construct(){
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //订单列表
    public function index(){
        $orders = DB::table('members')
            ->join('orders','members.id','=','orders.user_id')
            ->paginate(10);
        //dd($orders);
        return view('orders.list',compact('orders'));
    }
    //取消订单
    public function cancel(Order $order){
        $order->update([
            'status'=>'-1'
        ]);
        return redirect()->route('orders')->with('success','订单已取消');
    }
    //发货
    public function delivery(Order $order){
        $order->update([
            'status'=>'2'
        ]);
        return redirect()->route('orders')->with('success','已成功发货');
    }
    //订单详情
    public function details(Order $order){
        $orders = DB::table('orders')
            ->join('members','orders.user_id','=','members.id')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->where('orders.id',$order->id)->paginate(10);
        //dd($orders);
        return view('orders.show',compact('orders'));
    }
    //最近一周订单量
    public function statistics(){
        //查询当前商家id
        $shop_id = Auth::user()->shop_id;
        //开始统计时间
        $created = date('Y-m-d 00:00:00',strtotime('-6 day'));
        //结束统计时间
        $updated = date('Y-m-d 23:59:59');
        //dd($updated);
        $sql = "select date(created_at) as d,count(*) as c from orders where shop_id=$shop_id and created_at >= '{$created}' and created_at <= '{$updated}' group by date(created_at)";
        $orders = DB::select($sql);
        //统计7天
        $dates = [];
        for($i=6;$i>=0;$i--){
            $dates[date('Y-m-d',strtotime("-{$i} day"))] = 0;
        }
        foreach ($orders as $order){
            $dates[$order->d] = $order->c;
        }

        //最近三月的订单量
        //开始统计时间
        $created2 = date('Y-m-01 00:00:00',strtotime('-2 month'));
        //结束统计时间
        $updated2 = date('Y-m-d 23:59:59');
        $sql2 = "select month(created_at) as d,count(*) as c from orders where 
        shop_id=$shop_id and created_at >= '{$created2}' and created_at <= '{$updated2}' group by month(created_at)";
        $orders2 = DB::select($sql2);
       // dd($orders2);
        foreach ($orders2 as $k => $v){
            dd($v);
        }
//        $orders2 =
        //统计最近3月
        $dates2 = [];
        for($i=2;$i>=0;$i--){
            $dates2[date('Y-m',strtotime("-{$i} month"))] = 0;
        }
        dd($dates2);
        foreach ($orders2 as $order2){
            $dates2[$order2->d] = $order2->c;
        }
        dd($dates2);
       return view('orders.daily',compact('dates','dates2'));
    }

}
