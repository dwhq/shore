<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price'
    ];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];
    // 与商品SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    /**
     * @return string
     * 定义一个修改器
     *若要定义一个修改器，则须在模型上定义一个 setFooAttribute 方法。
     * 要访问的 Foo 字段需使用「驼峰式」来命名。让我们再来定义 first_name 属性的修改器。
     * 当我们尝试在模型上设置 first_name 的值时，该修改器将被自动调用：
     * https://laravel-china.org/docs/laravel/5.5/eloquent-mutators/1335
     */
    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        //startsWith 确定给定的字符串是否以给定的子字符串开头
        if (Str::startsWith($this->attributes['image'],['http://', 'https://'])){
            return $this->attributes['image'];
        }
        return \Storage::disk('admin')->url($this->attributes['image']);
    }
}
