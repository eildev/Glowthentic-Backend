<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\ImageOptimizer\Optimizers\Pngquant;



class ImageOptimizerService
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new GdDriver());
    }

    public function resizeAndOptimize($imageFile, $destinationPath, $quality = 85)
    {
        // ডিরেক্টরি তৈরি করা
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        // ইউনিক ইমেজ নাম তৈরি
        $imageName = rand() . '.' . $imageFile->extension();
        $imagePath = $destinationPath . '/' . $imageName;

        // রিসাইজ ছাড়া ইমেজ সেভ করা
        $this->imageManager->read($imageFile)
            ->toJpeg($quality, true) // প্রোগ্রেসিভ JPEG, কোয়ালিটি ৮৫
            ->save($imagePath);

        // Spatie দিয়ে অপটিমাইজেশন
        $optimizer = (new OptimizerChain())
            ->addOptimizer(new Jpegoptim([
                '--max=90', // সর্বোচ্চ কোয়ালিটি ৯০
                '--strip-all',
                '--all-progressive',
            ]))
            ->addOptimizer(new Pngquant([
                '--quality=90',
                '--force',
            ]))
            ->optimize($imagePath);

        return $imageName; // ডাটাবেসে সেভ করার জন্য নাম রিটার্ন
    }
}
