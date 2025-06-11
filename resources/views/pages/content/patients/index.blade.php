@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Patients', 'url' => '#']
    ]" />


    <div class="card w-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Patients Management</h3>
                    <p>Manage patients.</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="patient_table" class="table table-sm table-striped fs-9 mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Pasien Number</th>
                            <th>BPJS Number</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Blood Type</th>
                            <th class="text-center"></th>
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
            patientApi: "{{ route('doctor.patient.index') }}",
            patientShow: "{{ route('doctor.patient.show', ['patient' => 'PATIENT_ID']) }}",
            patientEdit: "{{ route('doctor.patient.edit', ['patient' => 'PATIENT_ID']) }}",
            patientCreate: "{{ route('doctor.patient.create') }}"
        };

        $(document).ready(function () {
            new App.TableManager({
                csrfToken: "{{ csrf_token() }}",
                restApi: urls.patientApi,
                entity: "patient",
                datatable: {
                    api: urls.patientApi,
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta ? meta.row + 1 : (data ? data : '-');
                            }
                        },
                        {
                            data: 'name',
                            name: 'name',
                            render: function(data) {
                                return data ? data : '-';
                            }
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                            render: function(data) {
                                return data ? data.charAt(0).toUpperCase() + data.slice(1) : '-';
                            }
                        },
                        {
                            data: 'pasien.pasien_number',
                            name: 'pasien.pasien_number',
                            orderable: false,
                            render: function(data) {
                                return data ? data : '-';
                            }
                        },
                        {
                            data: 'pasien.bpjs_number',
                            name: 'pasien.bpjs_number',
                            orderable: false,
                            render: function(data) {
                                return data ? data : '-';
                            }
                        },
                        {
                            data: 'pasien.date_of_birth',
                            name: 'pasien.date_of_birth',
                            orderable: false,
                            render: function(data) {
                                if (!data) return '-';
                                return moment(data).format('D MMM YYYY');
                            }
                        },
                        {
                            data: 'pasien.date_of_birth',
                            name: 'age',
                            orderable: false,
                            render: function(data) {
                                if (!data) return '-';
                                var birth = moment(data);
                                var now = moment();
                                var age = now.diff(birth, 'years');
                                return age ? age + ' years' : '-';
                            }
                        },
                        {
                            data: 'pasien.blood_type',
                            name: 'pasien.blood_type',
                            orderable: false,
                            render: function(data) {
                                return data ? data : '-';
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                const showUrl = urls.patientShow.replace('PATIENT_ID', row.id);
                                return `
                                    <a class="btn btn-sm btn-primary edit-record" data-id="${row.id}" href="${showUrl}">
                                        <i class="fa fa-clipboard"></i> Record
                                    </a>
                                `;
                            }
                        }
                    ]
                }
            });
        });
    </script>
@endsection
