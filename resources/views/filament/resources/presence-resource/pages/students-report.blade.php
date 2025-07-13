<x-filament-panels::page>
@php
  $kelompokA = [
    [
      'name' => 'Pendidikan Agama dan Budi Pekerti',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
    [
      'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
    [
      'name' => 'Bahasa Indonesia',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
    [
      'name' => 'Matematika',
      'knowledge_score' => 70,
      'knowledge_grade' => 'C',
      'skill_score' => 80,
      'skill_grade' => 'B',
    ],
    [
      'name' => 'Bahasa Inggris',
      'knowledge_score' => 90,
      'knowledge_grade' => 'A',
      'skill_score' => 100,
      'skill_grade' => 'A',
    ],
    [
      'name' => 'Ilmu Pengetahuan Alam',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
    [
      'name' => 'Ilmu Pengetahuan Sosial',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
  ];

  $kelompokB = [
    [
      'name' => 'Seni Budaya',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
    [
      'name' => 'Pendidikan Jasmani, Olah Raga, dan Kesehatan',
      'knowledge_score' => 70,
      'knowledge_grade' => 'C',
      'skill_score' => 80,
      'skill_grade' => 'B',
    ],
    [
      'name' => 'Muatan Lokal Bahasa dan Sastra Sunda/Cirebonan',
      'knowledge_score' => 90,
      'knowledge_grade' => 'C',
      'skill_score' => 80,
      'skill_grade' => 'B',
    ]
  ];

  $kelompokC = [
    [
      'name' => '..............................',
      'knowledge_score' => ' ',
      'knowledge_grade' => ' ',
      'skill_score' => ' ',
      'skill_grade' => ' ',
    ],
  ];

  $kelompokD = [
    [
      'name' => '..............................',
      'knowledge_score' => ' ',
      'knowledge_grade' => ' ',
      'skill_score' => ' ',
      'skill_grade' => ' ',
    ],
  ];

  $kelompokE = [
    [
      'name' => 'Program Khusus',
      'knowledge_score' => 80,
      'knowledge_grade' => 'B',
      'skill_score' => 90,
      'skill_grade' => 'A',
    ],
  ]
@endphp

<form action="{{ route('studentreport.pdf') }}" method="get">
<div class="max-h-screen overflow-y-auto">
    <!-- Header -->
    <div class="flex">
      <table class="w-1/2 border-gray-300">
          <tbody>
              <!-- Nama -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Nama</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" name="nama" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>

              <!-- NISN -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Nomor Induk / NISN</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" name="nisn" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>
          </tbody>
      </table>

      <table class="w-1/2 border-collapse border-gray-300">
          <tbody>
              <!-- Kelas -->
              <tr>
                  <td class="w-1/2 p-2 font-bold">Kelas</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" name="kelas" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>

              <!-- Semester -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Semester</td>
                <td class="w-1/2 p-2 font-bold">
                  <x-filament::input.wrapper class="w-full">
                    <x-filament::input type="text" name="semester" required/>
                  </x-filament::input.wrapper>
                </td>
              </tr>

              <!-- Tahun Pelajaran -->
              <tr>
                <td class="w-1/2 p-2 font-bold">Tahun Pelajaran</td>
                  <td class="w-1/2 p-2 font-bold">
                    <x-filament::input.wrapper class="w-full">
                      <x-filament::input type="text" name="tahun" required/>
                    </x-filament::input.wrapper>
                  </td>
              </tr>
          </tbody>
      </table>
    </div>

    <!-- Sikap Section -->
    <h2 class="font-bold">A. Sikap</h2>
    <h3 class="font-bold mt-3">Sikap Spiritual</h3>
    <textarea rows="5" name="sikap-spiritual" id="ta-sikap-spiritual" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"></textarea>
    
    <h3 class="font-bold mt-3">Sikap Sosial</h3>
    <textarea rows="5" name="sikap-sosial" id="ta-sikap-sosial" class="rounded mt-1
    fi-input block w-full py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"></textarea>
    
    <!-- Pengetahuan dan Keterampilan Section -->
    <h2 class="font-bold mt-6">B. Pengetahuan dan Keterampilan</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">No</th>
                <th class="border border-gray-300 p-2">Mata Pelajaran</th>
                <th colspan="2" class="border border-gray-300 p-2">Pengetahuan</th>
                <th colspan="2" class="border border-gray-300 p-2">Keterampilan</th>
            </tr>
            <tr>
                <th class="border border-gray-300 p-2"></th>
                <th class="border border-gray-300 p-2"></th>
                <th class="border border-gray-300 p-2">Angka</th>
                <th class="border border-gray-300 p-2">Huruf</th>
                <th class="border border-gray-300 p-2">Angka</th>
                <th class="border border-gray-300 p-2">Huruf</th>
            </tr>
        </thead>
        <tbody>
            <!-- Kelompok A (Wajib) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok A (Wajib)</td>
            </tr>
            @foreach ($kelompokA as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeA[]"
                          required
                      />
                  </x-filament::input.wrapper>
                  {{-- <x-filament::input type="text" name="kelompokA[]" class="w-20 rounded"></x-filament::input> --}}
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeAletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillA[]"
                          required
                      />
                  </x-filament::input.wrapper>
                  {{-- <input type="text" name="kelompokA[]" class="w-20 rounded"> --}}
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillAletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                  {{-- <input type="text" name="kelompokA[]" class="w-20 rounded"> --}}
                </td>
            </tr>
            @endforeach
            
            <!-- Kelompok B (Wajib) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok B (Wajib)</td>
            </tr>
            @foreach ($kelompokB as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeB[]"
                          required
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeBletter[]"
                          required
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillB[]"
                          required
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillBletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach


            <!-- Kelompok C (Pilihan Peminatan) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok C (Pilihan Peminatan)</td>
            </tr>
            @foreach ($kelompokC as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-full">
                      <x-filament::input
                          type="text"
                          name="kelompokCMapel"
                          value=""
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeC[]"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeCletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillC[]"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillCletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach


            <!-- Kelompok D (Pilihan Kemandirian) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok D (Pilihan Kemandirian)</td>
            </tr>
            @foreach ($kelompokD as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-full">
                      <x-filament::input
                          type="text"
                          name="kelompokDMapel"
                          value=""
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeD[]"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeDletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillD[]"
                          value="0"
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillDletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach

            <!-- Kelompok E (Program Kebutuhan Khusus) -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Kelompok E (Program Kebutuhan Khusus)</td>
            </tr>
            @foreach ($kelompokE as $index => $subject)
            <tr>
                <td class="border border-gray-300 p-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 p-2">{{ $subject['name'] }}</td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeE[]"
                          required
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="knowledgeEletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillE[]"
                          required
                      />
                  </x-filament::input.wrapper>
                </td>
                <td class="border border-gray-300 p-2 text-center">
                  <x-filament::input.wrapper class="w-20">
                      <x-filament::input
                          type="text"
                          name="skillEletter[]"
                          disabled
                      />
                  </x-filament::input.wrapper>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pengetahuan dan Keterampilan Section -->
    <h2 class="font-bold mt-6">Deskripsi Pengetahuan dan Keterampilan</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">No</th>
                <th class="border border-gray-300 p-2">Mata Pelajaran</th>
                <th class="border border-gray-300 p-2">Kompetensi</th>
                <th class="border border-gray-300 p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Kelompok A (Wajib) -->
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok A (Wajib)</td>
            </tr>
            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">1</td>
                <td rowspan="2" class="border border-gray-300 p-2">Pendidikan Agama dan Budi Pekerti</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Memahami Surah Al-Fatihah</li>
                    <p>"Peserta didik mampu memahami surat Al-Fatihah dengan sedikit bantuan"</p>

                    <li>Memahami Rukun Iman</li>
                    <p>"Peserta didik mampu dengan bimbingan untuk memahami rukun iman"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyalin Surah Al-Fatihah</li>
                    <p>"Peserta didik mampu mandiri untuk menyalin surat Al-Fatihah"</p>
                  </ul>
                </td>
            </tr>


            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">2</td>
                <td rowspan="2" class="border border-gray-300 p-2">Pendidikan Pancasila dan Kewarganegaraan</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal nama dan gambar lambang negara indonesia</li>
                    <p>"Peserta didik mampu memahami surat Al-Fatihah dengan sedikit bantuan"</p>

                    <li>Memahami Rukun Iman</li>
                    <p>"Peserta didik mampu dengan bimbingan untuk memahami rukun iman"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyalin Surah Al-Fatihah</li>
                    <p>"Peserta didik mampu mandiri untuk menyalin surat Al-Fatihah"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">3</td>
                <td rowspan="2" class="border border-gray-300 p-2">Bahasa Indonesia</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal huruf-huruf abjad dalam bahasa indonesia</li>
                    <p>"Peserta didik mampu mengenal huruf abjad dengan bantuan"</p>

                    <li>Mengenal bunyi bahasa indonesia</li>
                    <p>"Peserta didik mampu mengenal bunyi bahasa indonesia dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyalin huruf-huruf abjad dalam bahasa indonesia</li>
                    <p>"Peserta didik mampu menyalin huruf abjad dengan mandiri"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">4</td> 
                <td rowspan="2" class="border border-gray-300 p-2">Matematika</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal bilangan asli sampai 10 dengan menggunakan benda konkret</li>
                    <p>"Peserta didik mampu mengenal bilangan 1-10 dengan bantuan"</p>

                    <li>Mengenal bangun datar dan bangun ruang dengan menggunakan berbagai benda konkret</li>
                    <p>"Peserta didik mampu mengenal bangun datar dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>  
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menuliskan bilangan asli sampai 10</li>
                    <p>"Peserta didik mampu menuliskan bilangan 1-10 dengan mandiri"</p>

                    <li>Mengelompokkan bangun datar dan bangun ruang</li>
                    <p>"Peserta didik mampu mengelompokkan bangun datar dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">5</td>
                <td rowspan="2" class="border border-gray-300 p-2">Ilmu Pengetahuan Alam</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal makhluk hidup dan lingkungan sekitar</li>
                    <p>"Peserta didik mampu mengenal makhluk hidup dengan bantuan"</p>

                    <li>Memahami perubahan wujud benda</li>
                    <p>"Peserta didik mampu memahami perubahan wujud dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Melakukan pengamatan sederhana</li>
                    <p>"Peserta didik mampu melakukan pengamatan dengan mandiri"</p>
                    
                    <li>Melakukan percobaan sederhana</li>
                    <p>"Peserta didik mampu melakukan percobaan dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">6</td>
                <td rowspan="2" class="border border-gray-300 p-2">Ilmu Pengetahuan Sosial</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal lingkungan keluarga dan sekolah</li>
                    <p>"Peserta didik mampu mengenal lingkungan dengan bantuan"</p>

                    <li>Memahami peran anggota keluarga</li>
                    <p>"Peserta didik mampu memahami peran keluarga dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menceritakan kegiatan sehari-hari</li>
                    <p>"Peserta didik mampu menceritakan kegiatan dengan mandiri"</p>
                    
                    <li>Berinteraksi dengan lingkungan sosial</li>
                    <p>"Peserta didik mampu berinteraksi dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">7</td>
                <td rowspan="2" class="border border-gray-300 p-2">Bahasa Inggris</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Memahami kosakata dasar bahasa Inggris</li>
                    <p>"Peserta didik mampu mengenal kosakata dasar dengan bantuan"</p>

                    <li>Mengenal ungkapan sapaan sederhana</li>
                    <p>"Peserta didik mampu mengenal ungkapan sapaan dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengucapkan kosakata sederhana</li>
                    <p>"Peserta didik mampu mengucapkan kosakata dengan mandiri"</p>
                    
                    <li>Melakukan percakapan singkat</li>
                    <p>"Peserta didik mampu melakukan percakapan dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <!-- Kelompok B Section -->
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok B (Wajib)</td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">1</td>
                <td rowspan="2" class="border border-gray-300 p-2">Seni Budaya dan Prakarya</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal karya seni rupa dua dimensi</li>
                    <p>"Peserta didik mampu mengenal karya seni rupa dua dimensi dengan bantuan"</p>

                    <li>Mengenal lagu-lagu daerah</li>
                    <p>"Peserta didik mampu mengenal lagu daerah dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Membuat karya seni rupa dua dimensi</li>
                    <p>"Peserta didik mampu membuat karya seni rupa dua dimensi dengan mandiri"</p>
                    
                    <li>Menyanyikan lagu-lagu daerah</li>
                    <p>"Peserta didik mampu menyanyikan lagu daerah dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">2</td>
                <td rowspan="2" class="border border-gray-300 p-2">Pendidikan Jasmani, Olahraga dan Kesehatan</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengetahui bagian-bagian tubuh manusia</li>
                    <p>"Peserta didik mampu mengetahui bagian tubuh dengan bantuan"</p>

                    <li>Mengetahui cara menjaga kebersihan tubuh</li>
                    <p>"Peserta didik mampu mengetahui cara menjaga kebersihan dengan bimbingan"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mempraktikkan cara menjaga kebersihan tubuh</li>
                    <p>"Peserta didik mampu mempraktikkan cara menjaga kebersihan dengan mandiri"</p>
                    
                    <li>Melakukan gerak dasar lokomotor</li>
                    <p>"Peserta didik mampu melakukan gerak dasar dengan bantuan"</p>
                  </ul>
                </td>
            </tr>

            

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">3</td>
                <td rowspan="2" class="border border-gray-300 p-2">Muatan Lokal Bahasa dan
Sastra Sunda/Cirebonan</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal adab sopan santun dalam kehidupan sehari-hari</li>
                    <p>"Peserta didik mampu mandiri untuk mengenal adab sopan santun dalam kehidupan sehari-hari"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Melabel warna, benda, angka, panca indra, buah dan sayuran</li>
                    <p>"Peserta didik mampu mandiri untuk melabel warna, benda, angka, panca indra, buah dan sayuran"</p>
                    
                    <li>Mengelompokan sayuran berdasarkan warnanya</li>
                    <p>"Peserta didik mampu dengan bimbingan untuk mengelompokan sayuran berdasarkan warnanya"</p>
                  </ul>
                </td>
            </tr>

            <!-- Kelompok C Section -->
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 font-bold">Kelompok C (Pilihan Peminatan)</td>
            </tr>

            <tr>
                <td rowspan="2" class="border border-gray-300 p-2">1</td>
                <td rowspan="2" class="border border-gray-300 p-2">Program Khusus Bina Diri</td>
                <td class="border border-gray-300 p-2">Pengetahuan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Mengenal peralatan untuk membersihkan kelas menyapu dan mengepel</li>
                    <p>"Peserta didik mampu mandiri mengenal peralatan bersih-bersih"</p>
                  </ul>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-2">Keterampilan</td>
                <td class="border border-gray-300 p-2">
                  <ul>
                    <li>Menyapu dan mengepel kelas dengan bersih</li>
                    <p>"Peserta didik mampu mandiri menyapu dan mengepel kelas"</p>
                  </ul>
                </td>
            </tr>
        </tbody>
    </table>


    <h2 class="font-bold mt-6">C. Ketidakharidan</h2>
    <table class="w-1/4 border-collapse border border-gray-300">
        <tbody>
            <!-- Sakit -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Sakit</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  <x-filament::input.wrapper>
                      <x-filament::input
                          type="text"
                          name="sakit"
                          value="0"
                      />
                      <x-slot name="suffix">Hari</x-slot>
                  </x-filament::input.wrapper>
                </td>
            </tr>

            <!-- Izin -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Izin</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  <x-filament::input.wrapper>
                      <x-filament::input
                          type="text"
                          name="izin"
                          value="0"
                      />
                      <x-slot name="suffix">Hari</x-slot>
                  </x-filament::input.wrapper>
                </td>
            </tr>

            <!-- Tanpa Keterangan -->
            <tr>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">Tanpa Keterangan</td>
                <td colspan="6" class="border border-gray-300 p-2 font-bold">
                  <x-filament::input.wrapper>
                      <x-filament::input
                          type="text"
                          name="alfa"
                          value="0"
                      />
                      <x-slot name="suffix">Hari</x-slot>
                  </x-filament::input.wrapper>
                </td>
            </tr>
        </tbody>
    </table>
    

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="sign flex justify-between mt-10">
      <div>
        <p>&nbsp;</p>
        <p>Mengetahui,</p>
        <p>Orang Tua/Wali,</p>
        <br>
        <br>
        <p>......................</p>
      </div>
      <div>
        <p>Bandung, 01 April 2025</p>
        <p>&nbsp;</p>
        <p>Guru Kelas</p>
        <br>
        <br>
        <p>......................</p>
      </div>
    </div>
</div>

{{-- onclick="window.location.href='{{ route('studentreport.pdf') }}'" --}}
<div>
  <x-filament::button type="submit" color="primary" >Print</x-filament::button>
</div>
</form>

<script>
    // Function to convert number to letter grade
    function numberToLetterGrade(value) {
        if (value >= 80.5) return 'A';
        if (value >= 65.5) return 'B';
        if (value >= 50.5) return 'C';
        if (value > 0) return 'D';
        return '-';
    }

    
    // Kelompok A
    document.getElementsByName('knowledgeA[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('knowledgeAletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

    document.getElementsByName('skillA[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('skillAletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

    // Kelompok B
    document.getElementsByName('knowledgeB[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('knowledgeBletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

    document.getElementsByName('skillB[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('skillBletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

    // Kelompok C
    document.getElementsByName('knowledgeC[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('knowledgeCletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });
    document.getElementsByName('skillC[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('skillCletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

    // Kelompok D
    document.getElementsByName('knowledgeD[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('knowledgeDletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });
    document.getElementsByName('skillD[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('skillDletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

    // Kelompok E
    document.getElementsByName('knowledgeE[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('knowledgeEletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });
    document.getElementsByName('skillE[]').forEach(function(input, index) {
        input.addEventListener('change', function() {
            const value = parseFloat(this.value);
            const letterInput = document.getElementsByName('skillEletter[]')[index];
            letterInput.value = numberToLetterGrade(value);
        });
    });

</script>



</x-filament-panels::page>
