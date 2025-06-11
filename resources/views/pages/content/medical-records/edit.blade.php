@extends('pages.content.index')

@section('main')
<x-breadcrumb :items="[
    ['title' => 'Medical Records', 'url' => route('doctor.medical-record.index')],
    ['title' => 'Edit', 'url' => '#']
]" />

<div class="card w-100">
    <div class="card-header pb-0">
        <h3>Edit Medical Record</h3>
    </div>
    <div class="card-body">
        <form id="medical-record-edit_form">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $medicalRecord->user_id }}">
            <input type="hidden" name="doctor_id" value="{{ $medicalRecord->doctor_id }}">
            <div class="mb-3">
                <label class="form-label">Patient</label>
                <input type="text" disabled class="form-control" value="{{ $medicalRecord->user->name ?? '-' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Doctor</label>
                <input type="text" disabled class="form-control" value="{{ $medicalRecord->doctor->name ?? '-' }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label" for="date">Date</label>
                <input class="form-control" type="date" id="date" name="date" value="{{ $medicalRecord->date }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="process" {{ $medicalRecord->status == 'process' ? 'selected' : '' }}>Process</option>
                    <option value="done" {{ $medicalRecord->status == 'done' ? 'selected' : '' }}>Done</option>
                    <option value="end" {{ $medicalRecord->status == 'end' ? 'selected' : '' }}>End</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="complaint">Complaint</label>
                <input class="form-control" type="text" id="complaint" name="complaint" value="{{ $medicalRecord->complaint }}" maxlength="255">
            </div>
            <div class="mb-3">
                <label class="form-label" for="diagnosis">Diagnosis</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="2">{{ $medicalRecord->diagnosis }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="treatment">Treatment</label>
                <textarea class="form-control" id="treatment" name="treatment" rows="2">{{ $medicalRecord->treatment }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="2">{{ $medicalRecord->notes }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Prescription</label>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0" id="prescription-list-table">
                        <thead>
                            <tr>
                                <th style="width:30%">Medicine Name</th>
                                <th style="width:12%">Qty</th>
                                <th style="width:18%">Unit</th>
                                <th style="width:30%">Rule</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody id="prescription-list">
                            @php
                                $prescriptions = $medicalRecord->prescription ? json_decode($medicalRecord->prescription, true) : [];
                            @endphp
                            @forelse($prescriptions as $i => $item)
                                <tr class="prescription-item">
                                    <td class="py-2 px-2">
                                        <input type="text" class="form-control" name="prescription[{{ $i }}][name]" value="{{ $item['name'] ?? '' }}" required>
                                    </td>
                                    <td class="py-2 px-2">
                                        <input type="number" min="1" class="form-control" name="prescription[{{ $i }}][amount]" value="{{ $item['amount'] ?? '' }}" required>
                                    </td>
                                    <td class="py-2 px-2">
                                        <select class="form-control" name="prescription[{{ $i }}][unit]" required>
                                            <option value="tablet" {{ ($item['unit'] ?? '') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                            <option value="capsule" {{ ($item['unit'] ?? '') == 'capsule' ? 'selected' : '' }}>Capsule</option>
                                            <option value="ml" {{ ($item['unit'] ?? '') == 'ml' ? 'selected' : '' }}>ml</option>
                                            <option value="mg" {{ ($item['unit'] ?? '') == 'mg' ? 'selected' : '' }}>mg</option>
                                            <option value="sachet" {{ ($item['unit'] ?? '') == 'sachet' ? 'selected' : '' }}>Sachet</option>
                                            <option value="bottle" {{ ($item['unit'] ?? '') == 'bottle' ? 'selected' : '' }}>Bottle</option>
                                            <option value="tube" {{ ($item['unit'] ?? '') == 'tube' ? 'selected' : '' }}>Tube</option>
                                        </select>
                                    </td>
                                    <td class="py-2 px-2">
                                        <input type="text" class="form-control" name="prescription[{{ $i }}][rule]" value="{{ $item['rule'] ?? '' }}" required>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <button type="button" class="btn btn-danger btn-sm remove-prescription" {{ count($prescriptions) == 1 ? 'style=display:none;' : '' }}><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
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
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button type="button" id="add-prescription" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus"></i> Add Prescription</button>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
            <div id="responseMessage"></div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        let prescriptionIndex = {{ count($prescriptions) }};
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
            if ($('#prescription-list .prescription-item').length === 1) {
                $('#prescription-list .remove-prescription').hide();
            }
        });

        if ($('#prescription-list .prescription-item').length === 1) {
            $('#prescription-list .remove-prescription').hide();
        }

        $('#medical-record-edit_form').on('submit', function (e) {
            e.preventDefault();

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

            $.ajax({
                url: "{{ route('doctor.medical-record.update', $medicalRecord->id) }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    window.location.href = "{{ route('doctor.medical-record.show', $medicalRecord->id) }}";
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'An error occurred.';
                    $('#responseMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
                }
            });
        });
    });
</script>
@endsection
