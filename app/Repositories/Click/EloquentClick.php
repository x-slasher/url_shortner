<?php

namespace App\Repositories\Click;

use App\Models\Click;

class EloquentClick implements ClickRepository {
    public function create(string $data)
    {
        $click = new Click;
        $click->link_id = $data;
        $click->ip_address =  request()->ip();
        $click->save();
        return $click;

    }
}
