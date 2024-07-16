<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Request as TailorRequest;
use App\Models\Status;
use App\Events\RequestDeclinedEvent;

class CancelRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $request;
    public function __construct(TailorRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pendingStatus = Status::where('name', 'pending')->first();
        if ($this->request->status_id === $pendingStatus->id) {
            $cancelledStatus = Status::where('name', 'cancelled')->first();
            $this->request->update([
                'status_id' => $cancelledStatus->id
            ]);
            // $this->request->status = 'cancelled';
            // $this->request->save();

            event(new RequestDeclinedEvent($this->request, "The tailor is not available right now, please hire different tailor."));
        }
    }
}
