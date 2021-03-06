<?php

namespace App\Models;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    //
    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param $amount
     * @return int
     * @throws InternalException
     */
    public function decreaseStock($amount)
    {
        if ($amount <= 0) {
            throw new InternalException('减库存不可小于0');
        }
        //decrement 按一定数量递减列的值
        return $this->newQuery()->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        //decreaseStock() 方法里我们用了 $this->newQuery() 方法来获取数据库的查询构造器，
        //ORM查询构造器的写操作只会返回 true 或者 false 代表 SQL 是否执行成功，
        //而数据库查询构造器的写操作则会返回影响的行数。
        if ($amount <= 0){
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }
}
