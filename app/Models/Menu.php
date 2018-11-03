<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //声明可被接收的变量
    protected $fillable = ['goods_name','rating','shop_id','category_id','goods_price','description',
        'month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'
    ];
    //获取该菜品的所属分类 一对多（反向）
    public function MenuCategory(){
        return $this->belongsTo(MenuCategory::class,'category_id');//Shop::class
    }
}
