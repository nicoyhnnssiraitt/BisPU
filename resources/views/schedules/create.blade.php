@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Jadwal</h4>
    <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card p-4">
    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Bus</label>
            <select name="bus_id" class="form-select @error('bus_id') is-invalid @enderror">
                <option value="">-- Pilih Bus --</option>
                @foreach($buses as $bus)
                    <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                        {{ $bus->plate_number }} ({{ $bus->bus_type }}) - {{ $bus->driver->driver_name }}
                    </option>
                @endforeach
            </select>
            @error('bus_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Rute</label>
            <select name="route_id" class="form-select @error('route_id') is-invalid @enderror">
                <option value="">-- Pilih Rute --</option>
                @foreach($routes as $route)
                    <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                        {{ $route->origin }} → {{ $route->destination }} ({{ $route->estimated_duration }} menit)
                    </option>
                @endforeach
            </select>
            @error('route_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jam Berangkat</label>
            <input type="time" name="departure_time" class="form-control @error('departure_time') is-invalid @enderror"
                value="{{ old('departure_time') }}">
            @error('departure_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Hari</label>
            <select name="days" class="form-select @error('days') is-invalid @enderror">
                <option value="everyday" {{ old('days') == 'everyday' ? 'selected' : '' }}>Setiap Hari</option>
                <option value="weekday" {{ old('days') == 'weekday' ? 'selected' : '' }}>Hari Kerja</option>
                <option value="weekend" {{ old('days') == 'weekend' ? 'selected' : '' }}>Akhir Pekan</option>
            </select>
            @error('days') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-save me-1"></i>Simpan Jadwal
        </button>
    </form>
</div>
@endsection