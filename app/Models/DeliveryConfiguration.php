<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryConfiguration
 * 
 * @property int $config_id
 * @property string $location_name
 * @property float $delivery_amount
 * @property int $created_by
 * @property Carbon $created_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class DeliveryConfiguration extends Model
{
	protected $table = 'delivery_configurations';
	protected $primaryKey = 'config_id';
	public $timestamps = false;

	protected $casts = [
		'delivery_amount' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'location_name',
		'delivery_amount',
		'created_by'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'delivery_id');
	}
}
