<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(AuthTableSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(SessionSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
