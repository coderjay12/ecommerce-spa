<?php

namespace App\Services;

use App\Attribute;
use App\ProductAttribute;

class ProductVariant
{
    protected $attribute;
    protected $productAttribute;

    public function __construct(Attribute $attribute, ProductAttribute $productAttribute)
    {
        $this->attribute = $attribute;
        $this->productAttribute = $productAttribute;
    }

    public function add($productId)
    {
        $attributes = $this->attribute->whereProductId($productId)->get()->pluck('name', 'id')->toArray();
        $productAttributes = $this->productAttribute->whereIn('attribute_id', array_keys($attributes))->get()->groupBy('attribute_id')->toArray();

        dump(count($productAttributes));
        foreach($productAttributes as $productAttribute) {
            dump($productAttribute);
        }
//        foreach($productAttributes as $)
        dd(1212);

    }
}