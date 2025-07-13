<x-filament-panels::page>
<form action="{{ route('paycheck.pdf') }}" method="get">
  

  <div class="mb-6">
      <p><strong>Yayasan Pendidikan Sejahtera</strong></p>
      <p>Jl. Merdeka No. 123, Jakarta</p>
      <p>Telp: (021) 123-4567</p>
  </div>
  <br>
  <hr>
  <br>

  <h2 class="text-lg font-semibold mb-4">Slip Gaji</h2>
  <div class="mb-6 w-1/2">
    <table class="w-full">
      <tr>
        <td class="py-3">Nama Guru: </td>
        <td class="py-3">
          <x-filament::input.wrapper>
            <x-filament::input type="text" name="name" required/>
          </x-filament::input.wrapper>
        </td>
      </tr>
      <tr>
        <td class="py-3">Jabatan: </td>
        <td class="py-3">
          <x-filament::input.wrapper>
            <x-filament::input type="text" name="position" required/>
          </x-filament::input.wrapper>
        </td>
      </tr>
      <tr>
        <td class="py-3">Periode: </td>
        <td class="py-3">
          <x-filament::input.wrapper>
            <x-filament::input type="text" name="period" required/>
          </x-filament::input.wrapper>
        </td>
      </tr>
    </table>
  </div>

  <h3 class="font-bold mb-2">Rincian Gaji</h3>
  <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
      <thead>
          <tr class="bg-gray-200 dark:bg-gray-700">
              <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Keterangan</th>
              <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Jumlah</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Gaji Pokok</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="base" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tunjangan Transportasi</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="transport" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tunjangan Makan</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="meal" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr class="font-semibold">
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Total Gaji Kotor</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="gross" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2" colspan="2">Potongan:</td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">BPJS</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="bpjs" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Pinjaman Koperasi</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="loan" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr class="font-semibold">
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Total Potongan</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="deduction" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
          <tr class="font-bold">
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Gaji Bersih Diterima</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">Rp</x-slot>
                    <x-filament::input type="text" name="netto" class="idr"/>
                </x-filament::input.wrapper>
              </td>
          </tr>
      </tbody>
  </table>

  <div class="mt-6">
    <x-filament::button type="submit" color="primary" >Print</x-filament::button>
  </div>
</form>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const idrInputs = document.querySelectorAll('input.idr');

    idrInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value) {
                this.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                this.value = '';
            }
        });
    });
});
</script>


</x-filament-panels::page>
