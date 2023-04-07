<?php

namespace Lumis\PerformanceContract\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Lumis\PerformanceContract\Entities\Pillar;

class PillarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pillars = [
            'Teaching and Learning',
            'Research and Outreach',
            'Infrastructure Development',
            'Capacity Building',
            'Governance and Management'
        ];

        foreach ($pillars as $pillar) {
            $obj = new Pillar();
            $obj->name = $pillar;
            $obj->save();
        }
    }
}
