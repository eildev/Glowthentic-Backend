<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Spatie\ImageOptimizer\OptimizerChainFactory;



class ImageOptimizerService
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new GdDriver());
    }

    public function resizeAndOptimize($imageFile, $destinationPath, $width = 800, $height = 600, $quality = 100)
    {

        $width = (int) $width;
        $height = (int) $height;

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        // Generate unique image name
        $imageName = rand() . '.' . $imageFile->extension();
        $imagePath = $destinationPath . '/' . $imageName;

        // Resize and save image using Intervention Image v3
        $this->imageManager->read($imageFile)
            ->scale($width, $height)
            ->save($imagePath, $quality);

        // Optimize the resized image using Spatie
        $optimizer = OptimizerChainFactory::create();
        $optimizer->optimize($imagePath);

        return $imageName; // Return image name to save in the database
    }
}
