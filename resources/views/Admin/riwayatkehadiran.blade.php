@extends('layouts.sidebar')

@section('content')
    <div class="content">
        <!-- ... (Kode Navbar) ... -->

        <form action="{{ route('riwayatkehadiran') }}" method="get" class="my-3">
            <div class="row">
                <div class="col-md-3">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal', session('tanggal')) }}"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="bulan">Bulan:</label>
                    <select name="bulan" class="form-control">
                        <option value="" selected>Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}"
                                {{ request('bulan', session('bulan')) == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="tahun">Tahun:</label>
                    <select name="tahun" class="form-control">
                        <option value="" selected>Pilih Tahun</option>
                        @for ($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}"
                                {{ request('tahun', session('tahun')) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-1 mt-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <table class="table mt-1 ms-1">
            <thead class="table-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama siswa</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Jurusan</th>
                    <th class="text-center">Status Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatKehadiran as $absis)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $absis->user->name }}</td>
                        <td class="text-center">{{ $absis->kelas->tingkat_kelas }}</td>
                        <td class="text-center">{{ $absis->kelas->jurusan }}</td>
                        <td class="text-center">{{ $absis->status_kehadiran }}</td>
                        <td class="text-center">
                            <!-- Tambahkan tombol atau aksi lain sesuai kebutuhan -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
