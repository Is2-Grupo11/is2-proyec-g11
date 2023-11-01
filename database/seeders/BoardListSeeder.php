<?php

namespace Database\Seeders;

use App\Models\BoardList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creación de tabla kanban To-do, Doing, Done
        BoardList::create(['name' => 'To-do']);
        BoardList::create(['name' => 'Doing']);
        BoardList::create(['name' => 'Done']);
    }
}
