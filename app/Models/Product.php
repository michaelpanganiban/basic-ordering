<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $product_id
 * @property string $product_name
 * @property float $price
 * @property int $created_by
 * @property Carbon $created_at
 * 
 * @property Collection|OrderLine[] $order_lines
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	protected $primaryKey = 'product_id';
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'created_by' => 'int'
	];

	protected $fillable = [
		'product_name',
		'price',
		'created_by'
	];

	public function order_lines()
	{
		return $this->hasMany(OrderLine::class);
	}
}
