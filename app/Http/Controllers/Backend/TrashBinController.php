<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Concern;
use App\Models\ContactUs;
use App\Models\Coupon;
use App\Models\DeliveryOrder;
use App\Models\Features;
use App\Models\HomeBanner;
use App\Models\OfferBanner;
use App\Models\Order;
use App\Models\PopupMessage;
use App\Models\Product;
use App\Models\Report;
use App\Models\ReviewRating;
use App\Models\SizeModel;
use App\Models\Subscribe;
use App\Models\TagName;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserTracker;
use App\Models\Variant;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrashBinController extends Controller
{
    public function index()
    {
        // List of models to check for trashed data
        $models = [
            'Report' => Report::class,
            'Category' => Category::class,
            'Product' => Product::class,
            'Feature' => Features::class,
            'Concern' => Concern::class,
            'TagName' => TagName::class,
            'BlogCategories' => BlogCategory::class,
            'BlogComments' => BlogComment::class,
            'BlogPost' => BlogPost::class,
            'Brand' => Brand::class,
            'ContactUs' => ContactUs::class,
            'Coupon' => Coupon::class,
            'DeliveryOrder' => DeliveryOrder::class,
            'HomeBanner' => HomeBanner::class,
            'OfferBanner' => OfferBanner::class,
            'Order' => Order::class,
            'PopupMessage' => PopupMessage::class,
            'ReviewRating' => ReviewRating::class,
            'SizeModel' => SizeModel::class,
            'Subscribe' => Subscribe::class,
            'User' => User::class,
            'UserTracker' => UserTracker::class,
            'Variant' => Variant::class,
            'WishList' => WishList::class,
            'UserDetails' => UserDetails::class,
        ];

        // Collect trashed data for each model
        $trashedData = [];
        foreach ($models as $modelName => $modelClass) {
            $trashedData[$modelName] = $modelClass::onlyTrashed()->get();
        }

        return view('backend.trash.index', compact('trashedData'));
    }

    public function restore(Request $request, $model, $id)
    {
        try {
            // Validate model name
            $modelClass = $this->getModelClass($model);
            if (!$modelClass) {
                return redirect()->route('trash.index')->with('error', 'Invalid model specified.');
            }

            // Find and restore the record
            $record = $modelClass::onlyTrashed()->findOrFail($id);
            $record->restore();

            return redirect()->route('trash.index')->with('success', "{$model} restored successfully.");
        } catch (\Exception $e) {
            Log::error("Error restoring {$model}: " . $e->getMessage());
            return redirect()->route('trash.index')->with('error', "Failed to restore {$model}: " . $e->getMessage());
        }
    }

    public function forceDelete(Request $request, $model, $id)
    {
        try {
            // Validate model name
            $modelClass = $this->getModelClass($model);
            if (!$modelClass) {
                return redirect()->route('trash.index')->with('error', 'Invalid model specified.');
            }

            // Find and permanently delete the record
            $record = $modelClass::onlyTrashed()->findOrFail($id);

            // Delete associated image if it exists
            if (isset($record->attachment) && $record->attachment && file_exists(public_path($record->attachment))) {
                unlink(public_path($record->attachment));
            } elseif (isset($record->image) && $record->image && file_exists(public_path($record->image))) {
                unlink(public_path($record->image));
            }

            $record->forceDelete();

            return redirect()->route('trash.index')->with('success', "{$model} permanently deleted.");
        } catch (\Exception $e) {
            Log::error("Error permanently deleting {$model}: " . $e->getMessage());
            return redirect()->route('trash.index')->with('error', "Failed to permanently delete {$model}: " . $e->getMessage());
        }
    }

    protected function getModelClass($model)
    {
        $models = [
            'Report' => Report::class,
            'Category' => Category::class,
            'Product' => Product::class,
            'Feature' => Features::class,
            'Concern' => Concern::class,
            'TagName' => TagName::class,
            'BlogCategories' => BlogCategory::class,
            'BlogComments' => BlogComment::class,
            'BlogPost' => BlogPost::class,
            'Brand' => Brand::class,
            'ContactUs' => ContactUs::class,
            'Coupon' => Coupon::class,
            'DeliveryOrder' => DeliveryOrder::class,
            'HomeBanner' => HomeBanner::class,
            'OfferBanner' => OfferBanner::class,
            'Order' => Order::class,
            'PopupMessage' => PopupMessage::class,
            'ReviewRating' => ReviewRating::class,
            'SizeModel' => SizeModel::class,
            'Subscribe' => Subscribe::class,
            'User' => User::class,
            'UserTracker' => UserTracker::class,
            'Variant' => Variant::class,
            'WishList' => WishList::class,
            'UserDetails' => UserDetails::class,
        ];

        return $models[$model] ?? null;
    }
}
