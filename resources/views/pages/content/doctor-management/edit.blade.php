@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Doctor Management', 'url' => route('admin.doctor-management.index')],
        ['title' => 'Edit', 'url' => '#']
    ]" />

    <div class="card w-100">
        <div class="card-header pb-0">
            <h3>Edit Doctor</h3>
            <p>Update the form to edit the doctor.</p>
        </div>
        <div class="card-body">
            <form id="doctor_registration_form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $doctor->name }}" placeholder="Doctor Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ $doctor->email }}" placeholder="Doctor Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Contact -->
                        <div class="mb-3">
                            <label class="form-label" for="contact">Contact</label>
                            <input class="form-control" type="text" id="contact" name="contact" value="{{ $doctor->contact }}" placeholder="08xxxxxxxxxx" maxlength="15">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input class="form-control" type="text" id="address" name="address" value="{{ $doctor->address }}" placeholder="Address">
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
                                <option value="Laki-laki" {{ $doctor->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $doctor->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Specialization -->
                        <div class="mb-3">
                            <label class="form-label" for="specialization">Specialization</label>
                            <select class="form-select" id="specialization" name="specialization_id" required>
                                <option value="">Select Specialization</option>
                                @foreach($specializations as $spec)
                                    <option value="{{ $spec->id }}"
                                        @if(old('specialization', $doctor->doctor->specialization_id ?? '') == $spec->id) selected @endif>
                                        {{ $spec->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- License Number -->
                        <div class="mb-3">
                            <label class="form-label" for="license_number">License Number</label>
                            <input class="form-control" type="text" id="license_number" name="license_number" value="{{ $doctor->doctor->license_number ?? '' }}" placeholder="License Number">
                        </div>
                    </div>
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
            const doctorId = @json($doctor->id);
            let urls = {
                doctors: "{{ route('admin.doctor-management.update', ['doctor_management' => '__DOCTOR_ID__']) }}".replace('__DOCTOR_ID__', doctorId),
                specializationSelect: "{{ route('search.specialization') }}"
            };

            $('#doctor_registration_form').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);
                console.log("Form Data:", formData);

                let formHandler = new App.Form(urls.doctors, formData, this, e);

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
