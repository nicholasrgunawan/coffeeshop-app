<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.reservation.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Reservation</a>
            </div>
            <div class="flex-col">
                <div class="relative overflow-x-auto">
                    <table id="reservationTables" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Phone</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Table</th>
                                <th scope="col" class="px-6 py-3">Guests</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservation as $res)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->first_name }} {{ $res->last_name }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->email }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->tel_number }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->res_date }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->table->name }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->guest_number }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">{{ $res->status }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">
                                    <div class="flex space-x-2">
                                        <form method="POST" action="{{ route('admin.reservation.status', ['reservation' => $res->id, 'status' => 'Reserved']) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg text-white">Done</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reservation.status', ['reservation' => $res->id, 'status' => 'Cancelled']) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-700 rounded-lg text-white">Cancel</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#reservationTables').DataTable({
                "order": [[0, "asc"]],
                "paging": true,
                "searching": true
            });
        });
    </script>
</x-admin-layout>
