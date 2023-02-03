<?php

namespace Database\Seeders;

use App\Models\ClassModal;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $classes = [
            [
                'session_id'        => '2',
                'class_name'        => 'One',
                'class_numeric'     => '01',
                'class_status'      => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'session_id'        => '2',
                'class_name'        => 'Two',
                'class_numeric'     => '02',
                'class_status'      => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        foreach ($classes as $class) {
            ClassModal::create($class);
        }

        Schema::enableForeignKeyConstraints();
    }
}
