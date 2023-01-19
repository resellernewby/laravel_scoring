<?php

namespace App\Console\Commands;

use App\Models\ConsumableTransaction;
use App\Models\Location;
use App\Models\Warehouse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DataFixer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:fixer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Fixer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::transaction(function () {
            // Inject location to warehouses
            $locations = Location::all();
            $initId = [];

            foreach ($locations as $loc) {
                $ware = Warehouse::create([
                    'name' => $loc->name,
                    'description' => $loc->description,
                    'type' => 0
                ]);

                $initId[$loc->id] = $ware->id;
            }

            // inject warehouse_id from consumable_transactions
            $conTrans = ConsumableTransaction::with('consumable')->get();
            foreach ($conTrans as $ct) {
                if ($ct->location_id != null) {
                    $ct->update([
                        'warehouse_id' => $initId[$ct->location_id]
                    ]);

                    continue;
                }
            }
        });
    }
}
