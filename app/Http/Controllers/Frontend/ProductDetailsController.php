<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\SubSubcategory;
use App\Models\Variant;
class ProductDetailsController extends Controller
{
    public function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        return view('frontend/e-com/product_details', compact('product'));
    }
    public function browsSubcategory($subcategoryslug){
        $category = Category::where('slug', $subcategoryslug)->first();
        $subcategories = Subcategory::where('categoryId', $category->id)
        ->has('products')
            ->get();
        return view('frontend.brows-sub-category', compact('subcategories','category'));
    }
    public function categoryWiseProduct($categoryslug){
        $category = Category::where('slug', $categoryslug)->first();
        return view('frontend/e-com/category-wise-product', compact('category'));
    }
    public function SearchbyProduct(Request $request){
        // $searchTag = $request->search;
        // $products = Product::where('product_name', 'like', '%'.$searchTag.'%')
        //                     ->orWhere('short_desc', 'like', '%'.$searchTag.'%')
        //                     ->orWhere('tags', 'like', '%'.$searchTag.'%')

        //                     ->paginate(12);
        // return view('frontend/e-com/product-search', compact('products','searchTag'));
         $searchTerm = $request->search;
         $searchTag = $request->search;

        // Search by product name
        // $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')->orWhere('tags', 'LIKE', '%' . $searchTerm . '%')->with('category', 'subcategory')->paginate(12);
        $products = Product::where(function ($query) use ($searchTerm) {
                $query->where('product_name', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('tags', 'LIKE', '%' . $searchTerm . '%');
            })
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->with('category', 'subcategory')
            ->paginate(12);
        if ($products->isNotEmpty()) {
            return view('frontend/e-com/product-search', compact('products','searchTag'));
        }

        // Search by category name
        $categories = Category::where('status',1)->where('categoryName', 'LIKE', '%' . $searchTerm . '%')->get();

        if ($categories->isNotEmpty()) {
            $categoryIds = $categories->pluck('id');
            $products = Product::whereIn('category_id', $categoryIds)->with('category', 'subcategory')->paginate(12);;

            if ($products->isNotEmpty()) {
               return view('frontend/e-com/product-search', compact('products','searchTag'));
            }
        }

        // Search by subcategory name
        $subcategories = Subcategory::where('subcategoryName', 'LIKE', '%' . $searchTerm . '%')->get();

        if ($subcategories->isNotEmpty()) {
            $subcategoryIds = $subcategories->pluck('id');
            $products = Product::whereIn('subcategory_id', $subcategoryIds)->with('category', 'subcategory')->paginate(12);;

            if ($products->isNotEmpty()) {
                return view('frontend/e-com/product-search', compact('products','searchTag'));
            }
        }
         return view('frontend/e-com/product-search', compact('products','searchTag'));
    }
    public function filterbyBrand(Request $request){

        $brandId = $request->input('brandName');
        $searchTag = '';
        $products = Product::when($brandId, function ($query) use ($brandId) {
            $query->whereIn('brand_id', $brandId);
        })->paginate(12);
        return view('frontend/e-com/product-search', compact('products','searchTag','brandId'));
    }
    public function filterbyCategory(Request $request){

        $categoryId = $request->input('categoryId');
        $searchTag = '';
        $products = Product::when($categoryId, function ($query) use ($categoryId) {
            $query->whereIn('category_id', $categoryId);
        })->paginate(12);
        return view('frontend/e-com/product-search', compact('products','searchTag','categoryId'));
    }
    public function subcategoryWiseProduct($subcategoryslug){
        $subcategory = Subcategory::where('slug', $subcategoryslug)->first();
        return view('frontend/e-com/subcategory-wise-product', compact('subcategory'));
    }
    public function subSubcategoryWiseProduct($subsubcategoryslug){
        $subSubcategory = SubSubcategory::where('slug', $subsubcategoryslug)->first();
        return view('frontend.e-com.sub-subcategory-wise-product', compact('subSubcategory'));
    }
    public function brandWiseProduct($brandslug){
        $brand = Brand::where('slug', $brandslug)->first();
        return view('frontend/e-com/brand-wise-product', compact('brand'));
    }
    public function globalSearch($value){
        // $products = Product::where('product_name', 'LIKE', '%'.$value.'%')->get();
        $products = Product::where('product_name', 'LIKE', '%' . $value . '%')->orWhere('tags', 'LIKE', '%' . $value . '%')->with('category', 'subcategory')->get();
        return response()->json([
            'products' => $products,
        ]);
    }
    public function allFeatureProduct(){
        $features = Product::where('status', 1)->orderBy('id', 'ASC')->paginate(12);
        return view('frontend/e-com/all-feature-product', compact('features'));
    }
    public function productFilterByFeatureCategoryBrand(Request $request){
        // dd($request->all());
        $featureAllValue = $request->featureAllValue ?? '';
        // dd($featureAllValue);
        $categoryAllValue = $request->categoryAllValue ?? [];
        $brandAllValue = $request->brandAllValue ?? [];
        $filterProducts = Product::where('product_feature', 'LIKE','%'.$featureAllValue.'%')->get();
        // $filterProducts = Product::where(function ($query) use ($featureAllValue) {
        //     $query->orwhereIn('product_feature', $featureAllValue)
        //           ->orWhereNull('product_feature');
        // })
        // ->where(function ($query) use ($categoryAllValue) {
        //     $query->orwhereIn('category_id', $categoryAllValue)
        //           ->orWhereNull('category_id');
        // })
        // ->where(function ($query) use ($brandAllValue) {
        //     $query->orwhereIn('brand_id', $brandAllValue)
        //           ->orWhereNull('brand_id');
        // })->get();
        // dd($filterProducts);
        if($filterProducts){
            return response()->json([
            'status' => 200,
            'filterProducts' => $filterProducts
            ]);
        }
        else{
            return response()->json([
            'status' => 500
            ]);
        }
    }
    public function productFilterByFeatureCategoryBrandFindVariant($id){
        $variant = Variant::where('product_id',$id)->first();
        if($variant){
            return response()->json([
            'status' => 200,
            'variant' => $variant
            ]);
        }
        else{
            return response()->json([
            'status' => 500
            ]);
        }
    }
}





