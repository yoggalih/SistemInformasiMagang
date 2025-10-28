@extends('layouts.app')

@section('title', 'Status Pengajuan Magang - PN Klaten')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-bold text-pn-maroon mb-4 border-b-2 pb-2 text-center">Status Pengajuan Magang Anda</h1>

        <div class="max-w-xl mx-auto bg-gray-50 p-8 rounded-lg shadow-xl border-t-4 border-pn-maroon">

            {{-- Logika baru: Cek apakah data pendaftar ditemukan --}}
            @if (!isset($applicant))
                <div class="p-4 rounded-lg text-center bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500">
                    <p class="text-xl font-semibold mb-2">Data Pendaftaran Belum Ditemukan.</p>
                    <p>Email yang terdaftar pada akun ini ({{ Auth::user()->email }}) belum digunakan untuk mengajukan
                        pendaftaran magang.</p>
                    <a href="{{ route('daftar.form') }}" class="mt-4 inline-block text-pn-maroon hover:underline">
                        &larr; Ajukan Pendaftaran Sekarang
                    </a>
                </div>
            @endif

            {{-- Tampilkan Hasil (jika $applicant ada) --}}
            @if (isset($applicant))
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ $applicant->nama_lengkap }}</h2>

                <div class="space-y-4">

                    {{-- Status Card --}}
                    <div
                        class="p-4 rounded-lg text-center 
                    @if ($applicant->status == 'accepted') bg-green-100 text-green-800 border-l-4 border-green-500
                    @elseif ($applicant->status == 'rejected') bg-red-100 text-red-800 border-l-4 border-red-500
                    @else bg-yellow-100 text-yellow-800 border-l-4 border-yellow-500 @endif">
                        <p class="text-sm font-semibold uppercase">Status Keputusan Admin</p>
                        <p class="text-3xl font-extrabold mt-1">
                            @if ($applicant->status == 'accepted')
                                DITERIMA
                            @elseif ($applicant->status == 'rejected')
                                DITOLAK
                            @else
                                MENUNGGU REVIEW
                            @endif
                        </p>
                    </div>

                    {{-- Detail Table --}}
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <table class="w-full text-sm text-left text-gray-700">
                            <tbody>
                                <tr class="border-b">
                                    <th class="py-2 font-medium">Institusi (Prodi)</th>
                                    <td class="py-2">{{ $applicant->asal_institusi }} ({{ $applicant->program_studi }})
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th class="py-2 font-medium">Nomor HP</th>
                                    <td class="py-2">{{ $applicant->nomor_hp }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="py-2 font-medium">Tgl. Pengajuan Masuk</th>
                                    <td class="py-2">
                                        {{ $applicant->created_at ? $applicant->created_at->format('d M Y, H:i') : '-' }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th class="py-2 font-medium">Tgl. Keputusan Dibuat</th>
                                    <td class="py-2 font-semibold">
                                        {{ $applicant->tanggal_keputusan ? $applicant->tanggal_keputusan->format('d M Y') : 'Belum ada keputusan' }}
                                    </td>
                                </tr>
                                @if ($applicant->status != 'pending')
                                    <tr>
                                        <th class="py-2 font-medium">Keterangan Admin</th>
                                        <td class="py-2 italic">{{ $applicant->alasan_admin ?? '-' }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Download Link (if accepted) --}}
                    @if ($applicant->status == 'accepted' && $applicant->surat_keputusan_path)
                        <div class="mt-6 text-center">
                            <a href="{{ route('admin.download.file', ['fileType' => 'keputusan', 'id' => $applicant->id]) }}"
                                class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300 shadow-lg block w-full md:inline-block md:w-auto">
                                Unduh Surat Keputusan Resmi (PDF)
                            </a>
                        </div>
                    @endif
                </div>

            @endif

        </div>
    </div>

@endsection
