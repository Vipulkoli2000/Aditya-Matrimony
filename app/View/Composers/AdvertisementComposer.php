<?php

namespace App\View\Composers;

use App\Models\Advertisement;
use Illuminate\View\View;

class AdvertisementComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $advertisement = Advertisement::getOrCreate();
        $view->with('advertisement', $advertisement);
    }
}
