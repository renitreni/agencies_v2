<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Candidate;
use App\Models\Complains;
use App\Models\ForeignAgency;
use App\Models\JobOrder;
use App\Models\Report;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class DevEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=DevEnvironmentSeeder
     *
     * @return void
     */
    public function run()
    {
        Complains::factory()->count(200)->create();
        Agency::factory()->count(100)->create();
        Agency::query()->each(function ($value) {
            Candidate::factory()->count(10)->create(['agency_id' => $value->id]);
            ForeignAgency::factory()->count(10)->create(['agency_id' => $value->id]);
            Voucher::factory()->count(10)->create(['agency_id' => $value->id]);

            $foreignAgency = ForeignAgency::query()->where('agency_id', $value->id)->inRandomOrder()->first();
            Complains::factory()->count(10)->create([
                'agency_id' => $value->id,
                'agency' => $value->name,
                'foreign_agency' => $foreignAgency->agency_name,
                'foreign_agency_id' => $foreignAgency->id,
            ]);
        });

        Voucher::query()->each(function ($value) {
            // Get random FRA
            $fra = ForeignAgency::query()->where('agency_id', $value->agency_id)->inRandomOrder()->first();

            // Assign random FRA to Job order with corresponding voucher id
            JobOrder::query()
                ->create([
                    'voucher_id' => $value->id,
                    'foreign_agency_id' => $fra->id,
                ]);

            // Assign a voucher id to candidate
            $candidate = Candidate::query()
                ->where('agency_id', $value->agency_id)
                ->inRandomOrder()
                ->first();

            $candidate->voucher_id = $value->id;
            $candidate->save();
        });

        Voucher::query()->each(function ($value) {
            // Assign a voucher id to candidate
            $candidate = Candidate::query()
                ->where('agency_id', $value->agency_id)
                ->inRandomOrder()
                ->first();

            $candidate->voucher_id = $value->id;
            $candidate->save();
        });

        Report::factory()->count(50)->create();
    }
}
