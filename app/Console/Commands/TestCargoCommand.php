<?php
declare(strict_types=1);
namespace App\Console\Commands;

use App\Helpers\CargoTechAPI;
use Illuminate\Console\Command;

class TestCargoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cargo:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка работоспособности';

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
        //$last_record = $api->getOneRecord();
        //$all_pages = $api->getRecords(-1);
        $five_pages = $api->getRecords(2);
        var_dump($five_pages);
        return 0;
    }
}
