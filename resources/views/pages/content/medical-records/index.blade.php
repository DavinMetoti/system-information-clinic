@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Patients', 'url' => '#']
    ]" />


    <div class="card w-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Medical Record</h3>
                    <p class="mb-0 text-muted">
                        Manage your patients' medical records, complaints, diagnoses, treatments, and prescriptions.
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="medical-record_table" class="table table-sm table-striped fs-9 mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Patient</th>
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

    <script>
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
                            data: 'user.name',
                            name: 'user.name',
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
                        doctor_id: "{{ auth()->id() }}",
                        _token: "{{ csrf_token() }}"
                    }
                }
            });
        });
    </script>
@endsection
