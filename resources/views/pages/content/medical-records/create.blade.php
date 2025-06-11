@extends('pages.content.index')

@section('main')
    <x-breadcrumb :items="[
        ['title' => 'Patients', 'url' => route('doctor.patient.index')],
        ['title' => 'Medical Record', 'url' => '#']
    ]" />

    <div class="card w-100">
        <div class="card-header pb-0">
            <h3>Create a New Medical Record</h3>
            <p>Fill in the form to create a new medical record.</p>
        </div>
        <div class="card-body">
            <form id="medical-record-create_form">
                @csrf
                <input type="hidden" name="user_id" value="{{ $patient }}">
                <input type="hidden" name="doctor_id" value="{{ isset($doctor) ? $doctor->id : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="date">Date</label>
                        <input class="form-control" type="date" id="date" name="date" value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>Process</option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                            <option value="end" {{ old('status') == 'end' ? 'selected' : '' }}>End</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="complaint">Complaint</label>
                        <input class="form-control" type="text" id="complaint" name="complaint" value="{{ old('complaint') }}" maxlength="255">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="diagnosis">Diagnosis</label>
                        <textarea class="form-control" id="diagnosis" name="diagnosis" rows="2">{{ old('diagnosis') }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="treatment">Treatment</label>
                        <textarea class="form-control" id="treatment" name="treatment" rows="2">{{ old('treatment') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold mb-2" style="font-size:1.1rem;">Prescription</label>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0" id="prescription-list-table">
                            <thead>
                                <tr>
                                    <th class="py-3" style="width:30%">Medicine Name</th>
                                    <th class="py-3" style="width:12%">Qty</th>
                                    <th class="py-3" style="width:18%">Unit</th>
                                    <th class="py-3" style="width:30%">Rule</th>
                                    <th class="py-3 text-center" style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody id="prescription-list">
                                <tr class="prescription-item">
                                    <td class="py-2 px-2">
                                        <input type="text" class="form-control" name="prescription[0][name]" placeholder="Medicine Name" required>
                                    </td>
                                    <td class="py-2 px-2">
                                        <input type="number" min="1" class="form-control" name="prescription[0][amount]" placeholder="Qty" required>
                                    </td>
                                    <td class="py-2 px-2">
                                        <select class="form-control" name="prescription[0][unit]" required>
                                            <option value="tablet">Tablet</option>
                                            <option value="capsule">Capsule</option>
                                            <option value="ml">ml</option>
                                            <option value="mg">mg</option>
                                            <option value="sachet">Sachet</option>
                                            <option value="bottle">Bottle</option>
                                            <option value="tube">Tube</option>
                                        </select>
                                    </td>
                                    <td class="py-2 px-2">
                                        <input type="text" class="form-control" name="prescription[0][rule]" placeholder="e.g. 3x1 after meal" required>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-prescription" style="display:none;"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="add-prescription" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus"></i> Add Prescription</button>
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
            medicalRecord : "{{ route('doctor.medical-record.store') }}",
        }

        $(document).ready(function () {
            // Prescription dynamic add/remove
            let prescriptionIndex = 1;
            $('#add-prescription').on('click', function() {
                let html = `
                <tr class="prescription-item">
                    <td class="py-2 px-2">
                        <input type="text" class="form-control" name="prescription[${prescriptionIndex}][name]" placeholder="Medicine Name" required>
                    </td>
                    <td class="py-2 px-2">
                        <input type="number" min="1" class="form-control" name="prescription[${prescriptionIndex}][amount]" placeholder="Qty" required>
                    </td>
                    <td class="py-2 px-2">
                        <select class="form-control" name="prescription[${prescriptionIndex}][unit]" required>
                            <option value="tablet">Tablet</option>
                            <option value="capsule">Capsule</option>
                            <option value="ml">ml</option>
                            <option value="mg">mg</option>
                            <option value="sachet">Sachet</option>
                            <option value="bottle">Bottle</option>
                            <option value="tube">Tube</option>
                        </select>
                    </td>
                    <td class="py-2 px-2">
                        <input type="text" class="form-control" name="prescription[${prescriptionIndex}][rule]" placeholder="e.g. 3x1 after meal" required>
                    </td>
                    <td class="py-2 px-2 text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-prescription"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                `;
                $('#prescription-list').append(html);
                $('#prescription-list .remove-prescription').show();
                prescriptionIndex++;
            });

            $(document).on('click', '.remove-prescription', function() {
                $(this).closest('.prescription-item').remove();
                // Hide remove button if only one left
                if ($('#prescription-list .prescription-item').length === 1) {
                    $('#prescription-list .remove-prescription').hide();
                }
            });

            // Hide remove button if only one prescription
            if ($('#prescription-list .prescription-item').length === 1) {
                $('#prescription-list .remove-prescription').hide();
            }

            $('#medical-record-create_form').on('submit', function (e) {
                e.preventDefault();

                // Convert prescription fields to JSON string
                let prescriptions = [];
                $('#prescription-list .prescription-item').each(function() {
                    let name = $(this).find('input[name*="[name]"]').val();
                    let amount = $(this).find('input[name*="[amount]"]').val();
                    let unit = $(this).find('select[name*="[unit]"]').val();
                    let rule = $(this).find('input[name*="[rule]"]').val();
                    prescriptions.push({name, amount, unit, rule});
                });

                let formData = new FormData(this);
                formData.set('prescription', JSON.stringify(prescriptions));

                let formHandler = new App.Form(urls.medicalRecord, formData, this, e);

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
