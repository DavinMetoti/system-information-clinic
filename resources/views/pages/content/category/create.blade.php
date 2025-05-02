@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'User Management', 'url' => route('app.categories.index')],
        ['title' => 'Add Category', 'url' => '#']
    ]" />

    <div class="card w-100">
        <div class="card-header pb-0">
            <h3>Register a New Account</h3>
            <p>Fill in the form to create a new account.</p>
        </div>
        <div class="card-body">
            <form id="user-register_registration_form">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your Full Name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Brief description of the supplier" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="unit">Unit</label>
                    <input class="form-control" type="text" id="unit" name="unit" value="{{ old('unit') }}" placeholder="Your Full Name" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>

                <div id="responseMessage"></div>
            </form>
        </div>
    </div>

    <script>
        let urls = {
            users : "{{ route('app.categories.store') }}",
        }

        $(document).ready(function () {
            $('#user-register_registration_form').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let formHandler = new App.Form(urls.users, formData, this, e);

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
