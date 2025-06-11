@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Specialization', 'url' => route('admin.specialization.index')],
        ['title' => 'Edit', 'url' => '#']
    ]" />

    <div class="card w-100">
        <div class="card-header pb-0">
            <h3>Edit Specialization</h3>
            <p>Update the form to edit the specialization.</p>
        </div>
        <div class="card-body">
            <form id="specialization_registration_form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $specialization->name }}" placeholder="Specialization Name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Specialization Description" required>{{ $specialization->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="slug">Slug</label>
                    <input class="form-control" type="text" id="slug" name="slug" value="{{ $specialization->slug }}" placeholder="Specialization Slug" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" data-mode="update">Update</button>
                </div>

                <div id="responseMessage"></div>
            </form>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            const specializationId = @json($specialization->id);
            let urls = {
                specializations: "{{ route('admin.specialization.update', ['specialization' => '__SPECIALIZATION_ID__']) }}".replace('__SPECIALIZATION_ID__', specializationId)
            };
            $('#specialization_registration_form').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let formHandler = new App.Form(urls.specializations, formData, this, e);

                formHandler.sendRequest()
                    .then(response => {
                        console.log("Success:", response);
                        window.location.reload();
                    })
                    .catch(error => {
                        console.log("Error:", error);
                    });
            });
        });
    </script>
@endsection
