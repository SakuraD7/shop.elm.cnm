<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    //登录后才能进行操作
    public function __construct(){
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //商家注册界面
    public function create(){
        $shopgories=DB::table('shop_categories')->get();
        return view('users.create',compact('shopgories'));
    }
    //保存注册信息-未审核
    public function store(Request $request){
        $this->validate($request,[
            //商家信息
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_img'=>'required|file',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            //账号信息
            'name'=>'required',
            'email'=>'email',
            'password'=>'required',
        ]);
        $path = $request->file('shop_img')->store('public/shops');
        //开启事务
        DB::beginTransaction();
        $sql=DB::table('shops')->insertGetId([//也可以使用insertGetId直接获取新增数据的自增id
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $path,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);
        //获取最后一条新增数据id($shop_id=$id = DB::getPdo()->lastInsertId();)
        $sql2=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'shop_id' => $sql,
        ]);
        if($sql && $sql2){
            //执行成功提交事务
            DB::commit();
            return redirect()->route('login')->with('success','添加商家成功');
        }else{
            DB::rollback();
            return redirect()->route('shops.create')->with('success','添加商家失败');
        }
    }
    //个人中心-商家账号、信息
    public function index(){
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $shopgories=DB::table('shop_categories')->get();
        $shop = DB::table('shops')->where('id', Auth::user()->shop_id)->first();
        return view('users.list',compact('user','shop','shopgories'));
    }
    //保存商家信息修改
    public function update(Request $request){
        $this->validate($request,[
            //商家信息
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_img'=>'required|file',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            //账号信息
            'name'=>'required',
            'email'=>'email',
        ]);
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $request->shop_img ? $path = $request->file('shop_img')->store('public/shops'):$path = DB::table('shops')->where('id', Auth::user()->shop_id)->first()->shop_img;
        $shop=DB::table('shops')->where('id',Auth::user()->shop_id)->update([
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $path,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
        ]);
        return redirect()->route('users.index')->with('success','修改信息成功');
    }
    //显示商家密码修改表单
    public function edit(User $user){
        return view('users.pwd',compact('user'));
    }
    //保存商家密码修改
    public function savepwd(Request $request){
        //dd($request->password,Hash::make(auth()->user()->password));
        $this->validate($request,[
            'password'=>'required',
            'newpwd'=>'required|confirmed',
            'newpwd_confirmation'=>'required|same:newpwd',
        ],[
            'password.required'=>'请输入旧密码',
            'newpwd.required'=>'新密码不能为空',
            'newpwd_confirmation.required'=>'请确认密码',
            'newpwd.confirmed'=>'两次密码输入不一致',
            'newpwd_confirmation.same'=>'请确认密码一致',
        ]);
        if(Hash::check($request->password,auth()->user()->password)){
            auth()->user()->update([
                'password' => bcrypt($request->newpwd),
            ]);
            return redirect()->route('index')->with('success','管理员密码修改成功');
        }else{
            return redirect()->route('users.edit')->with('success','旧密码错误');
        }
    }
}
