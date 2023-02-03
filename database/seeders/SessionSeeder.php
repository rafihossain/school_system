<?php

namespace Database\Seeders;

use App\Models\SessionModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $sessions = [
            [
                'session_name'        => '2022',
                'start_date'         => '2022-01-01',
                'end_date'              => '2022-12-30',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'session_name'        => '2023',
                'start_date'         => '2023-01-01',
                'end_date'              => '2023-12-30',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        foreach ($sessions as $session) {
            SessionModel::create($session);
        }

        Schema::enableForeignKeyConstraints();
    }
}
