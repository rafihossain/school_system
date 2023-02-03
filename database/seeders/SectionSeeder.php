<?php

namespace Database\Seeders;

use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $sections = [
            [
                'section_name'        => 'Section-A',
                'section_capacity'         => '24',
                'class_id'              => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'section_name'        => 'Section-B',
                'section_capacity'         => '81',
                'class_id'              => '2',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'section_name'        => 'Section-C',
                'section_capacity'         => '24',
                'class_id'              => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }

        Schema::enableForeignKeyConstraints();
    }
}
