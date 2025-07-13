<x-filament-panels::page>
    <div class="space-y-4">
        @foreach($this->getClassroomOptions() as $classroom => $classroomName)
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">Kelas {{ $classroomName }}</h3>
                    <div class="text-xs text-gray-500">
                        @php
                            $kelas = (int) $classroomName;
                        @endphp
                        @if($kelas >= 1 && $kelas <= 6)
                            SD
                        @elseif($kelas >= 7 && $kelas <= 9)
                            SMP
                        @elseif($kelas >= 10 && $kelas <= 12)
                            SMA
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        {{ \App\Models\User::role('student')->where('classroom', $classroom)->count() }} Siswa
                    </div>
                </div>
                <div class="ml-4 flex gap-2">
                    <a href="{{ route('filament.admin.resources.presences.sheet', ['classroom' => $classroom]) }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-primary-600 bg-white border border-primary-600 rounded-lg hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Detail
                    </a>
                    <a href="{{ route('filament.admin.resources.presences.attendance-input', ['classroom' => $classroom]) }}"
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Kehadiran
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page> 