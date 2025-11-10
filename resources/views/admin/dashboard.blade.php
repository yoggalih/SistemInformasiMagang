@extends('layouts.app')

@section('title', 'Dashboard Admin - PN Klaten')

@section('content')

    @php
        // Memastikan data admin tersedia
        $admin = Auth::user();
    @endphp

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-4xl font-bold text-pn-maroon mb-6">Dashboard Admin</h1>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- 0. BLOK PROFIL ADMIN --}}
        <div class="bg-white p-5 rounded-lg shadow-lg mb-8 border-l-4 border-pn-maroon">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Profil Admin</h2>
                    <p class="text-sm text-gray-600 mt-2">Nama: <span class="font-medium">{{ $admin->name ?? 'N/A' }}</span>
                    </p>
                    <p class="text-sm text-gray-600">Email: <span class="font-medium">{{ $admin->email ?? 'N/A' }}</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">ID Pengguna: #{{ $admin->id ?? 'N/A' }}</p>
                </div>

                {{-- Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition duration-150 shadow">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>


        {{-- 1. Blok Statistik Ringkas --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-pn-maroon">
                <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalApplicants }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-yellow-500">
                <p class="text-sm font-medium text-gray-500">Menunggu Keputusan</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalPending }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-green-500">
                <p class="text-sm font-medium text-gray-500">Diterima</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalAccepted }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-red-500">
                <p class="text-sm font-medium text-gray-500">Ditolak</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalRejected }}</p>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Daftar Pelamar Magang</h2>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama &
                            Institusi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email &
                            HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File
                            Pelamar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi
                            Magang
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hapus
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($applicants as $applicant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $applicant->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $applicant->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500">{{ $applicant->asal_institusi }}
                                    ({{ $applicant->program_studi }})
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $applicant->email }}</div>
                                <div class="text-xs text-gray-500">{{ $applicant->nomor_hp }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                {{-- <a href="{{ route('admin.download.file', ['fileType' => 'pengantar', 'id' => $applicant->id]) }}"
                                    class="text-blue-600 hover:text-blue-900" target="_blank">
                                    Unduh Surat
                                </a> --}}

                                <a href="{{ route('admin.download.file', ['fileType' => 'pengantar', 'id' => $applicant->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    Download
                                </a>

                            </td>
                            {{-- KOLOM DURASI MAGANG [BARU] --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-left">
                                @if ($applicant->tanggal_mulai && $applicant->tanggal_selesai)
                                    @php
                                        $startDate = \Carbon\Carbon::parse($applicant->tanggal_mulai);
                                        $endDate = \Carbon\Carbon::parse($applicant->tanggal_selesai);
                                        // Menghitung hari (ditambah 1 karena diffInDays hanya menghitung selisih antara 2 titik)
                                        $durationDays = $startDate->diffInDays($endDate) + 1;
                                        $durationMonths = $startDate->diffInMonths($endDate);
                                    @endphp
                                    <div class="font-medium text-gray-900">{{ $startDate->format('d M Y') }} -
                                        {{ $endDate->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Total: {{ $durationDays }} hari
                                        @if ($durationMonths > 0)
                                            ({{ $durationMonths }} bulan)
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-500 text-xs italic">Tanggal tidak tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $statusColor =
                                        [
                                            'pending' => 'yellow',
                                            'accepted' => 'green',
                                            'rejected' => 'red',
                                        ][$applicant->status] ?? 'gray';
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                    {{ ucfirst($applicant->status) }}
                                </span>
                                @if ($applicant->status === 'rejected' && $applicant->alasan_admin)
                                    <div class="text-xs text-gray-500 mt-1 italic" title="{{ $applicant->alasan_admin }}">
                                        Cooldown:
                                        {{ preg_match('/\[COOLDOWN:(\d+)\]/i', $applicant->alasan_admin, $matches) ? $matches[1] . ' Hari' : '?' }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                @if ($applicant->status === 'pending')
                                    {{-- Tombol Proses (membuka Modal) --}}
                                    <button onclick="showProcessModal('{{ $applicant->id }}')"
                                        class="bg-pn-maroon text-white px-3 py-1 rounded-md text-xs bg-red-800 
           hover:bg-red-700 hover:scale-105 cursor-pointer transition-all duration-200">
                                        Proses Keputusan
                                    </button>
                                @elseif ($applicant->status === 'accepted' && $applicant->surat_keputusan_path)
                                    <a href="{{ route('admin.download.file', ['fileType' => 'keputusan', 'id' => $applicant->id]) }}"
                                        class="text-green-600 hover:text-green-900 text-xs">
                                        Unduh SK
                                    </a>
                                @else
                                    <span class="text-gray-500 text-xs italic">Sudah diproses</span>
                                @endif
                            </td>
                            {{-- KOLOM HAPUS --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                @if ($applicant->status !== 'pending')
                                    <button onclick="showDeleteModal('{{ $applicant->id }}')"
                                        class="text-red-600 hover:text-red-900 text-xs px-3 py-1 border border-red-600 rounded-md hover:bg-red-50">
                                        Hapus
                                    </button>
                                @else
                                    <span class="text-gray-400 text-xs">Tunggu Keputusan</span>
                                @endif
                            </td>
                        </tr>

                        {{-- MODAL PROSES KEPUTUSAN --}}
                        <div id="modal-{{ $applicant->id }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="absolute inset-0 bg-gray-900 opacity-75" aria-hidden="true"></div>

                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                    aria-hidden="true">&#8203;</span>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full relative z-50">

                                    <form action="{{ route('admin.applicant.process', $applicant->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Keputusan untuk
                                                {{ $applicant->nama_lengkap }}</h3>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700">Keputusan:</label>
                                                <select name="status" id="status-{{ $applicant->id }}" required
                                                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon"
                                                    onchange="toggleDecisionFields('{{ $applicant->id }}')">
                                                    <option value="accepted">Setuju (Terima)</option>
                                                    <option value="rejected">Tolak (Reject)</option>
                                                </select>
                                            </div>

                                            {{-- FIELD KONDISIONAL (Accept: Upload SK) --}}
                                            <div id="field-accept-{{ $applicant->id }}" class="mb-4">
                                                <label for="surat_keputusan-{{ $applicant->id }}"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Upload Surat
                                                    Keputusan Penerimaan (PDF):</label>
                                                <input type="file" name="surat_keputusan"
                                                    id="surat_keputusan-{{ $applicant->id }}" accept=".pdf"
                                                    class="mt-1 w-full text-gray-600 border border-gray-300 rounded-md p-2">
                                                <p class="text-xs text-gray-500 mt-1 text-red-600">Wajib diunggah jika
                                                    status: DITERIMA.</p>
                                            </div>

                                            {{-- FIELD KONDISIONAL (Reject: Cooldown) --}}
                                            <div id="field-reject-{{ $applicant->id }}" class="hidden mb-4">
                                                <label class="block text-sm font-medium text-gray-700">Tipe Cooldown
                                                    Pendaftaran Ulang:</label>
                                                <select name="cooldown_days" id="cooldown-days-{{ $applicant->id }}"
                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 text-sm">
                                                    <option value="">-- Pilih Tipe Penolakan --</option>
                                                    @foreach ($rejectionOptions as $days => $description)
                                                        <option value="{{ $days }}">{{ $description }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-xs text-gray-500 mt-1 text-red-600">Wajib diisi jika status:
                                                    DITOLAK.</p>
                                            </div>

                                            {{-- Alasan/Keterangan --}}
                                            <div class="mb-4">
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Alasan/Keterangan:</label>
                                                <textarea name="alasan_admin" id="alasan-admin-{{ $applicant->id }}" rows="2"
                                                    placeholder="Masukkan alasan keputusan (Otomatis ditambahkan tag cooldown jika Ditolak)"
                                                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-pn-maroon focus:ring-pn-maroon"></textarea>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="submit"
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pn-maroon text-base font-medium text-white bg-red-800 sm:ml-3 sm:w-auto sm:text-sm">
                                                Simpan Keputusan
                                            </button>
                                            <button type="button" onclick="hideProcessModal('{{ $applicant->id }}')"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-200 sm:mt-0 sm:w-auto sm:text-sm">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL KONFIRMASI HAPUS --}}
                        <div id="delete-modal-{{ $applicant->id }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                                </div>

                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                    aria-hidden="true">&#8203;</span>

                                <div
                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-50">
                                    <form action="{{ route('admin.applicant.delete', $applicant->id) }}" method="POST">
                                        @csrf
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div
                                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.86 12.31A2 2 0 0116.14 21H7.86a2 2 0 01-1.98-1.69L5 7m4 0V5a2 2 0 012-2h2a2 2 0 012 2v2M8 7h8" />
                                                    </svg>
                                                </div>
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                        id="modal-headline">
                                                        Hapus Lamaran Permanen
                                                    </h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            Anda yakin ingin menghapus lamaran magang dari
                                                            **{{ $applicant->nama_lengkap }}**?
                                                            <br>
                                                            **Semua data dan file terkait akan dihapus secara permanen.**
                                                            Pelamar ini akan bisa mengajukan lamaran baru.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="submit"
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                                                Ya, Hapus Permanen
                                            </button>
                                            <button type="button" onclick="hideDeleteModal('{{ $applicant->id }}')"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada pengajuan magang
                                baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $applicants->links() }}
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        function showProcessModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            document.documentElement.classList.add('overflow-hidden');
            toggleDecisionFields(id);
        }

        function hideProcessModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.documentElement.classList.remove('overflow-hidden');
        }

        // Fungsi untuk menampilkan Modal Hapus
        function showDeleteModal(id) {
            document.getElementById('delete-modal-' + id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            document.documentElement.classList.add('overflow-hidden');
        }

        // Fungsi untuk menyembunyikan Modal Hapus
        function hideDeleteModal(id) {
            document.getElementById('delete-modal-' + id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.documentElement.classList.remove('overflow-hidden');
        }


        function toggleDecisionFields(id) {
            const statusSelect = document.getElementById('status-' + id);
            const fileAcceptDiv = document.getElementById('field-accept-' + id);
            const fileAcceptInput = fileAcceptDiv ? fileAcceptDiv.querySelector('input[name="surat_keputusan"]') : null;
            const rejectDiv = document.getElementById('field-reject-' + id);
            const cooldownSelect = document.getElementById('cooldown-days-' + id);
            const alasanTextarea = document.getElementById('alasan-admin-' + id);

            if (!statusSelect) return;

            if (statusSelect.value === 'accepted') {
                // ACCEPT mode
                fileAcceptDiv.classList.remove('hidden');
                if (fileAcceptInput) fileAcceptInput.required = true;

                rejectDiv.classList.add('hidden');
                if (cooldownSelect) cooldownSelect.removeAttribute('required');
                if (alasanTextarea) alasanTextarea.placeholder = "Masukkan keterangan tambahan (Opsional)";

            } else if (statusSelect.value === 'rejected') {
                // REJECT mode
                fileAcceptDiv.classList.add('hidden');
                if (fileAcceptInput) fileAcceptInput.required = false;

                rejectDiv.classList.remove('hidden');
                if (cooldownSelect) cooldownSelect.setAttribute('required', 'required');
                if (alasanTextarea) alasanTextarea.placeholder = "Masukkan alasan penolakan (Wajib diisi)";
            }
        }

        // Panggil toggle untuk semua modal saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // PASTIKAN SEMUA STATE KUNCI DIHAPUS SAAT HALAMAN DIMUAT
            document.body.classList.remove('overflow-hidden');
            document.documentElement.classList.remove('overflow-hidden');

            @foreach ($applicants as $applicant)
                toggleDecisionFields('{{ $applicant->id }}');
            @endforeach
        });
    </script>

@endsection
