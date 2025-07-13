<x-filament::page>
    <!-- Header section with month selector -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Attendance Overview</h2>
        <div>
            <!-- Month Selector -->
            <input 
                type="month" 
                wire:model="selectedMonth" 
                wire:change="updateSelectedMonth" 
                class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm
                bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
        </div>

        <!-- Print Button -->
        <x-filament::button tag="a" href="{{ route('attendance.pdf', ['month' => $selectedMonth]) }}" target="_blank" color="primary">
           Download PDF
        </x-filament::button>
    </div>

    <!-- Make the table container scrollable horizontally -->
    <div class="flex">
        <div class="w-full overflow-x-auto">
            <table class="divide-y divide-gray-200">
                <thead class="">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                        @foreach($datesInMonth as $date)
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $date->format('d') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class=" divide-y divide-gray-200">
                    @foreach($students as $student)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->name }}</td>
                            @foreach($datesInMonth as $date)
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                    @if($student->presences->contains('date', $date) && 
                                        $student->presences->where('date', $date)->first()->note == 'hadir')
                                        <x-heroicon-o-check class="w-5 h-5 text-green-500 inline"/>
                                    @else
                                        <!-- Leave blank if no attendance -->
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Print-Specific Styles -->
    <style>
        @media print {
            /* Optional: Add custom styles for printing */
            .flex, .filament-main-footer { display: none !important; } /* Hide buttons and footer */
            .overflow-x-auto { overflow: visible !important; } /* Ensure the table is fully visible */
            .dark { color-scheme: light; } /* Prevent dark mode from affecting the print */
        }
    </style>
</x-filament::page>
