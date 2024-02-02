<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'title' => 'Monthly',
            'slug' => 'monthly',
            'stripe_id' => 'price_1OfHUjDbT4THc2zuRv1iDhF9',
        ]);

        Plan::create([
            'title' => 'Yearly',
            'slug' => 'yarly',
            'stripe_id' => 'price_1OfHY4DbT4THc2zur9ANgZ4L',
        ]);

    }
}
