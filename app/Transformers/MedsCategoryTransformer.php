<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;

use App\MedsCategory;

class MedsCategoryTransformer extends TransformerAbstract
{

    public function transform(MedsCategory $medsCategory)
    {
        return [
            'id' => $medsCategory->id,
            'name' => $medsCategory->name,
        ];
    }
}