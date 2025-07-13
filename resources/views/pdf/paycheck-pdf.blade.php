@extends('layouts.pdf')

@section('body')
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
          {{ $name }}
        </td>
      </tr>
      <tr>
        <td class="py-3">Jabatan: </td>
        <td class="py-3">
          {{ $position }}
        </td>
      </tr>
      <tr>
        <td class="py-3">Periode: </td>
        <td class="py-3">
          {{ $period }}
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
                Rp {{ $base }}
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tunjangan Transportasi</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $transport }}
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tunjangan Makan</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $meal }}
              </td>
          </tr>
          <tr class="font-semibold">
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Total Gaji Kotor</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $gross }}
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2" colspan="2">Potongan:</td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">BPJS</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $bpjs }}
              </td>
          </tr>
          <tr>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Pinjaman Koperasi</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $loan }}
              </td>
          </tr>
          <tr class="font-semibold">
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Total Potongan</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $deduction }}
              </td>
          </tr>
          <tr class="font-bold">
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Gaji Bersih Diterima</td>
              <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                Rp {{ $netto }}
              </td>
          </tr>
      </tbody>
  </table>

<table style="width: 100%; margin-top: 2rem;">
    <tr>
        <td style="width: 50%;"></td>
        <td style="width: 50%; text-align: center;">
            <p style="padding-bottom: 24px;">Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </td>
    </tr>
</table>

<table style="width: 100%;">
    <tr>
        <td style="width: 50%; text-align: center;">
            <p><strong>Tanda Tangan Bendahara</strong></p>
            <br><br><br><br>
            <p>(Alam Muhammad F, S.Pd., M.Pd.)</p>
        </td>
        <td style="width: 50%; text-align: center;">
            <p><strong>Tanda Tangan Guru</strong></p>
            <br><br><br><br>
            <p>({{ $name }})</p>
        </td>
    </tr>
</table>

</div>

  
@endsection