@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Specialization', 'url' => '#']
    ]" />


    <div class="card w-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Specialization Management</h3>
                    <p>Manage specializations and add new specializations.</p>
                </div>
                <button class="btn btn-primary" id="btn-specialization-add"><i class="fas fa-plus me-2"></i>Add Specialization</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="specialization_table" class="table table-sm table-striped fs-9 mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Description
                            </th>
                            <th class="text-center">
                                Slug
                            </th>
                            <th></th>
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
            specializationApi: "{{ route('admin.specialization.index') }}",
            specializationEdit: "{{ route('admin.specialization.edit', ['specialization' => 'SPECIALIZATION_ID']) }}",
            specializationCreate: "{{ route('admin.specialization.create') }}"
        };

        $(document).ready(function () {
            new App.TableManager({
                csrfToken: "{{ csrf_token() }}",
                restApi: urls.specializationApi,
                entity: "specialization",
                datatable: {
                    api: urls.specializationApi,
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'description', name: 'description' },
                        {
                            data: 'slug',
                            name: 'slug',
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
                                                <a class="dropdown-item btn-specialization-edit" href="#" data-id="${row.id}">
                                                    <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item btn-specialization-delete" href="#" data-id="${row.id}">
                                                    <i class="fas fa-trash-alt me-2 text-danger"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                `;
                            }
                        }
                    ]
                },
                on: {
                    edit: function () {

                    },
                    add: function () {
                        window.location.href = urls.specializationCreate;
                    },
                    delete: function ({ id }) {
                        console.log("Delete specialization with ID:", id);
                    },
                    'edit_form.before_shown': function (data) {
                        console.log("Edit form data:", data);
                    }
                }
            });
        });
    </script>

@endsection
