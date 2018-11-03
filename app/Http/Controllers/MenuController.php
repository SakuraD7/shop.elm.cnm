<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller{
    //登录后才能进行操作
    public function __construct(){
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //活动列表
    public function conduct(){
        $activities  = Activity::where('end_time','>',date('Y-m-d H:i:s',time()))
            ->where('start_time','<',date('Y-m-d H:i:s',time()))->get();
        return view('activities.list',compact('activities'));
    }
    //活动详情
    public function details(Activity $activity){
        return view('activities.details',compact('activity'));
    }
    //菜品列表-默认所有菜品
    public function index(Request $request){
        $shop_id = Auth::user()->shop_id;
        $shop_name = DB::table('shops')->where('id',$shop_id)->first()->shop_name;
        $wheres = [];
        if($request->name){
            $wheres[] = ['goods_name','like',"%{$request->name}%"];
        }
        if($request->price1){
            $wheres[] = ['goods_price','>=',$request->price1];
        }
        if($request->price2){
            $wheres[] = ['goods_price','<=',$request->price2];
        }
        $menus = Menu::where('shop_id',$shop_id)->where($wheres)->paginate(2);
        return view('menus.list',compact('menus','shop_name'));
    }
    //菜品列表-按分类显示
    public function show($id){
        $shop_id = Auth::user()->shop_id;
        $shop_name = DB::table('shops')->where('id',$shop_id)->first()->shop_name;
        $menus = Menu::where('category_id',$id)->paginate(2);
        return view('menus.list',compact('menus','shop_name'));
    }
    //显示新增菜品表单
    public function create(){
        $menucategories = MenuCategory::all();
        return view('menus.create',compact('menucategories'));
    }
    //保存新增菜品
    public function store(Request $request){
        $this->validate($request,[
            'goods_name'=>'required',
            'goods_img'=>'required|file',
            'rating'=>'required',
            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'month_sales'=>'required',
            'rating_count'=>'required',
            'tips'=>'required',
            'satisfy_count'=>'required',
            'satisfy_rate'=>'required',
        ]);
        $path = $request->file('goods_img')->store('public/menus');
        Menu::create([
            'goods_name' => $request->goods_name,
            'goods_img' => $path,
            'rating' => $request->rating,
            'shop_id' => Auth::user()->shop_id,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'status' => $request->status,
        ]);
        return redirect()->route('menus.index')->with('success','添加菜品成功');
    }
    //修改菜品信息-回显
    public function edit(Menu $menu){
        $menucategories = MenuCategory::all();
        return view('menus.edit',compact('menu','menucategories'));
    }
    //保存菜品修改
    public function update(Request $request,Menu $menu){
        $request->shop_img ? $path = $request->file('goods_img')->store('public/menus'):$path = $menu->goods_img;
        $menu->update([
            'goods_name' => $request->goods_name,
            'goods_img' => $path,
            'rating' => $request->rating,
            'category_id' => $request->category_id,
            'goods_price' => $request->goods_price,
            'description' => $request->description,
            'month_sales' => $request->month_sales,
            'rating_count' => $request->rating_count,
            'tips' => $request->tips,
            'satisfy_count' => $request->satisfy_count,
            'satisfy_rate' => $request->satisfy_rate,
            'status' => $request->status,
        ]);
        return redirect()->route('menus.index')->with('success','修改菜品信息成功');
    }
    //删除菜品
        public function destroy(Menu $menu){
            $menu->delete();
            return redirect()->route('menus.index')->with('success', '删除菜品成功');
        }
}
