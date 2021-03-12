<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderLine
 *
 * @property int $line_id
 * @property int $order_id
 * @property int $product_id
 * @property float $quantity
 * @property float $amount
 * @property float $product_total_amount
 * @property int $discount_id
 *
 * @property DiscountConfiguration $discount_configuration
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models
 */
class OrderLine extends Model
{
	protected $table = 'order_line';
	protected $primaryKey = 'line_id';
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'float',
		'amount' => 'float',
		'product_total_amount' => 'float',
		'discount_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'quantity',
		'amount',
		'product_total_amount',
		'discount_id',
        'discount_amount'
	];

	public function discount_configuration()
	{
		return $this->belongsTo(DiscountConfiguration::class, 'discount_id');
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
