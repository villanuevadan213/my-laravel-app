<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Audit>
 */
class AuditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Title '.rand(1,999),
            'tracking_id' => Tracking::factory(),
            'item_id' => Item::factory(),
            'product_control_no' => 'PCN'.rand(1,999),
            'basket_no' => 'BKT'.rand(1,999),
            'serial_no' => strtoupper(Str::random(5)) . rand(100000, 999999) . strtoupper(Str::random(5)),
            'status' => 'Created',
        ];
    }
}
