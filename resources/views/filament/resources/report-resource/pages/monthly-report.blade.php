<x-filament::page>
    <div class="md:flex justify-between items-center mb-4">
        <!-- Month Selector -->
        <input 
            type="month" 
            wire:model="selectedMonth" 
            wire:change="fetchReports" 
            class="block border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm 
                   bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 mb-2">
        
        <!-- User Selector -->
        <select 
            wire:model="selectedUserId" 
            wire:change="fetchReports" 
            class="ml-4 block border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm 
                   bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 mb-2">
            @foreach($members as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <!-- Print Button -->
        <x-filament::button wire:click="downloadPDF" color="primary">
            Print PDF
        </x-filament::button>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg dark:bg-gray-800 dark:text-gray-200">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Laporan
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-600">
                @foreach($reports as $report)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-200">
                            {{ \Carbon\Carbon::parse($report['date'])->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200 break-words w-full">
                            <div class="whitespace-normal">
                                {{ $report['report'] ? $report['report']->note : '-' }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament::page>
