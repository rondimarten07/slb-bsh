<x-filament-panels::page>
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" wire:model="date" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 font-medium" 
                           value="{{ date('Y-m-d') }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <input type="text" value="{{ $classroom }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 font-medium" 
                           readonly>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg border border-gray-200 shadow-sm">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-16 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="w-32 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Siswa</th>
                        <th class="w-20 px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">H</th>
                        <th class="w-20 px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">S</th>
                        <th class="w-20 px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">I</th>
                        <th class="w-20 px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">A</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($students as $index => $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student['nis'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $student['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <input type="radio" wire:model="students.{{ $index }}.status" value="hadir" class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <input type="radio" wire:model="students.{{ $index }}.status" value="sakit" class="w-4 h-4 text-yellow-600 border-gray-300 focus:ring-yellow-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <input type="radio" wire:model="students.{{ $index }}.status" value="izin" class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <input type="radio" wire:model="students.{{ $index }}.status" value="alpa" class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end items-center gap-3 pt-6">
            <a href="{{ route('filament.admin.resources.presences.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Kembali</a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-md hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">{{ $isEdit ? 'Update Kehadiran' : 'Simpan Kehadiran' }}</button>
        </div>
    </form>
</x-filament-panels::page> 