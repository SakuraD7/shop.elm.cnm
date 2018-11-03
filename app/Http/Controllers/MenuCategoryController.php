<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller{
//        return redirect()->route('login')->with('success','请登录后再进行操作');
//    }
    //登录后才能进行操作
    public function __construct(){
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //菜品分类
    public function index(){
        $shop_id = Auth::user()->shop_id;
        $shop_name = DB::table('shops')->where('id',$shop_id)->first()->shop_name;
        $menucategories = MenuCategory::where('shop_id',$shop_id)->paginate(5);
        return view('menucategories.list',compact('menucategories','shop_name'));
    }
    //添加菜品分类
    public function create(){
        $shop_id = Auth::user()->shop_id;
        return view('menucategories.create',compact('shop_id'));
    }
    //保存菜品分类添加
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ]);
        if($request->is_selected==1){
            DB::table('menu_categories')
                ->where('shop_id',Auth::user()->shop_id)
                ->update(['is_selected'=>0]);
        }
        MenuCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'shop_id' => Auth::user()->shop_id,
            'is_selected' => $request->is_selected,
            'type_accumulation' => time(),
        ]);
        return redirect()->route('menucategories.index')->with('success','添加菜品分类成功');
    }
    //修改菜品分类-回显
    public function edit(MenuCategory $menucategory){
        return view('menucategories.edit',compact('menucategory'));
    }
    //保存菜品分类修改
    public function update(Request $request,MenuCategory $menucategory){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ]);
        if($request->is_selected==1){
            DB::table('menu_categories')
                ->where('shop_id',Auth::user()->shop_id)
                ->update(['is_selected'=>0]);
        }
        $menucategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_selected' => $request->is_selected,
        ]);
        return redirect()->route('menucategories.index')->with('success','修改菜品分类成功');
    }
    //删除菜品分类
    public function destroy(MenuCategory $menucategory){
        $category = DB::table('menus')->where('category_id',$menucategory->id)->first();
        if(!$category){
            $menucategory->delete();
            return redirect()->route('menucategories.index')->with('success','删除菜品分类成功');
        }else{
            return redirect()->route('menucategories.index')->with('success','该分类下还有其他菜品，删除失败');
        }
    }
}
