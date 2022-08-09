<?php

namespace App\Jobs;

use App\Models\Data;
use App\Models\Session;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Session|null $session;
    public int $number;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($session)
    {
        $this->session = $session;
        $this->number = $session->current_number;
        var_dump($this->number);

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        while (Session::isRunning()) {
            Data::scrape($this->number, $this->session->id);
            $this->session->current_number++;
            $this->session->save();
            $this->number = $this->session->current_number;
        }
    }
}
