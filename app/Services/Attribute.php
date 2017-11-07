<?php

namespace App\Services;

use App\Attribute as AttributeModel;

class Attribute
{
    protected $attribute;
    protected $productAttribute;

    public function __construct(AttributeModel $attribute, ProductAttribute $productAttribute)
    {
        $this->attribute = $attribute;
        $this->productAttribute = $productAttribute;
    }

    public function add($attributes)
    {
        $productId = $attributes['product_id'];
        unset($attributes['product_id']);

        foreach ($attributes as $attribute => $attributeValues) {
            $newAttribute = $this->attribute->create(['name' => $attribute, 'product_id' => $productId]);
            foreach (explode(',', $attributeValues) as $attributeValue) {
                $this->productAttribute->add($productId, $newAttribute->id, $attributeValue);            }
        }
    }
}