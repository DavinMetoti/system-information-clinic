@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Doctor Management', 'url' => route('admin.doctor-management.index')],
        ['title' => 'Create', 'url' => '#']
    ]" />

    <div class="card w-100">
        <div class="card-header pb-0">
            <h3>Create a New Doctor</h3>
            <p>Fill in the form to create a new doctor.</p>
        </div>
        <div class="card-body">
            <form id="doctor-create_form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Doctor Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Doctor Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Contact -->
                        <div class="mb-3">
                            <label class="form-label" for="contact">Contact</label>
                            <input class="form-control" type="text" id="contact" name="contact" value="{{ old('contact') }}" placeholder="08xxxxxxxxxx" maxlength="15">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input class="form-control" type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Gender -->
                        <div class="mb-3">
                            <label class="form-label" for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Specialization -->
                        <div class="mb-3">
                            <label class="form-label" for="specialization">Specialization</label>
                            <select class="form-select" id="specialization" name="specialization" required>
                                <option value="">Select Specialization</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- License Number -->
                        <div class="mb-3">
                            <label class="form-label" for="license_number">License Number</label>
                            <input class="form-control" type="text" id="license_number" name="license_number" value="{{ old('license_number') }}" placeholder="License Number">
                        </div>
                    </div>
                </div>
                <!-- registration_number will be generated automatically -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <div id="responseMessage"></div>
            </form>
        </div>
    </div>

    <script>
        let urls = {
            doctorApi : "{{ route('admin.doctor-management.store') }}",
            specializationSelect : "{{ route('search.specialization') }}",
        }

        $(document).ready(function () {
            initSelect2('#specialization', urls.specializationSelect);

            $('#doctor-create_form').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                let formHandler = new App.Form(urls.doctorApi, formData, this, e);

                formHandler.sendRequest()
                    .then(response => {
                        console.log("Success:", response);
                    })
                    .catch(error => {
                        console.log("Error:", error);
                    });
            });
        });

        function initSelect2(selector, apiUrl) {
            new App.Select2Wrapper(selector, {
                ajax: apiUrl,
                placeholder: 'Silakan pilih...',
            });
        }
    </script>
@endsection
