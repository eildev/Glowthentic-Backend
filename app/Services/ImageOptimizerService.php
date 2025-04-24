<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\ImageOptimizer\Optimizers\Cwebp;
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
        // Ensure destination directory exists
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        // Generate a random image name
        $imageName = rand(000000, 999999);
        $extension = strtolower($imageFile->extension());

        // Determine output format: WebP for non-GIFs, original extension for GIFs
        $outputExtension = ($extension !== 'gif') ? 'webp' : $extension;
        $imageNameWithExtension = $imageName . '.' . $outputExtension;
        $imagePath = $destinationPath . '/' . $imageNameWithExtension;

        // Read and process the image
        $image = $this->imageManager->read($imageFile);

        // Convert to WebP for non-GIFs, otherwise use original format
        if ($extension !== 'gif') {
            $image->toWebp($quality)->save($imagePath);
        } else {
            $image->toJpeg($quality, true)->save($imagePath); // Fallback for GIFs or other formats
        }

        // Optimize the image
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
            ->addOptimizer(new Cwebp([ // Add WebP optimizer
                '--lossy',
                '-q 90',
            ]))
            ->optimize($imagePath);

        return $imageNameWithExtension;
    }

    // public function resizeAndOptimize($imageFile, $destinationPath, $quality = 85)
    // {


    //     if (!File::exists($destinationPath)) {
    //         File::makeDirectory($destinationPath, 0755, true, true);
    //     }


    //     $imageName = rand(000000, 999999) . '.' . $imageFile->extension();
    //     $imagePath = $destinationPath . '/' . $imageName;


    //     $this->imageManager->read($imageFile)
    //         ->toJpeg($quality, true)
    //         ->save($imagePath);


    //     $optimizer = (new OptimizerChain())
    //         ->addOptimizer(new Jpegoptim([
    //             '--max=90',
    //             '--strip-all',
    //             '--all-progressive',
    //         ]))
    //         ->addOptimizer(new Pngquant([
    //             '--quality=90',
    //             '--force',
    //         ]))
    //         ->optimize($imagePath);

    //     return $imageName;
    // }
}
