<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ShowProductController extends Controller
{
    public function ShowProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'search' => 'string|nullable',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|min:1',
            'price' => 'string|nullable',
            'rating' => 'array',
            'rating.*' => 'integer|distinct|min:1',
            'discount' => 'array',
            'discount.*' => 'integer|distinct|min:1',
        ]);

        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];
        

        $limit = 10; // set the number of products per page

        $query = Product::query();

        if (!empty($search)) {
            $query->where('product_name', 'like', '%' . $search . '%');
        }

        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }

        if (!empty($price)) {
            $priceRange = explode(';', $price);

            if (count($priceRange) == 2) {
                $minPrice = (float)$priceRange[0];
                $maxPrice = (float)$priceRange[1];

                $query->whereRaw('CAST(selling_price AS DECIMAL) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
            }
        }

        if (!empty($rating)) {
            $averageRated = Review::select('product_id',
                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
            )
            ->groupBy('product_id')
            ->get();
            $matchedProductIds = [];
            foreach ($averageRated as $rated) {
                if (in_array($rated->average_rating, $rating)) {
                    $matchedProductIds[] = $rated->product_id;
                }
            }
            $query->whereIn('id', $matchedProductIds);
        }

        if (!empty($discount)) {
            if (in_array("1", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) <= 5');
            }
            if (in_array("2", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) BETWEEN 5 AND 10');
            }
            if (in_array("3", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) BETWEEN 10 AND 15');
            }
            if (in_array("4", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) BETWEEN 15 AND 25');
            }
            if (in_array("5", $discount)) {
                $query->whereRaw('CAST(discount_percent AS DECIMAL) > 25');
            }
        }
        
        // Apply sorting
        switch ($sort) {
            case 1:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC');
                break;
            case 2:
                $query->orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC');
                break;
            case 3:
                $query->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                    ->groupBy('products.id')
                    ->orderBy('review_count', 'desc');
                break;
            case 4:
                $query->orderBy('product_name', 'ASC');
                break;
            case 5:
                $query->orderBy('product_name', 'DESC');
                break;
            case 6:
                $query->orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC');
                break;
            default:
                // No sorting applied
                break;
        }

        // Fetch paginated results
        $products = $query->paginate($limit, ['*'], 'page', $page);

        // Retrieve reviews
        $reviews = Review::all();

        // Total count of products
        $allProduct = Product::count();

        // Total number of pages
        $totalPage = ceil($allProduct / $limit);

        // Fetch product count
        $categoryWithProductCount = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                                            ->select('categories.*', DB::raw('COUNT(products.category_id) as product_count'))
                                            ->where('products.status', '=', '1')
                                            ->groupBy('categories.id')
                                            ->get();

        $ratingWithProductCount = Review::select(
                                                DB::raw('FLOOR(AVG(stars_rated)) AS `average_rating`')
                                            )
                                            ->groupBy('product_id')
                                            ->get()
                                            ->groupBy('average_rating')
                                            ->map(function ($grouped) {
                                                return $grouped->count();
                                            });

        $discountWithProductCount = Product::selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) < 5 THEN 1 END) as group_1_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) BETWEEN 5 AND 10 THEN 1 END) as group_2_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) BETWEEN 10 AND 15 THEN 1 END) as group_3_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) BETWEEN 15 AND 25 THEN 1 END) as group_4_count')
                                            ->selectRaw('COUNT(CASE WHEN CAST(discount_percent AS DECIMAL) > 25 THEN 1 END) as group_5_count')
                                            ->where('status', '=', '1')
                                            ->first();
        

        return view('front-end.products', compact('products', 'reviews', 'totalPage', 'page', 'categoryWithProductCount', 'ratingWithProductCount', 'discountWithProductCount'
    , 'search', 'categories', 'price', 'rating', 'discount', 'sort'));
    }

    public function ShowProductleftThumbnail($id)
    {
        $product = Product::find($id);
        $reviews = Review::all();
        $productOrdered = Order::where('product_id', $id)->get();
        $topProducts = Order::select('product_id', DB::raw('COUNT(*) as frequency'))
        ->groupBy('product_id')
        ->orderByDesc('frequency')
        ->limit(3)
        ->get();
        return view('front-end.product-left-thumbnail',compact('product','reviews', 'productOrdered', 'topProducts'));
    }
}
