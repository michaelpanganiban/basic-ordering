<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int $order_id
 * @property float $sub_total
 * @property int $delivery_id
 * @property float $deliver_amount
 * @property float $total_amount
 * @property int $created_by
 * @property Carbon $created_at
 *
 * @property User $user
 * @property DeliveryConfiguration $delivery_configuration
 * @property Collection|OrderLine[] $order_lines
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'order_id';
	public $timestamps = false;

	protected $casts = [
		'sub_total' => 'float',
		'delivery_id' => 'int',
		'deliver_amount' => 'float',
		'total_amount' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'sub_total',
		'delivery_id',
		'deliver_amount',
		'total_amount',
		'created_by',
        'customer_name'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function delivery_configuration()
	{
		return $this->belongsTo(DeliveryConfiguration::class, 'delivery_id');
	}

	public function order_lines()
	{
		return $this->hasMany(OrderLine::class);
	}
}
