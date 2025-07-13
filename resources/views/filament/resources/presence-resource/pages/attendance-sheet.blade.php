<x-filament::page>
    <!-- Header section with month selector -->
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-xl font-bold">Detail Kehadiran Siswa</h2>
            @if(isset($selectedClassroom) && $selectedClassroom)
                <div class="text-sm text-gray-500 mt-1">Kelas: <span class="font-semibold">{{ $selectedClassroom }}</span></div>
            @endif
        </div>
        <div class="flex gap-2 items-center">
            <!-- Month Selector -->
            <form wire:submit.prevent="updateSelectedMonth" class="inline-block">
                <input 
                    type="month" 
                    wire:model="selectedMonth" 
                    wire:change="updateSelectedMonth" 
                    class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
            </form>
            @php $showDateModal = session('showDateModal', false); @endphp
            <script>
                function openDateModal() {
                    document.getElementById('edit-date-modal').classList.remove('hidden');
                }
                function closeDateModal() {
                    document.getElementById('edit-date-modal').classList.add('hidden');
                }
                function goToEditAttendance() {
                    var date = document.getElementById('edit-date-select').value;
                    if(date) {
                        window.location = '{{ route('filament.admin.resources.presences.attendance-input', ['classroom' => $selectedClassroom]) }}' + '&date=' + date;
                    }
                }
            </script>
            <x-filament::button color="primary" type="button" onclick="openDateModal()">
                Edit Kehadiran
            </x-filament::button>
            <div id="edit-date-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 relative z-50">
                    <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" style="right: 1rem; left: auto;" onclick="closeDateModal()">&times;</button>
                    <h3 class="text-lg font-bold mb-4">Pilih Tanggal Kehadiran</h3>
                    <select id="edit-date-select" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm mb-4">
                        <option value="">-- Pilih Tanggal --</option>
                        @foreach($datesInMonth as $date)
                            <option value="{{ $date->format('Y-m-d') }}">{{ $date->format('d F Y') }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" onclick="closeDateModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">Batal</button>
                        <button type="button" onclick="goToEditAttendance()" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-md hover:bg-primary-500">Lanjut</button>
                    </div>
                </div>
            </div>
            <x-filament::button tag="a" href="{{ route('attendance.pdf', ['month' => $selectedMonth]) }}" target="_blank" color="primary">
                Download PDF
            </x-filament::button>
        </div>
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
                                    @php
                                        $presence = $student->presences->first(function($item) use ($date) {
                                            return \Illuminate\Support\Carbon::parse($item->date)->format('Y-m-d') === $date->format('Y-m-d');
                                        });
                                    @endphp
                                    @if($presence)
                                        @php
                                            $color = match($presence->note) {
                                                'hadir' => '#22c55e',    // green-500
                                                'sakit' => '#3b82f6',    // blue-500
                                                'izin'  => '#eab308',    // yellow-500
                                                'alpa'  => '#ef4444',    // red-500
                                                default => '#a3a3a3'     // gray-400
                                            };
                                            $label = strtoupper(substr($presence->note, 0, 1));
                                        @endphp
                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;border-radius:50%;background:{{ $color }};color:#fff;font-weight:700;font-size:0.7rem;">
                                            {{ $label }}
                                        </span>
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
