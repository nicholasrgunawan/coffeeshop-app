<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;
use Carbon\Carbon;

class VisitSeeder extends Seeder
{
    public function run()
    {
        // Define sample visit data
        $visits = [
            ['visit_date' => '2024-05-01', 'visitors_count' => 10],
            ['visit_date' => '2024-05-02', 'visitors_count' => 15],
            ['visit_date' => '2024-05-03', 'visitors_count' => 20],
            // Add more sample data as needed
        ];

        // Insert visit records
        foreach ($visits as $visitData) {
            Visit::create([
                'visit_date' => $visitData['visit_date'],
                'visitors_count' => $visitData['visitors_count'],
            ]);
        }
    }
}
