<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('dayshifts')->insert([
            'description' => 'Morning',
            'ShortSymbol' => 'AM',
            ]);

            DB::table('dayshifts')->insert([
            'description' => 'Afternoon',
            'ShortSymbol' => 'PM',
            ]);

            DB::table('dayshifts')->insert([
            'description' => 'Day',
            'ShortSymbol' => 'Day',
            ]);

            DB::table('medicineunits')->insert([
            'description' => 'Millilitre',
            'ShortSymbol' => 'ml',
            ]);

            DB::table('medicineunits')->insert([
            'description' => 'Cubic Centimetre',
            'ShortSymbol' => 'cc',
            ]);

            DB::table('medicineunits')->insert([
            'description' => 'Milligram',
            'ShortSymbol' => 'mg',
            ]);

            DB::table('medicineunits')->insert([
            'description' => 'Gram',
            'ShortSymbol' => 'g',
            ]);
    }
}
