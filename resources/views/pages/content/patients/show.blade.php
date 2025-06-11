@extends('pages.content.index')

@section('main')
<x-breadcrumb :items="[
        ['title' => 'Pasien', 'url' => route('doctor.patient.index')],
        ['title' => 'Detail Pasien', 'url' => '#']
    ]" />
<div class="row align-items-center justify-content-between g-3 mb-4">
    <div class="col-auto">
        <h2 class="mb-0">Profile</h2>
    </div>
    <div class="col-auto">
        <div class="row g-2 g-sm-3">
            <div class="col-auto">
                <a href="{{ route('doctor.medical-record.create', ['patient_id' => $patient->id]) }}" class="btn btn-phoenix-primary">
                    <span class="fas fa-plus me-2"></span>Add Medical Record
                </a>
            </div>
        </div>
    </div>
</div>
<div id="skeleton-loader">
    <div class="placeholder-glow">
        <div class="row">
            <div class="col-md-8">
                <span class="placeholder col-12 mb-2" style="height: 20rem;"></span>
            </div>
            <div class="col-md-4">
                <span class="placeholder col-12 mb-2" style="height: 20rem;"></span>
            </div>
            <div class="col-md-12 mt-5">
                <span class="placeholder col-12 mb-2" style="height: 20rem;"></span>
            </div>
            <div class="placeholder-glow">
                <span class="placeholder col-12 mb-2" style="height: 12rem;"></span>
            </div>
        </div>
    </div>
</div>

