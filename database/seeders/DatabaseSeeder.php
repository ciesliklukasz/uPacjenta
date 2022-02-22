<?php

namespace Database\Seeders;

use App\Models\LaboratoryExamination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 2) as $index) {
            DB::table('laboratory_examination_category')
                ->insert([
                    'uuid' => Uuid::uuid4()->toString(),
                    'name' => sprintf('Test Category %s', $index)
                ]);
        }

        foreach (range(1, 20) as $index) {
            DB::table('laboratory_examinations')
                ->insert([
                    'uuid' => Uuid::uuid4()->toString(),
                    'name' => sprintf('Test Examination %s', $index),
                    'category_id' => random_int(1, 2)
                ]);
        }
    }
}
