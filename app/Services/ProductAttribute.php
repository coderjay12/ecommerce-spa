<?php

 namespace App\Services;

 use App\ProductAttribute as ProductAttributeModel;

 class ProductAttribute
 {
     protected $productAttributeModel;

     public function __construct(ProductAttributeModel $productAttributeModel)
     {
         $this->productAttributeModel = $productAttributeModel;
     }

     public function add($productId, $attributeId, $value)
     {
         $this->productAttributeModel->create([
             'attribute_id' => $attributeId,
             'product_id' => $productId,
             'value' => $value
         ]);
     }
 }