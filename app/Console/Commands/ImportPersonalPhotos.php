<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\QueuesImports;
class ImportPersonalPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'personal:photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        sleep(10);
        $queue = new QueuesImports();
        $queue->name = 'fotos_personal';
        $queue->status = 'PROCESANDO';
        $queue->save();
    }
}
