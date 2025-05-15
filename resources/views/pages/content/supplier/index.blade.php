@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Suppliers', 'url' => '#']
    ]" />


    <div class="card w-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Suppliers Management</h3>
                    <p>Manage suppliers and add new ones.</p>
                </div>
                <button class="btn btn-primary" id="btn-suppliers-add"><i class="fas fa-plus me-2"></i>Add Supplier</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive min-vh-50">
                <table id="suppliers_table" class="table table-sm table-striped fs-9 mb-0 custom-table w-100">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
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
            suppliersApi: "{{ route('app.suppliers.index') }}",
            suppliersEdit: "{{ route('app.suppliers.edit', ['supplier' => 'SUPPLIER_ID']) }}",
            suppliersCreate: "{{ route('app.suppliers.create') }}"
        };

        const getStatusBadge = (isActive) => {
            const badgeClass = isActive ? 'success' : 'danger';
            const label = isActive ? 'Active' : 'Inactive';

            return `<div class="text-center"><span class="badge badge-phoenix badge-phoenix-${badgeClass}">${label}</span></div>`;
        };

        $(document).ready(function () {
            new App.TableManager({
                csrfToken: "{{ csrf_token() }}",
                restApi: urls.suppliersApi,
                entity: "suppliers",
                datatable: {
                    api: urls.suppliersApi,
                    columns: [
                        {
                            data: 'logo',
                            name: 'logo',
                            orderable: false,
                            width: '10%',
                            render: function (data, type, row) {
                                if (data) {
                                    if (row.logo_extentions === 'svg') {
                                        return `<img src="data:image/svg+xml;base64,${data}" alt="Logo" style="max-width: 50px;">`;
                                    } else {
                                        return `<img src="data:image/${row.logo_extentions};base64,${data}" alt="Logo" style="max-width: 50px;">`;
                                    }
                                }
                                else {
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
                            }
                        },
                        { data: 'name', name: 'name' },
                        { data: 'description', name: 'description' },
                        {
                            data: 'is_active',
                            name: 'is_active',
                            orderable: false,
                            width: '10%',
                            render: getStatusBadge
                        },
                        {
                            data: null,
                            orderable: false,
                            width: '5%',
                            render: function (data, type, row) {
                                return `
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                            <i class="fas fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" stye="z-index: 9999">
                                            <li>
                                                <a class="dropdown-item btn-suppliers-show" href="#" data-id="${row.id}">
                                                    <i class="fas fa-eye me-2 text-secondary"></i> Show
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item btn-suppliers-edit" href="#" data-id="${row.id}">
                                                    <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item btn-suppliers-delete" href="#" data-id="${row.id}">
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
                    show: function () {

                    },
                    edit: function () {

                    },
                    add: function () {
                        window.location.href = urls.suppliersCreate;
                    },
                    delete: function ({ id }) {
                        console.log("Custom delete for id:", id);
                    },
                    'edit_form.before_shown': function (data) {
                        console.log("Edit form data:", data);
                    }
                }
            });
        });
    </script>

@endsection
