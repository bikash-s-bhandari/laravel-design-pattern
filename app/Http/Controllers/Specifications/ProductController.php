<?php

namespace App\Http\Controllers\Specifications;

use App\Http\Controllers\Controller;
use App\Specifications\AndSpecification;
use App\Specifications\InStockSpecification;
use App\Specifications\PriceSpecification;
use App\Specifications\CategorySpecification;
use App\Specifications\FeaturedSpecification;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Sample products
    private function getProducts(): array
    {
        return [
            [
                'id'       => 1,
                'name'     => 'Samsung TV',
                'price'    => 45000,
                'stock'    => 10,
                'category' => 'electronics',
                'featured' => true,
            ],
            [
                'id'       => 2,
                'name'     => 'Nike Shoes',
                'price'    => 5000,
                'stock'    => 0,       // ❌ Out of stock
                'category' => 'fashion',
                'featured' => false,
            ],
            [
                'id'       => 3,
                'name'     => 'iPhone 15',
                'price'    => 150000,
                'stock'    => 5,
                'category' => 'electronics',
                'featured' => true,
            ],
            [
                'id'       => 4,
                'name'     => 'Sofa Set',
                'price'    => 25000,
                'stock'    => 3,
                'category' => 'furniture',
                'featured' => false,
            ],
            [
                'id'       => 5,
                'name'     => 'Adidas T-Shirt',
                'price'    => 2000,
                'stock'    => 20,
                'category' => 'fashion',
                'featured' => true,
            ],
        ];
    }

    public function index(Request $request)
    {
        $products = $this->getProducts();

        // ✅ Always apply InStock specification
        $spec = new InStockSpecification();

        // ✅ Category filter is applied?
        if ($request->filled('category')) {
            $spec = new AndSpecification(
                $spec,
                new CategorySpecification($request->category)
            );
        }

        // ✅ Price range is applied?
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $spec = new AndSpecification(
                $spec,
                new PriceSpecification(
                    $request->min_price,
                    $request->max_price
                )
            );
        }

        // ✅ Featured filter is applied?
        if ($request->boolean('featured')) {
            $spec = new AndSpecification(
                $spec,
                new FeaturedSpecification()
            );
        }

        // ✅ Apply specification to filter products
        $filtered = array_values(
            array_filter(
                $products,
                fn($product) => $spec->isSatisfiedBy($product)
            )
        );

        return response()->json([
            'status'  => 'success',
            'total'   => count($filtered),
            'filters' => [
                'category'  => $request->category ?? 'all',
                'min_price' => $request->min_price ?? 0,
                'max_price' => $request->max_price ?? '∞',
                'featured'  => $request->boolean('featured'),
            ],
            'products' => $filtered,
        ]);
    }
}
