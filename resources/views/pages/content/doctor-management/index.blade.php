@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Doctor Management', 'url' => '#']
    ]" />


    <div class="card w-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Doctor Management</h3>
                    <p>Manage doctors and add new doctors.</p>
                </div>
                <button class="btn btn-primary" id="btn-doctor-add"><i class="fas fa-plus me-2"></i>Add Doctor</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="doctor_table" class="table table-sm table-striped fs-9 mb-0 custom-table">
                    <thead>
                        <tr>
                            <th class="text-start">
                                <!-- Avatar/Logo -->
                            </th>
                            <th class="text-start">
                                Register
                            </th>
                            <th class="text-start">
                                Name
                            </th>
                            <th class="text-start">
                                Specialization
                            </th>
                            <th class="text-start">
                                License Number
                            </th>
                            <th class="text-start">
                                Email
                            </th>
                            <th class="text-start">
                                Contact
                            </th>
                            <th class="text-start"></th>
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
            doctorApi: "{{ route('admin.doctor-management.index') }}",
            doctorEdit: "{{ route('admin.doctor-management.edit', ['doctor_management' => 'DOCTOR_ID']) }}",
            doctorCreate: "{{ route('admin.doctor-management.create') }}"
        };

        $(document).ready(function () {
            new App.TableManager({
                csrfToken: "{{ csrf_token() }}",
                restApi: urls.doctorApi,
                entity: "doctor",
                datatable: {
                    api: urls.doctorApi,
                    columns: [
                        {
                            data: null,
                            name: 'logo',
                            orderable: false,
                            width: '10%',
                            render: function (data, type, row) {
                                const avatar = new App.LetterAvatar(row.name);
                                const avatarData = avatar.getAvatarWithColor();
                                return `
                                    <div style="background-color: ${avatarData.backgroundColor};
                                        width: 50px; height: 50px;
                                        border-radius: 50%;
                                        display: flex; justify-content: center; align-items: center;
                                        color: white; font-size: 20px;">
                                        ${avatarData.initials}
                                    </div>
                                `;
                            }
                        },
                        {
                            data: 'doctor.registration_number',
                            name: 'doctor.registration_number',
                            orderable: false,
                            className: 'text-start',
                            render: function(data) {
                                return `<span class="d-inline-block text-start" style="min-width:120px;">${data ? data : '-'}</span>`;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'doctor.specialization.name',
                            name: 'doctor.specialization.name',
                            orderable: false,
                        },
                        {
                            data: 'doctor.license_number',
                            name: 'doctor.license_number',
                            orderable: false,
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'contact',
                            name: 'contact',
                            orderable: false,
                            width: '15%',
                        },
                        {
                            data: null,
                            orderable: false,
                            width: '5%',
                            render: function (data, type, row) {
                                return `
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item btn-doctor-edit" href="#" data-id="${row.id}">
                                                    <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item btn-doctor-delete" href="#" data-id="${row.id}">
                                                    <i class="fas fa-trash-alt me-2 text-danger"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                `;
                            }
                        }
                    ],
                    order: [[2, 'asc']],
                },
                on: {
                    edit: function () {

                    },
                    add: function () {
                        window.location.href = urls.doctorCreate;
                    },
                    delete: function ({ id }) {
                        console.log("Delete doctor with ID:", id);
                    },
                    'edit_form.before_shown': function (data) {
                        console.log("Edit form data:", data);
                    }
                }
            });
        });
    </script>

@endsection
