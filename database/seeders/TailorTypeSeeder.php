<?php

namespace Database\Seeders;

use App\Models\TailorType;
use App\Models\Tailor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TailorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ["men's tailor", "women's tailor", "children's tailor", "sports tailor"];

        foreach ($types as $type) {
            TailorType::create(['name' => $type]);
        }

        // Attach Tailor type to fake users
        $length = Tailor::get()->count();

        if ($length > 0) {
            for ($i = 1; $i <= $length; $i++) {
                $tailor = Tailor::find($i);
                $tailor->tailorTypes()->attach(3);
            }
        }
    }
}
