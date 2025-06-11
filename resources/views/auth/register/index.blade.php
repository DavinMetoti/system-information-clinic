@extends('layouts.app')

@section('content')
    <main class="main" id="top">
        <div class="container-fluid bg-body-tertiary dark__bg-gray-1200">
            <div class="bg-holder bg-auth-card-overlay" style="background-image:url(../../../assets/img/bg/37.png);"></div>
            <!--/.bg-holder-->
            <div class="row flex-center position-relative min-vh-100 g-0 py-5">
                <div class="col-11 col-sm-10 col-xl-8">
                    <div class="card border border-translucent auth-card">
                        <div class="card-body pe-md-0">
                            <div class="row align-items-center gx-0 gy-7">
                                <div class="col-auto bg-body-highlight dark__bg-gray-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                                    <div class="bg-holder" style="background-image:url(../../../assets/img/bg/38.png);"></div>
                                    <!--/.bg-holder-->
                                    <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                                        <h3 class="mb-3 text-body-emphasis fs-7">System Information Clinic</h3>
                                        <p class="text-body-tertiary">Your Clinic's Digital Solution, Complete and Trustworthy!</p>
                                        <ul class="list-unstyled mb-0 w-max-content w-md-auto">
                                            <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Easy to Use</span></li>
                                            <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">User-Friendly</span></li>
                                            <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-body-tertiary fw-semibold">Responsive & Flexible Design</span></li>
                                        </ul>
                                    </div>

                                    <div class="position-relative z-n1 mb-6 d-none d-md-block text-center mt-md-15"><img class="auth-title-box-img d-dark-none" src="../../../assets/img/spot-illustrations/auth.png" alt="" /><img class="auth-title-box-img d-light-none" src="../../../assets/img/spot-illustrations/auth.png" alt="" /></div>
                                </div>
                                <div class="col mx-auto">
                                    <div class="auth-form-box">
                                        <div class="text-center mb-7">
                                            <h3 class="text-body-highlight">Register</h3>
                                            <p class="text-body-tertiary">Create your account</p>
                                            @if ($errors->any())
                                                <div class="alert alert-outline-danger p-2" role="alert">
                                                    <ul class="mb-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <!-- Start: Register Form -->
                                            <form id="register-form" method="POST" action="{{ route('register.store') }}">
                                                @csrf

                                                <!-- Name -->
                                                <div class="mb-3 text-start">
                                                    <label class="form-label" for="name">Full Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                        id="name" type="text" name="name" value="{{ old('name') }}"
                                                        placeholder="Full Name" required />
                                                    @error('name')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Email -->
                                                <div class="mb-3 text-start">
                                                    <label class="form-label" for="email">Email address</label>
                                                    <div class="form-icon-container">
                                                        <input class="form-control form-icon-input @error('email') is-invalid @enderror"
                                                            id="email" type="email" name="email" value="{{ old('email') }}"
                                                            placeholder="name@example.com" required />
                                                        <span class="fas fa-user text-body fs-9 form-icon"></span>
                                                    </div>
                                                    @error('email')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="row">
                                                    <!-- Password -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="form-icon-container position-relative">
                                                            <input class="form-control form-icon-input pe-6 @error('password') is-invalid @enderror"
                                                                id="password" type="password" name="password"
                                                                placeholder="Password" required />
                                                            <span class="fas fa-key text-body fs-9 form-icon"></span>
                                                            <button type="button" class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary password-toggle-btn" tabindex="-1">
                                                                <span class="uil uil-eye show"></span>
                                                                <span class="uil uil-eye-slash hide d-none"></span>
                                                            </button>
                                                        </div>
                                                        @error('password')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!-- Confirm Password -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                        <div class="form-icon-container position-relative">
                                                            <input class="form-control form-icon-input pe-6 @error('password_confirmation') is-invalid @enderror"
                                                                id="password_confirmation" type="password" name="password_confirmation"
                                                                placeholder="Confirm Password" required />
                                                            <span class="fas fa-key text-body fs-9 form-icon"></span>
                                                            <button type="button" class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary password-toggle-btn-confirm" tabindex="-1">
                                                                <span class="uil uil-eye show"></span>
                                                                <span class="uil uil-eye-slash hide d-none"></span>
                                                            </button>
                                                        </div>
                                                        @error('password_confirmation')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Contact -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="contact">Contact</label>
                                                        <input class="form-control @error('contact') is-invalid @enderror"
                                                            id="contact" type="text" name="contact" value="{{ old('contact') }}"
                                                            placeholder="08xxxxxxxxxx" maxlength="15" />
                                                        @error('contact')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!-- Address -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="address">Address</label>
                                                        <input class="form-control @error('address') is-invalid @enderror"
                                                            id="address" type="text" name="address" value="{{ old('address') }}"
                                                            placeholder="Address" />
                                                        @error('address')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Gender -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="gender">Gender</label>
                                                        <select class="form-select @error('gender') is-invalid @enderror"
                                                            id="gender" name="gender" required>
                                                            <option value="">Select Gender</option>
                                                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <!-- Date of Birth -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="date_of_birth">Date of Birth</label>
                                                        <input class="form-control @error('date_of_birth') is-invalid @enderror"
                                                            id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" />
                                                        @error('date_of_birth')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Place of Birth -->
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="place_of_birth">Place of Birth</label>
                                                        <input class="form-control @error('place_of_birth') is-invalid @enderror"
                                                            id="place_of_birth" type="text" name="place_of_birth" value="{{ old('place_of_birth') }}"
                                                            placeholder="Place of Birth" />
                                                        @error('place_of_birth')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 text-start col-md-6">
                                                        <label class="form-label" for="bpjs_number">BPJS Number</label>
                                                        <input class="form-control @error('bpjs_number') is-invalid @enderror"
                                                            id="bpjs_number" type="text" name="bpjs_number" value="{{ old('bpjs_number') }}"
                                                            placeholder="BPJS Number" maxlength="20" />
                                                        @error('bpjs_number')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Register Button -->
                                                <button class="btn btn-primary w-100 mb-3" type="submit">Register</button>
                                                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">Back to Login</a>
                                            </form>
                                            <!-- End: Register Form -->
                                            <div id="register-alert" style="display:none;" class="alert mt-3"></div>
                                            <script>
                                                $(function () {
                                                    // Password toggle
                                                    var $toggleBtn = $('.password-toggle-btn');
                                                    var $passwordInput = $('#password');
                                                    $toggleBtn.on('click', function (e) {
                                                        e.preventDefault();
                                                        var $showIcon = $toggleBtn.find('.uil-eye');
                                                        var $hideIcon = $toggleBtn.find('.uil-eye-slash');
                                                        if ($passwordInput.attr('type') === 'password') {
                                                            $passwordInput.attr('type', 'text');
                                                            $showIcon.addClass('d-none');
                                                            $hideIcon.removeClass('d-none');
                                                        } else {
                                                            $passwordInput.attr('type', 'password');
                                                            $showIcon.removeClass('d-none');
                                                            $hideIcon.addClass('d-none');
                                                        }
                                                    });
                                                    var $toggleBtnConfirm = $('.password-toggle-btn-confirm');
                                                    var $passwordInputConfirm = $('#password_confirmation');
                                                    $toggleBtnConfirm.on('click', function (e) {
                                                        e.preventDefault();
                                                        var $showIcon = $toggleBtnConfirm.find('.uil-eye');
                                                        var $hideIcon = $toggleBtnConfirm.find('.uil-eye-slash');
                                                        if ($passwordInputConfirm.attr('type') === 'password') {
                                                            $passwordInputConfirm.attr('type', 'text');
                                                            $showIcon.addClass('d-none');
                                                            $hideIcon.removeClass('d-none');
                                                        } else {
                                                            $passwordInputConfirm.attr('type', 'password');
                                                            $showIcon.removeClass('d-none');
                                                            $hideIcon.addClass('d-none');
                                                        }
                                                    });

                                                    // Handle AJAX register
                                                    $('#register-form').on('submit', function(e) {
                                                        e.preventDefault();
                                                        var $form = $(this);
                                                        var $alert = $('#register-alert');
                                                        $alert.hide().removeClass('alert-success alert-danger').empty();

                                                        $.ajax({
                                                            url: $form.attr('action'),
                                                            method: 'POST',
                                                            data: $form.serialize(),
                                                            success: function(res) {
                                                                $alert.addClass('alert-success').text(res.message).show();
                                                                $form[0].reset();
                                                            },
                                                            error: function(xhr) {
                                                                var msg = 'Registration failed!';
                                                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                                                    msg = xhr.responseJSON.message;
                                                                }
                                                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                                                    msg += '<ul>';
                                                                    $.each(xhr.responseJSON.errors, function(k, v) {
                                                                        msg += '<li>' + v[0] + '</li>';
                                                                    });
                                                                    msg += '</ul>';
                                                                }
                                                                $alert.addClass('alert-danger').html(msg).show();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection