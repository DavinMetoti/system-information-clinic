@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Categories', 'url' => '#']
    ]" />


    <div class="card w-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Category Management</h3>
                    <p>Manage categories and add new categories.</p>
                </div>
                <button class="btn btn-primary" id="btn-categories-add"><i class="fas fa-plus me-2"></i>Add Category</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="categories_table" class="table table-sm table-striped fs-9 mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Description
                            </th>
                            <th class="text-center">
                                Unit
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
            usersApi: "{{ route('app.categories.index') }}",
            usersEdit: "{{ route('app.categories.edit', ['category' => 'CATEGORY_ID']) }}",
            usersCreate: "{{ route('app.categories.create') }}"
        };

        const getRoleBadge = (role) => {
            const badgeMap = {
                admin: 'primary',
                cashier: 'secondary',
                warehouse: 'success',
                customer: 'info',
                guest: 'warning'
            };

            const badgeClass = badgeMap[role] || 'warning';
            const label = role ? role.charAt(0).toUpperCase() + role.slice(1) : 'Guest';

            return `<div class="text-center"><span class="badge badge-phoenix badge-phoenix-${badgeClass}">${label}</span></div>`;
        };

        $(document).ready(function () {
            new App.TableManager({
                csrfToken: "{{ csrf_token() }}",
                restApi: urls.usersApi,
                entity: "categories",
                datatable: {
                    api: urls.usersApi,
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'description', name: 'description' },
                        {
                            data: 'unit',
                            name: 'unit',
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
                                                <a class="dropdown-item btn-categories-edit" href="#" data-id="${row.id}">
                                                    <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item btn-categories-delete" href="#" data-id="${row.id}">
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
                        window.location.href = urls.usersCreate;
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
