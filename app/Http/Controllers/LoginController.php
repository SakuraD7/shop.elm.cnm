<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller{
    //登录后才能进行操作
    public function __construct(){
        $this->middleware('guest', [
            'only' => ['create', 'store']
        ]);
        $this->middleware('auth', [
            'only' => ['destroy'],
        ]);
    }
    //商家登录界面
    public function create(){
        return view('logins.login');
    }
    //登录验证
    public function store(Request $request){
       $this->validate($request,[
           'name'=>'required',
           'password'=>'required',
       ],[
           'name.required'=>'用户名不能为空',
           'password.required'=>'密码不能为空',
       ]);
       if(Auth::attempt(['name' => $request->name, 'password' => $request->password], $request->has('remember'))){
           if(User::where('name',$request->name)->first()->status==1){
               return redirect()->route('index')->with('success','登录成功');
           }else{
               return back()->with('danger', '账号未启用,请激活后登录')->withInput();
           }
       }else{
           return back()->with('danger', '用户名或密码错误，请重新登录')->withInput();
       }
//        if(User::where('name',$request->name)->first()->status==1){
//            if ( Auth::attempt(['name' => $request->name, 'password' => $request->password], $request->has('remember'))) {
//                return redirect()->route('index')->with('success','登录成功');
//            } else {
//                //登录失败
//                return back()->with('danger', '用户名或密码错误，请重新登录')->withInput();
//            }
//        }else{
//            return back()->with('danger', '账号未启用,请激活后登录')->withInput();
//        }
    }
    //退出登录
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','成功退出');
    }
    //后台首页
    public function index(){
        return view('logins.home');
    }

}
