<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Customer;

class CustomerTransformer extends TransformerAbstract
{

    public function transform(Customer $customer)
    {
        return [
            'id' => $customer->id,
            'name' => $customer->name,
        ];
    }
}
