<?php

use Illuminate\Database\Seeder;

class JournalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $date;

    public function __construct()
    {
        $this->date = date("Y-m-d H:i:s");
    }

    public function run()
    {
        //
        DB::table('journals')->insert([
            'name' => 'АГРОХИМИЯ',
            'url' => 'https://elibrary.ru/title_about.asp?id=7657',
            'created_at' => $this->date,
            'updated_at' => $this->date
        ]);

        DB::table('journals')->insert([
            'name' => '«Азимут научных исследований: экономика и управление»',
            'url' => 'https://elibrary.ru/title_about.asp?id=38918',
            'created_at' => $this->date,
            'updated_at' => $this->date
        ]);

        DB::table('journals')->insert([
            'name' => 'АЗИАТСКО-ТИХООКЕАНСКИЙ РЕГИОН: ЭКОНОМИКА, ПОЛИТИКА, ПРАВО',
            'url' => 'https://elibrary.ru/title_about.asp?id=26645',
            'created_at' => $this->date,
            'updated_at' => $this->date
        ]);


    }
}
