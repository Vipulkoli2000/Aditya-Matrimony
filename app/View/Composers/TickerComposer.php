<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\TickerMessage;
use Illuminate\Support\Facades\Schema;

class TickerComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Avoid errors if migration not yet run
        if (!Schema::hasTable('ticker_messages')) {
            $view->with('tickerMessages', []);
            return;
        }

        // Fetch single message; enforcing single-row with id=1
        $message = TickerMessage::query()->where('id', 1)->value('message');

        // Provide as array to keep compatibility with existing blade loop
        $tickerMessages = $message ? [$message] : [];

        $view->with('tickerMessages', $tickerMessages);
    }
}
