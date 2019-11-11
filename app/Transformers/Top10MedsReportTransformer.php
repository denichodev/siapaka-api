<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class Top10MedsReportTransformer extends TransformerAbstract
{

    public function transform($data)
    {
        return [
            'medicineId' => $data->medicine_id,
            'sellAmt' => $data->sell_amt,
        ];
    }
}
