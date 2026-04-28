@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-calendar3 me-2"></i>Jadwal Keberangkatan Bus</h4>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Tambah Jadwal
    </a>
</div>

<div class="card p-3">
    <table class="table table-hover align-middle">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Jam Berangkat</th>
                <th>Rute</th>
                <th>Bus</th>
                <th>Driver</th>
                <th>Hari</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}</strong></td>
                <td>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</td>
                <td>{{ $schedule->bus->plate_number }} ({{ $schedule->bus->bus_type }})</td>
                <td>{{ $schedule->bus->driver->driver_name }}</td>
                <td>
                    @if($schedule->days == 'everyday')
                        <span class="badge bg-success">Setiap Hari</span>
                    @elseif($schedule->days == 'weekday')
                        <span class="badge bg-primary">Hari Kerja</span>
                    @else
                        <span class="badge bg-warning text-dark">Akhir Pekan</span>
                    @endif
                </td>
                <td>
                    @if($schedule->status == 'active')
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin hapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">Belum ada jadwal tersedia</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection