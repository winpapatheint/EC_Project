<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ShowProductController extends Controller
{
    public function ShowProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
            'mainSearch' => 'string|nullable',
            'sHistory' => 'string|nullable',
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
        $mainSearch = $validated['mainSearch'] ?? null;
        $sHistory = $validated['sHistory'] ?? null;
        $search = $validated['search'] ?? null;
        $categories = $validated['categories'] ?? [];
        $price = $validated['price'] ?? null;
        $rating = $validated['rating'] ?? [];
        $discount = $validated['discount'] ?? [];

        $limit = 10; // set the number of products per page

        $searchHistory = Session::get('searchHistory', []);
        if ($mainSearch != null && !in_array($mainSearch, $searchHistory)) {
            array_unshift($searchHistory, $mainSearch);
            $searchHistory = array_slice($searchHistory, 0, 10);
            Session::put('searchHistory', $searchHistory);
        }
        // Session::forget('searchHistory');
        
        $query = Product::query();

        if ($mainSearch != null) {
            $query->where(function ($query) use ($mainSearch) {
                $query->where('product_name', 'like', '%' . $mainSearch . '%')
                      ->orWhere('product_code', 'like', '%' . $mainSearch . '%')
                      ->orWhere('product_tags', 'like', '%' . $mainSearch . '%');
            })
            ->orWhereHas('Category', function ($query) use ($mainSearch) {
                $query->where('category_name', 'like', '%' . $mainSearch . '%');
            });
        }
        else {
            if (!empty($sHistory)) {
                $query->where(function ($query) use ($sHistory) {
                    $query->where('product_name', 'like', '%' . $sHistory . '%')
                          ->orWhere('product_code', 'like', '%' . $sHistory . '%')
                          ->orWhere('product_tags', 'like', '%' . $sHistory . '%');
                })
                ->orWhereHas('Category', function ($query) use ($sHistory) {
                    $query->where('category_name', 'like', '%' . $sHistory . '%');
                });
            }

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
        }

        // Fetch paginated results
        $products = $query->paginate($limit, ['*'], 'page', $page);
        $ttl = $products->total();
        $ttlpage = (ceil($ttl / $limit));

        // Retrieve reviews
        $reviews = Review::all();

        // Total count of products
        $allProduct = Product::count();

        // Total number of pages
        // $totalPage = ceil($allProduct / $limit);

        // $productTags = Product::select('product_tags')->distinct()->get();
        // $tags = [];

        // foreach ($productTags as $productTag) {
        //     $tags = array_merge($tags, explode(',', $productTag->product_tags));
        // }

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

        $mostDiscountPercentages = Product::select('discount_percent')
                                            ->distinct()
                                            ->orderBy('discount_percent', 'desc')
                                            ->take(3)
                                            ->pluck('discount_percent');
        
        $productsGroupedByDiscount = [];

        foreach ($mostDiscountPercentages as $discountPercent) {
            $productsGroupedByDiscount[$discountPercent] = Product::where('discount_percent', $discountPercent)->pluck('id')
            ->toArray();
        }

        return view('front-end.products', compact('products', 'reviews', 'ttl', 'ttlpage', 'page', 'categoryWithProductCount', 'ratingWithProductCount', 'discountWithProductCount'
        , 'search', 'categories', 'price', 'rating', 'discount', 'sort', 'searchHistory', 'sHistory', 'productsGroupedByDiscount'));
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
        return view('front-end.product-left-thumbnail',compact('product','reviews', 'productOrdered', 'topProducts', 'id'));
    }

    public function ShowDiscountProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'ids' => 'array',
            'ids.*' => 'integer|distinct|min:1',
            'topic' => 'string|nullable',
        ]);

        $page = $validated['page'] ?? 1;
        $ids = $validated['ids'] ?? [];
        $topic = $validated['topic'] ?? null;

        $limit = 10; // set the number of products per page
        if($ids)
        {
            $products = Product::whereIn('id', $ids)->get();
        }

        if($topic == 'value-of-the-day')
        {
            $products = Product::leftjoin('orders', 'products.id', '=', 'orders.product_id')
                        ->whereDate('orders.created_at', Carbon::today())->get();
        }

        if($topic == 'top-50-offers')
        {
            $products = Product::orderBy('discount_percent', 'desc')->take(50)->get();
        }

        if($topic == 'new-arrivals')
        {
            $products = Product::whereDate('created_at', Carbon::today())->get();
        }

        $reviews = Review::all();
        $allProduct = Product::count();
        $totalPage = ceil($allProduct / $limit);

        return view('front-end.discount-products',compact('products', 'reviews', 'totalPage', 'page'));
    }
}