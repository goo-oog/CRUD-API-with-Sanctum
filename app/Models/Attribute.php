<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property int $product_id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @method static Builder|Attribute newModelQuery()
 * @method static Builder|Attribute newQuery()
 * @method static Builder|Attribute query()
 * @method static Builder|Attribute whereCreatedAt($value)
 * @method static Builder|Attribute whereId($value)
 * @method static Builder|Attribute whereKey($value)
 * @method static Builder|Attribute whereProductId($value)
 * @method static Builder|Attribute whereUpdatedAt($value)
 * @method static Builder|Attribute whereValue($value)
 * @mixin Eloquent
 */
class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'key',
        'value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
