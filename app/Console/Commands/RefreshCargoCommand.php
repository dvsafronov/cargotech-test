<?php

namespace App\Console\Commands;

use App\Helpers\CargoTechAPI;
use App\Jobs\ProcessCargoItem;
use Illuminate\Console\Command;

class RefreshCargoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cargo:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновляет данные из API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = new CargoTechAPI();
        $data = $api->getPageOfRecords(2);
        foreach ($data as $item) {
            ProcessCargoItem::dispatch($item);
        }
        return 0;
    }
}
