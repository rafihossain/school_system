<?php

namespace Database\Seeders;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $departments = [
            [
                'department_name'        => 'Bangla',
                'description'        => 'bangla',
                'department_image'     => 'department_1672490129_809534.jpg',
                'department_status'      => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'department_name'        => 'English',
                'description'        => 'english',
                'department_image'     => 'department_1672490129_809534.jpg',
                'department_status'      => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'department_name'        => 'Math',
                'description'        => 'math',
                'department_image'     => 'department_1672490129_809534.jpg',
                'department_status'      => '1',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        Schema::enableForeignKeyConstraints();
    }
}
