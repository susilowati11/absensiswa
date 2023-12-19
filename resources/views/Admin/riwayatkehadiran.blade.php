@extends('layouts.sidebar')

@section('content')
    <div class="content">
        <!-- ... (Kode Navbar) ... -->

        <form action="{{ route('riwayatkehadiran') }}" method="get" class="my-3">
            <div class="row">
                <div class="col-md-2">
                    <label for="hari">Pilih Hari:</label>
                    <select name="hari" id="hari" class="form-control">
                        @for ($day = 1; $day <= 31; $day++)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="bulan">Pilih Bulan:</label>
                    <select name="bulan" id="bulan" class="form-control">
                        @for ($month = 1; $month <= 12; $month++)
                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="tahun">Pilih Tahun:</label>
                    <select name="tahun" id="tahun" class="form-control">
                        @for ($year = date('Y'); $year >= 2020; $year--)  <!-- Sesuaikan dengan tahun awal yang diinginkan -->
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
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