{{-- ...existing code... --}}
<div id="actual-content" style="display: none;">
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-8">
            <div class="card h-100">
                <div class="card-body">
                    <div class="border-bottom border-dashed pb-4">
                        <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">
                            <div class="col-12 col-sm-auto">
                                <input class="d-none" id="avatarFile" type="file">
                                <label class="cursor-pointer avatar avatar-5xl" for="avatarFile">
                                    <img class="" id="logo-patient" alt="" src="{{ $patient->avatar ?? '/default-avatar.png' }}">
                                </label>
                            </div>
                            <div class="col-12 col-sm-auto flex-1">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <h3>{{ $patient->name }}</h3>
                                        <p class="text-body-secondary mb-1">Registered {{ $patient->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div>
                                        <span class="me-2">
                                            <i class="fas fa-envelope me-2"></i> {{ $patient->email }}
                                        </span>
                                        @if($patient->contact)
                                        <span class="me-2">
                                            <i class="fas fa-phone me-2"></i> {{ $patient->contact }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-between-center pt-4">
                        <div>
                            <h4 class="mb-2 text-body-secondary">Address</h4>
                            <p class="fs-8 text-muted mb-0">{{ $patient->address ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="border-bottom border-dashed">
                        <h4 class="mb-3">Patient Details</h4>
                    </div>
                    <div class="pt-4">
                        <div class="col-lg-12 d-flex align-items-stretch">
                            <div class="w-100 h-100 border-0 d-flex align-items-start justify-content-center bg-transparent" style="background: none;">
                                <div style="width:100%;max-width:100%;">
                                    <div class="bpjs-card-responsive" style="
                                        background: linear-gradient(135deg, #21b68f 60%, #1e9e74 100%);
                                        border-radius: 18px;
                                        box-shadow: 0 4px 24px rgba(33,182,143,0.15);
                                        padding: 1.5rem 1.5rem 1rem 1.5rem;
                                        position: relative;
                                        min-height: 200px;
                                    ">
                                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
                                            <img src="{{ asset('assets/img/garuda.png') }}" alt="BPJS Logo" style="height:28px;max-width:80px;">
                                            <span class="text-white fw-bold" style="font-size:1rem;">BPJS Kesehatan</span>
                                        </div>
                                        <div class="text-white fw-bold mt-3" style="font-size:1.1rem;letter-spacing:2px;word-break:break-all;">
                                            {{ $patient->pasien->bpjs_number ?? '0000 0000 0000 0000' }}
                                        </div>
                                        <div class="mt-3">
                                            <div class="row gx-2">
                                                <div class="col-12 col-sm-6">
                                                    <div class="text-white-50" style="font-size:0.85rem;">Nama Peserta</div>
                                                    <div class="text-white fw-semibold" style="font-size:1rem;word-break:break-word;">{{ $patient->name }}</div>
                                                </div>
                                                <div class="col-12 col-sm-6 text-sm-end mt-2 mt-sm-0">
                                                    <div class="text-white-50" style="font-size:0.85rem;">Nomor Pasien</div>
                                                    <div class="text-white fw-semibold" style="font-size:1rem;">{{ $patient->pasien->pasien_number ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        @media (max-width: 576px) {
                                            .bpjs-card-responsive {
                                                padding: 1rem 0.7rem 0.7rem 0.7rem !important;
                                                min-height: 120px !important;
                                            }
                                            .bpjs-card-responsive .fw-bold,
                                            .bpjs-card-responsive .fw-semibold {
                                                font-size: 0.95rem !important;
                                            }
                                            .bpjs-card-responsive .text-white-50 {
                                                font-size: 0.8rem !important;
                                            }
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-dashed pt-4 mt-4">
                        <div class="row flex-between-center mb-3">
                            <div class="col-auto">
                                <h5 class="text-body-highlight" style="font-size:1rem;">Date of Birth</h5>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-body-secondary" style="font-size:0.97rem;">{{ $patient->pasien->date_of_birth ? \Carbon\Carbon::parse($patient->pasien->date_of_birth)->format('d M Y') : '-' }}</h6>
                            </div>
                        </div>
                        <div class="row flex-between-center mb-3">
                            <div class="col-auto">
                                <h5 class="text-body-highlight" style="font-size:1rem;">Place of Birth</h5>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-body-secondary" style="font-size:0.97rem;">{{ $patient->pasien->place_of_birth ?? '-' }}</h6>
                            </div>
                        </div>
                        <div class="row flex-between-center mb-3">
                            <div class="col-auto">
                                <h5 class="text-body-highlight" style="font-size:1rem;">Blood Type</h5>
                            </div>
                            <div class="col-auto">
                                <h6 class="text-body-secondary" style="font-size:0.97rem;">{{ $patient->pasien->blood_type ?? '-' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                <div class="scrollbar">
                    <ul class="nav nav-underline fs-9 flex-nowrap mb-3 pb-1" id="myTab" role="tablist">
                        <li class="nav-item me-3" role="presentation">
                            <a class="nav-link text-nowrap active" id="medical-records-tab" data-bs-toggle="tab" href="#tab-medical-records" role="tab" aria-controls="tab-medical-records" aria-selected="true">
                                <span class="fas fa-clipboard me-2"></span>
                                Medical Record
                                <span class="text-body-tertiary fw-normal">
                                    ({{ $patient->medicalRecords()->count() }})
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade active show" id="tab-medical-records" role="tabpanel" aria-labelledby="medical-records-tab">
                        <div class="border-top border-bottom border-translucent" id="profileMedicalRecordsTable">
                            <div class="table-responsive scrollbar">
                                <table id="medical-record_table" class="table table-sm table-striped fs-9 mb-0 custom-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Doctor</th>
                                            <th>Complaint</th>
                                            <th>Diagnosis</th>
                                            <th>Treatment</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <!-- Rows will be populated by DataTables -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const patient = @json($patient);

    $(document).ready(function() {
        const $logoElement = $('#logo-patient');

        const avatar = new App.LetterAvatar(patient.name);
        const avatarData = avatar.getAvatarWithColor();
        $logoElement.replaceWith(`
            <div style="background-color: ${avatarData.backgroundColor};
                width: 100%; height: 100%;
                border-radius: 50%;
                display: flex; justify-content: center; align-items: center;
                color: white; font-size: 5rem;">
                ${avatarData.initials}
            </div>
        `);
    });

    const urls = {
        medicalRecordApi: "{{ route('doctor.medical-record.index') }}",
        medicalRecordShow: "{{ route('doctor.medical-record.show', ['medical_record' => 'RECORD_ID']) }}",
        medicalRecordEdit: "{{ route('doctor.medical-record.edit', ['medical_record' => 'RECORD_ID']) }}"
    };

    $(document).ready(function () {
        new App.TableManager({
            csrfToken: "{{ csrf_token() }}",
            restApi: urls.medicalRecordApi,
            entity: "medical-record",
            datatable: {
                api: urls.medicalRecordApi,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date',
                        render: function(data) {
                            return data ? moment(data).format('D MMM YYYY') : '-';
                        }
                    },
                    {
                        data: 'doctor.name',
                        name: 'doctor.name',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'complaint',
                        name: 'complaint',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'diagnosis',
                        name: 'diagnosis',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'treatment',
                        name: 'treatment',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            if (!data) return '-';
                            let badgeClass = 'badge bg-secondary';
                            if (data === 'done') badgeClass = 'badge bg-success';
                            else if (data === 'process') badgeClass = 'badge bg-warning text-dark';
                            else if (data === 'end') badgeClass = 'badge bg-danger';
                            return `<span class="${badgeClass}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: "text-center",
                        render: function (data, type, row) {
                            const showUrl = urls.medicalRecordShow.replace('RECORD_ID', row.id);
                            const editUrl = urls.medicalRecordEdit.replace('RECORD_ID', row.id);
                            return `
                                <a class="btn btn-sm btn-info" href="${showUrl}" title="View"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-sm btn-warning" href="${editUrl}" title="Edit"><i class="fa fa-edit"></i></a>
                            `;
                        }
                    }
                ],
                ajaxData: {
                    patient_id: "{{ $patient->id }}",
                    _token: "{{ csrf_token() }}"
                }
            }
        });
    });
</script>
@endsection
