@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Specialization', 'url' => route('admin.specialization.index')],
        ['title' => 'Create', 'url' => '#']
    ]" />

    <div class="card w-100">
        <div class="card-header pb-0">
            <h3>Create a New Specialization</h3>
            <p>Fill in the form to create a new specialization.</p>
        </div>
        <div class="card-body">
            <form id="specialization-create_form">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Specialization Name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Specialization Description" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="slug">Slug</label>
                    <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Specialization Slug" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

                <div id="responseMessage"></div>
            </form>
        </div>
    </div>

    <script>
        let urls = {
            specialization : "{{ route('admin.specialization.store') }}",
        }

        $(document).ready(function () {
            $('#specialization-create_form').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let formHandler = new App.Form(urls.specialization, formData, this, e);

                formHandler.sendRequest()
                    .then(response => {
                        console.log("Success:", response);
                    })
                    .catch(error => {
                        console.log("Error:", error);
                    });
            });
        });
    </script>
@endsection
