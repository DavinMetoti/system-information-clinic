@extends('pages.content.index')

@section('main')
<x-breadcrumb :items="[
    ['title' => 'Medical Records', 'url' => route('doctor.medical-record.index')],
    ['title' => 'Detail', 'url' => '#']
]" />

<div class="row g-4">
    <div class="col-12 mx-auto">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body px-4 py-4">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="mb-2 text-muted small">Patient</div>
                        <div class="fw-bold fs-5 mb-3">{{ $medicalRecord->user->name ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2 text-muted small">Doctor</div>
                        <div class="fw-bold fs-5 mb-3">{{ $medicalRecord->doctor->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-2 text-muted small">Date</div>
                        <div class="fw-semibold">{{ $medicalRecord->date ? \Carbon\Carbon::parse($medicalRecord->date)->format('d M Y') : '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2 text-muted small">Status</div>
                        @php
                            $badge = 'secondary';
                            if ($medicalRecord->status === 'done') $badge = 'success';
                            elseif ($medicalRecord->status === 'process') $badge = 'warning text-dark';
                            elseif ($medicalRecord->status === 'end') $badge = 'danger';
                        @endphp
                        <span class="badge bg-{{ $badge }} px-3 py-1" style="font-size:1rem;">
                            {{ ucfirst($medicalRecord->status) }}
                        </span>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-2 text-muted small">Complaint</div>
                        <div class="mb-3">{{ $medicalRecord->complaint ?? '-' }}</div>
                        <div class="mb-2 text-muted small">Diagnosis</div>
                        <div class="mb-3">{{ $medicalRecord->diagnosis ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2 text-muted small">Treatment</div>
                        <div class="mb-3">{{ $medicalRecord->treatment ?? '-' }}</div>
                        <div class="mb-2 text-muted small">Notes</div>
                        <div class="mb-3">{{ $medicalRecord->notes ?? '-' }}</div>
                    </div>
                </div>
                <hr class="my-4">
                <div>
                    <div class="mb-2 text-muted small">Prescription</div>
                    @if($medicalRecord->prescription)
                        @php
                            $prescriptions = json_decode($medicalRecord->prescription, true);
                        @endphp
                        <div class="border rounded-2 p-3 bg-white" style="max-width: 100%;">
                            @foreach($prescriptions as $item)
                                <div class="mb-3 pb-2 border-bottom" style="font-size:1.05rem;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">{{ $item['name'] ?? '-' }}</span>
                                        <span class="badge bg-primary">{{ $item['amount'] ?? '-' }} {{ $item['unit'] ?? '-' }}</span>
                                    </div>
                                    <div class="text-muted mt-1" style="font-size:0.97rem;">
                                        {{ $item['rule'] ?? '-' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted">-</div>
                    @endif
                </div>
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('doctor.medical-record.edit', $medicalRecord->id) }}" class="btn btn-warning px-4">
                        <span class="fw-semibold">Edit</span>
                    </a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">
                        <span class="fw-semibold">Back</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
