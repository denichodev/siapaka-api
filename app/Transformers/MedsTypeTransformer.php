<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;

use App\MedsType;

class MedsTypeTransformer extends TransformerAbstract
{

    public function transform(MedsType $medsType)
    {
        return [
            'id' => $medsType->id,
            'name' => $medsType->name,
        ];
    }
}