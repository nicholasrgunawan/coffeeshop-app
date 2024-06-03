<?php
namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservation::all();
        return view('admin.reservation.index', compact('reservation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservation.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        $table = Table::findOrFail($request->table_id);

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose the table based on max guest count');
        }

        $request_date = Carbon::parse($request->res_date);

        foreach ($table->reservation as $res) {
            // Convert reservation date to Carbon instance for comparison
            $res_date = Carbon::parse($res->res_date);

            if ($res_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is reserved for this date');
            }
        }

        $data = $request->validated();
        $data['status'] = 'Booked'; // Set default status to 'Booked'
        Reservation::create($data);

        return to_route('admin.reservation.index')->with('success', 'Reservation created successfully');
    }

    /**
     * Update the status of a reservation.
     */
    public function updateStatus(Request $request, Reservation $reservation, $status)
    {
        $reservation->update(['status' => $status]);
        return redirect()->route('admin.reservation.index')->with('success', 'Reservation status updated successfully');
    }
    
    public function show(string $id)
    {
        //
    }
}
