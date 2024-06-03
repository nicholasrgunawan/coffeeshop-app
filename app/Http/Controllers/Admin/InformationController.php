<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\Reservation; // Import the Reservation model
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use League\Csv\Reader; // Add this import
use League\Csv\Statement; // Add this import
use League\Csv\Writer;

class InformationController extends Controller
{
    public function index()
    {
        // Initialize arrays to hold the reservations count for each time interval
        $reservationsByDayOfWeek = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0,
        ];
        $reservationsByWeek = [];
        $reservationsByMonth = [];
        $reservationsByYear = [];

        // Fetch reservations from the database
        $reservations = Reservation::all();

        // Sum reservations for each day of the week
        foreach ($reservations as $reservation) {
            // Parse res_date as a Carbon instance
            $resDate = Carbon::parse($reservation->res_date);

            // Daily data (by day of the week)
            $dayOfWeek = $resDate->dayOfWeek;
            switch ($dayOfWeek) {
                case 0:
                    $reservationsByDayOfWeek['Sunday'] += $reservation->guest_number;
                    break;
                case 1:
                    $reservationsByDayOfWeek['Monday'] += $reservation->guest_number;
                    break;
                case 2:
                    $reservationsByDayOfWeek['Tuesday'] += $reservation->guest_number;
                    break;
                case 3:
                    $reservationsByDayOfWeek['Wednesday'] += $reservation->guest_number;
                    break;
                case 4:
                    $reservationsByDayOfWeek['Thursday'] += $reservation->guest_number;
                    break;
                case 5:
                    $reservationsByDayOfWeek['Friday'] += $reservation->guest_number;
                    break;
                case 6:
                    $reservationsByDayOfWeek['Saturday'] += $reservation->guest_number;
                    break;
            }

            // Weekly data
            $week = $resDate->startOfWeek()->format('Y-W');
            if (!isset($reservationsByWeek[$week])) {
                $reservationsByWeek[$week] = 0;
            }
            $reservationsByWeek[$week] += $reservation->guest_number;

            // Monthly data
            $month = $resDate->format('Y-m');
            if (!isset($reservationsByMonth[$month])) {
                $reservationsByMonth[$month] = 0;
            }
            $reservationsByMonth[$month] += $reservation->guest_number;

            // Yearly data
            $year = $resDate->format('Y');
            if (!isset($reservationsByYear[$year])) {
                $reservationsByYear[$year] = 0;
            }
            $reservationsByYear[$year] += $reservation->guest_number;
        }

        return view('admin.informations.index', compact(
            'reservationsByDayOfWeek', 'reservationsByWeek', 'reservationsByMonth', 'reservationsByYear'
        ));
    }

    public function exportCsv()
    {
        // Fetch reservations from the database
        $reservations = Reservation::all();

        // Initialize CSV writer
        $csv = Writer::createFromString('');

        // Add headers to the CSV
        $csv->insertOne(['id', 'first_name','last_name', 'email', 'tel_number', 'res_date', 'table_id', 'guest_number']);

        // Add reservation data to the CSV
        foreach ($reservations as $reservation) {
            $csv->insertOne([
                $reservation->id,
                $reservation->first_name,
                $reservation->last_name,
                $reservation->email,
                $reservation->tel_number,
                $reservation->res_date,
                $reservation->table_id,
                $reservation->guest_number
            ]);
        }

        // Set headers for CSV download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="reservations.csv"',
        ];

        // Return CSV file as a download response
        return Response::make($csv->__toString(), 200, $headers);
    }
}
