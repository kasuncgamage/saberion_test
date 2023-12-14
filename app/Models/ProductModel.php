<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;

    use HasFactory,SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    // const CREATED_AT  = 'created_at';
    // const UPDATED_AT = 'updated_at';
    // const DELETED_AT = 'deleted_at';

    protected $fillable =
    [
        'code',
        'category',
        'name',
        'description',
        'selling_price',
        'special_price',
        'status',
        'is_delivery_available',
        'image_path',
        'updated_at',
        'deleted_at',
    ];

    public function ProAttributes()
    {
        return $this->hasMany(ProductAttributeModel::class, 'product_id', 'id');
    }
}
