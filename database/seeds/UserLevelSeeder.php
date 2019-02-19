<?php

use Illuminate\Database\Seeder;
use App\UserLevel;
use Carbon\Carbon;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataLevel = [
            [
                'title' => 'admin',
                'status' => 1
            ],
            [
                'title' => 'member',
                'status' => 1
            ],
            [
                'title' => 'admin suspended',
                'status' => 0
            ],
            [
                'title' => 'member suspended',
                'status' => 0
            ],
            [
                'title' => 'rejected',
                'status' => 0
            ],
        ];

        foreach($dataLevel as $k => $v){
            UserLevel::insert([
                'title' => $v['title'],
                'status' => $v['status'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
            echo "User level ".$v['title']." has been created \n";
        }
    }
}
