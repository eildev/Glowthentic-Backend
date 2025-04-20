<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }
    function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    function gallary()
    {
        return $this->hasMany(ProductGallery::class);
    }
    function varient()
    {
        return $this->hasMany(Variant::class, 'product_id', 'id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class)->with('variantImage');
    }


    public function productStock()
    {
        return $this->hasMany(ProductStock::class, 'product_id', 'id');
    }

    public function comboproduct()
    {
        return $this->hasMany(ComboProduct::class, 'combo_id', 'id');
    }

    public function promotionproduct()
    {
        return $this->hasMany(ProductPromotion::class, 'product_id', 'id');
    }

    public function product_tags()
    {
        return $this->hasMany(Product_Tags::class, 'product_id', 'id');
    }


    public function variantImage()
    {
        return $this->hasMany(VariantImageGallery::class, 'product_id', 'id');
    }

    public function productdetails()
    {
        return $this->hasOne(ProductDetails::class, 'product_id', 'id');
    }

    public function product_attribute(){
        return $this->hasMany(AttributeManage::class,'product_id','id');
    }

    public function productVarinatPromotion(){
        return $this->hasMany(VariantPromotion::class,'product_id','id');
    }

    public function productFeatures(){
        return $this->hasMany(ProductFeature::class);
    }
}
