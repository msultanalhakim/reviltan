<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteUnverifiedUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Hapus pengguna yang tidak terverifikasi dalam waktu 48 jam
        $unverifiedUsers = User::whereNull('email_verified_at')
            ->where('created_at', '<', Carbon::now()->subHours(48))
            ->get();

        foreach ($unverifiedUsers as $user) {
            $user->delete();
        }
    }
}
