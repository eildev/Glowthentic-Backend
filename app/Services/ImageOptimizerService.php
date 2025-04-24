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


        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }


        $imageName = rand(000000,999999) . '.' . $imageFile->extension();
        $imagePath = $destinationPath . '/' . $imageName;


        $this->imageManager->read($imageFile)
            ->toJpeg($quality, true)
            ->save($imagePath);


        $optimizer = (new OptimizerChain())
            ->addOptimizer(new Jpegoptim([
                '--max=90',
                '--strip-all',
                '--all-progressive',
            ]))
            ->addOptimizer(new Pngquant([
                '--quality=90',
                '--force',
            ]))
            ->optimize($imagePath);

        return $imageName;
    }
    // public function resizeAndOptimize($imageFile, $destinationPath, $width = 800, $height = 600, $quality = 100)
    // {

    //     $width = (int) $width;
    //     $height = (int) $height;

    //     if (!File::exists($destinationPath)) {
    //         File::makeDirectory($destinationPath, 0755, true, true);
    //     }

    //     // Generate unique image name
    //     $imageName = rand() . '.' . $imageFile->extension();
    //     $imagePath = $destinationPath . '/' . $imageName;

    //     // Resize and save image using Intervention Image v3
    //     $this->imageManager->read($imageFile)
    //         ->scale($width, $height)
    //         ->save($imagePath, $quality);

    //     // Optimize the resized image using Spatie
    //     $optimizer = OptimizerChainFactory::create();
    //     $optimizer->optimize($imagePath);

    //     return $imageName; // Return image name to save in the database
    // }
}
