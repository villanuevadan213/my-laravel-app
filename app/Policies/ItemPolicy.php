<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ItemPolicy
{
    public function edit(User $user, Item $item): bool {
        return $item->supplier->user->is(Auth::user());
    }
}
