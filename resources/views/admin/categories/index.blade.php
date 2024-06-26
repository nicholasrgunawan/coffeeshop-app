<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Category</a>
            </div>
            <div class="flex-col">
                <div class="relative overflow-x-auto">
                    <table id="categoriesTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">
                                    <img src="{{ Storage::url($category->image) }}" class="w-16 h-16 rounded">
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">
                                    {{ $category->description }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white bg-gray-50 dark:bg-gray-800">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-800 rounded-lg text-white">Edit</a>
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white" method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
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
            $('#categoriesTable').DataTable({
                "order": [[0, "asc"]],
                "paging": true,
                "searching": true
            });
        });
    </script>
</x-admin-layout>
