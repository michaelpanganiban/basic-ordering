<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountConfiguration
 * 
 * @property int $discount_id
 * @property string $discount_name
 * @property float $percentage
 * @property int $created_by
 * @property Carbon $created_at
 * 
 * @property Collection|OrderLine[] $order_lines
 *
 * @package App\Models
 */
class DiscountConfiguration extends Model
{
	protected $table = 'discount_configuration';
	protected $primaryKey = 'discount_id';
	public $timestamps = false;

	protected $casts = [
		'percentage' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'discount_name',
		'percentage',
		'created_by'
	];

	public function order_lines()
	{
		return $this->hasMany(OrderLine::class, 'discount_id');
	}
}
