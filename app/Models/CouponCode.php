<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class CouponCode
 * @package App\Models
 * 优惠券
 */
class CouponCode extends Model
{
    const TYPE_FIXED = 'fixed';

    const TYPE_PERCENT = 'percent';

    public static $typeMap = [
        self::TYPE_FIXED => '固定金额',
        self::TYPE_PERCENT => '比例',
    ];
    //$fillable 定义可以被批量赋值的
    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'total',
        'used',
        'min_amount',
        'not_before',
        'not_after',
        'enabled',
    ];
    protected $appends = ['description'];
    protected $casts = [
        'enabled' => 'boolean',
    ];
    // 指明这两个字段是日期类型
    protected $dates = ['not_before', 'not_after'];

    /**
     * @param int $length
     * @return string
     * 生成优惠券code
     */
    public static function findAvailableCode($length = 16)
    {
        do {
            // 生成一个指定长度的随机字符串，并转成大写
            $code = strtoupper(Str::random($length));
        } while (self::query()->where('code', $code)->exists());
        return $code;
    }

    /**
     * @return string
     * 定义访问器   访问时  访问 $this->attribute
     */
    public function getDescriptionAttribute()
    {
        $str = '';
        if ($this->min_amount > 0) {
            $str = '满' . str_replace('.00', '', $this->min_amount);
        }
        if ($this->type === self::TYPE_PERCENT) {
            return $str . '优惠' . str_replace('0.00','',$this->value) . '%';
        }
        return $str . '减' .  str_replace('0.00','',$this->value);
    }
}
