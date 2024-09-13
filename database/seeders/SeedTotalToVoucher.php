<?php

namespace Database\Seeders;

use App\Actions\CalculateTotalByVoucher;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedTotalToVoucher extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vouchers = Voucher::all();
        foreach($vouchers as $item) {
            CalculateTotalByVoucher::handle($item->id);
        }
    }
}
