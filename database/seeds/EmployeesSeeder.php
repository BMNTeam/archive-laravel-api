<?php

use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('employees')->insert([
            'full_name' => 'Максим Барсуков',
            'degree' => 'Профессор',
            'position' => 'Рабочий'
        ]);
        DB::table('employees')->insert([
            'full_name' => 'Иванов Иван Иванович',
            'degree' => 'Доцент',
            'position' => 'Рабочий'
        ]);

        DB::table('employees')->insert([
            'full_name' => 'Петров Иван Иванович',
            'degree' => 'Кандидат',
            'position' => 'Ведуший разработчик'
        ]);
    }
}
