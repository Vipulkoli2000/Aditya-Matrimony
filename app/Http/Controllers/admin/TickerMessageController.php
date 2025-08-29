<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TickerMessage;
use Illuminate\Http\Request;

class TickerMessageController extends Controller
{
    /**
     * Show the single-field edit form.
     */
    public function edit()
    {
        $message = TickerMessage::query()->find(1);
        return view('admin.ticker_messages.edit', [
            'message' => $message?->message,
        ]);
    }

    /**
     * Update the single global ticker message.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        TickerMessage::updateOrCreate(
            ['id' => 1],
            ['message' => $validated['message']]
        );

        return redirect()
            ->route('admin.ticker.edit')
            ->with('success', 'Ticker message updated successfully.');
    }
}
