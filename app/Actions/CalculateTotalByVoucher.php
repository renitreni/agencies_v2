<?php

namespace App\Actions;

use App\Models\Voucher;

class CalculateTotalByVoucher
{
    public static function handle($voucherId)
    {
        $model = Voucher::find($voucherId);
        $total = 0;

        foreach ($model->toArray() as $key => $item) {
            preg_match_all('/\(([\d\,\.]+)/', $item, $matches);
            foreach ($matches[1] as $amount) {
                $total += floatval(str_replace(',', '', $amount));
            }
        }

        $model->total = $total;
        $model->save();
    }
}
