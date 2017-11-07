<?php

namespace App\Services;
use App\Product as ProductModel;


class Product
{
    protected  $productModel;
    protected  $productAttribute;
    protected  $attribute;
    protected  $productPrice;
    protected  $productVariant;

    public function __construct(
        ProductModel $productModel,
        Attribute $attribute,
        ProductAttribute $productAttribute,
        ProductPrice $productPrice,
        ProductVariant $productVariant
    )
    {
        $this->productModel = $productModel;
        $this->productAttribute = $productAttribute;
        $this->attribute = $attribute;
        $this->productPrice = $productPrice;
        $this->productVariant = $productVariant;
    }

    public function create(array $productDetails)
    {
        $details = $productDetails;
        if($this->productModel->whereSlug($productDetails['slug'])->get()->count()) {
            $latestProductId = $this->productModel->latest()->first()->id;
            $details['slug'] = $productDetails['slug'] . '-' . ($latestProductId + 1);
        }
        $product = $this->productModel->create($details);

//        dd($product->id);

        if ($attribute = $details['attributes']) {
            $this->attribute->add($attribute + ['product_id' => $product->id]);
        }

        $this->productVariant->add($product->id);
//        $this->addVariant($product);
    }

    public function addPrice()
    {

    }
}
