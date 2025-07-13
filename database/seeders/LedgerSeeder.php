<?php

namespace Database\Seeders;

use App\Models\Ledger;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ledgers')->insert([
            'name' => 'Initial Balance',
            'amount' => 5000000,
            'direction' => 'IN',
            'date' => Carbon::today()
        ]);

        Ledger::factory()->count(20)->create();
    }
}
