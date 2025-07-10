<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_1',
        'advertisement_2',
        'carousel_1',
        'carousel_2',
        'carousel_3',
        'carousel_4',
    ];

    /**
     * Get the first advertisement record or create a new one
     */
    public static function getOrCreate()
    {
        return self::firstOrCreate([]);
    }

    /**
     * Get advertisement 1 image path
     */
    public function getAdvertisement1UrlAttribute()
    {
        if ($this->advertisement_1 && $this->hasAdvertisement1()) {
            return $this->getAssetUrl('storage/advertisements/' . $this->advertisement_1);
        }
        return $this->getAssetUrl('assets/images/ad-1.jpeg');
    }

    /**
     * Get advertisement 2 image path
     */
    public function getAdvertisement2UrlAttribute()
    {
        if ($this->advertisement_2 && $this->hasAdvertisement2()) {
            return $this->getAssetUrl('storage/advertisements/' . $this->advertisement_2);
        }
        return $this->getAssetUrl('assets/images/ad-2.jpeg');
    }

    /**
     * Get asset URL with proper handling for different environments
     */
    private function getAssetUrl($path)
    {
        $url = asset($path);
        
        // If we're in development and the URL contains the production domain,
        // replace it with localhost for local development
        if (app()->environment('development') && str_contains($url, 'marathavivahmandaldombivli.com')) {
            $url = str_replace('http://marathavivahmandaldombivli.com', 'http://localhost:8000', $url);
        }
        
        return $url;
    }

    /**
     * Check if advertisement 1 exists
     */
    public function hasAdvertisement1()
    {
        if (empty($this->advertisement_1)) {
            return false;
        }
        $storagePath = storage_path('app/public/advertisements/' . $this->advertisement_1);
        $publicPath = public_path('storage/advertisements/' . $this->advertisement_1);
        return file_exists($storagePath) || file_exists($publicPath);
    }

    /**
     * Check if advertisement 2 exists
     */
    public function hasAdvertisement2()
    {
        if (empty($this->advertisement_2)) {
            return false;
        }
        $storagePath = storage_path('app/public/advertisements/' . $this->advertisement_2);
        $publicPath = public_path('storage/advertisements/' . $this->advertisement_2);
        return file_exists($storagePath) || file_exists($publicPath);
    }

    /**
     * Get the full file path for advertisement 1
     */
    public function getAdvertisement1PathAttribute()
    {
        if ($this->advertisement_1) {
            return storage_path('app/public/advertisements/' . $this->advertisement_1);
        }
        return null;
    }

    /**
     * Get the full file path for advertisement 2
     */
    public function getAdvertisement2PathAttribute()
    {
        if ($this->advertisement_2) {
            return storage_path('app/public/advertisements/' . $this->advertisement_2);
        }
        return null;
    }

    public function getCarousel1UrlAttribute()
    {
        if ($this->carousel_1 && $this->hasCarousel1()) {
            return $this->getAssetUrl('storage/advertisements/' . $this->carousel_1);
        }
        return $this->getAssetUrl('assets/images/carousel-1.jpeg');
    }

    public function hasCarousel1()
    {
        if (empty($this->carousel_1)) {
            return false;
        }
        $storagePath = storage_path('app/public/advertisements/' . $this->carousel_1);
        $publicPath = public_path('storage/advertisements/' . $this->carousel_1);
        return file_exists($storagePath) || file_exists($publicPath);
    }

    public function getCarousel2UrlAttribute()
    {
        if ($this->carousel_2 && $this->hasCarousel2()) {
            return $this->getAssetUrl('storage/advertisements/' . $this->carousel_2);
        }
        return $this->getAssetUrl('assets/images/carousel-2.jpeg');
    }

    public function hasCarousel2()
    {
        if (empty($this->carousel_2)) {
            return false;
        }
        $storagePath = storage_path('app/public/advertisements/' . $this->carousel_2);
        $publicPath = public_path('storage/advertisements/' . $this->carousel_2);
        return file_exists($storagePath) || file_exists($publicPath);
    }

    public function getCarousel3UrlAttribute()
    {
        if ($this->carousel_3 && $this->hasCarousel3()) {
            return $this->getAssetUrl('storage/advertisements/' . $this->carousel_3);
        }
        return $this->getAssetUrl('assets/images/carousel-3.jpeg');
    }

    public function hasCarousel3()
    {
        if (empty($this->carousel_3)) {
            return false;
        }
        $storagePath = storage_path('app/public/advertisements/' . $this->carousel_3);
        $publicPath = public_path('storage/advertisements/' . $this->carousel_3);
        return file_exists($storagePath) || file_exists($publicPath);
    }

    public function getCarousel4UrlAttribute()
    {
        if ($this->carousel_4 && $this->hasCarousel4()) {
            return $this->getAssetUrl('storage/advertisements/' . $this->carousel_4);
        }
        return $this->getAssetUrl('assets/images/carousel-4.jpeg');
    }

    public function hasCarousel4()
    {
        if (empty($this->carousel_4)) {
            return false;
        }
        $storagePath = storage_path('app/public/advertisements/' . $this->carousel_4);
        $publicPath = public_path('storage/advertisements/' . $this->carousel_4);
        return file_exists($storagePath) || file_exists($publicPath);
    }

    public function getCarousel1PathAttribute()
    {
        if ($this->carousel_1) {
            return storage_path('app/public/advertisements/' . $this->carousel_1);
        }
        return null;
    }

    public function getCarousel2PathAttribute()
    {
        if ($this->carousel_2) {
            return storage_path('app/public/advertisements/' . $this->carousel_2);
        }
        return null;
    }

    public function getCarousel3PathAttribute()
    {
        if ($this->carousel_3) {
            return storage_path('app/public/advertisements/' . $this->carousel_3);
        }
        return null;
    }

    public function getCarousel4PathAttribute()
    {
        if ($this->carousel_4) {
            return storage_path('app/public/advertisements/' . $this->carousel_4);
        }
        return null;
    }
}
