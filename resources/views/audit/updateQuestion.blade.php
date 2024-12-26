@extends('index')

@section('content')

<div id="page-content" class="container-fluid">
    <div id="mainContent">
        @if (!empty($auditQuestionsTitle) && count($auditQuestionsTitle) > 0)
        @foreach ($auditQuestionsTitle as $title)

        <h2>Data Audit Checklist: {{ $title }}</h2>
        @break
        @endforeach
        @else
        <h2>Data Audit Checklist: Not Available</h2>
        @endif



        <!-- Form for updating audit questions -->
        <form method="POST" action="{{ route('audit.questions.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="audit_checklist_id" value="{{ $id }}">
            <div class="button-container mb-3">
                <button id="save-button" type="submit" class="btn btn-primary">Save</button>
                <button id="add-button" type="button" class="btn btn-secondary">Add</button>
                <button id="back-button" type="button" class="btn btn-light">Back</button>
            </div>

            <!-- Audit Table -->
            <div class="table-responsive">
                <table id="auditTable" class="table table-bordered audit-check-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reference</th>
                            <th>Audit Questions/Statement</th>
                            <th>Audit Findings</th>
                            <th>Objective Evidence</th>
                            <th>Note</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody id="auditTableBody">
                        @foreach ($auditQuestions as $auditData)
                        <tr>
                            <input type="hidden" name="ids[]" value="{{ $auditData->i_id_question }}">

                            <td><input type="text" name="reference[]" class="form-control" value="{{ $auditData->i_id_reff }}"></td>
                            <td><input type="text" name="question[]" class="form-control" value="{{ $auditData->n_audit_question }}"></td>
                            <td>
                                <select name="findings[]" class="form-control">
                                    <option value="COMPLIANT" {{ $auditData->n_audit_findings == 'COMPLIANT' ? 'selected' : '' }}>COMPLIANT</option>
                                    <option value="OFI" {{ $auditData->n_audit_findings == 'OFI' ? 'selected' : '' }}>OFI</option>
                                    <option value="MAJOR NC" {{ $auditData->n_audit_findings == 'MAJOR NC' ? 'selected' : '' }}>MAJOR NC</option>
                                    <option value="MINOR NC" {{ $auditData->n_audit_findings == 'MINOR NC' ? 'selected' : '' }}>MINOR NC</option>
                                </select>
                            </td>
                            <td><input type="text" name="evidence[]" class="form-control" value="{{ $auditData->n_objective_evidence }}"></td>
                            <td><input type="text" name="note[]" class="form-control" value="{{ $auditData->n_note }}"></td>
                            <td>
                                @if ($auditData->n_attachment)
                                <a href="{{ asset('storage/' . $auditData->n_attachment) }}" target="_blank">View Attachment</a>
                                @endif
                                <input type="file" name="attachment[]" class="form-control-file">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@include('include.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const auditTableBody = document.getElementById('auditTableBody');

        // Function to create a new row
        function createRow(data = {}) {
            return `
                <tr>
                    <td><input type="text" name="reference[]" class="form-control" value="${data.reference || ''}"></td>
                    <td><input type="text" name="question[]" class="form-control" value="${data.question || ''}"></td>
                    <td>
                        <select name="findings[]" class="form-control">
                            <option value="COMPLIANT" ${data.findings === 'COMPLIANT' ? 'selected' : ''}>COMPLIANT</option>
                            <option value="OFI" ${data.findings === 'OFI' ? 'selected' : ''}>OFI</option>
                            <option value="MAJOR NC" ${data.findings === 'MAJOR NC' ? 'selected' : ''}>MAJOR NC</option>
                            <option value="MINOR NC" ${data.findings === 'MINOR NC' ? 'selected' : ''}>MINOR NC</option>
                        </select>
                    </td>
                    <td><input type="text" name="evidence[]" class="form-control" value="${data.evidence || ''}"></td>
                    <td><input type="text" name="note[]" class="form-control" value="${data.note || ''}"></td>
                    <td><input type="file" name="attachment[]" class="form-control-file"></td>
                </tr>
            `;
        }

        // Add new row
        document.getElementById('add-button').addEventListener('click', function(e) {
            e.preventDefault();
            const newRow = createRow();
            auditTableBody.insertAdjacentHTML('beforeend', newRow);
        });

        // Save data to sessionStorage
        function saveToSessionStorage() {
            const rows = document.querySelectorAll('#auditTableBody tr');
            const auditDataArray = Array.from(rows).map(row => {
                const reference = row.querySelector('input[name="reference[]"]').value.trim();
                const question = row.querySelector('input[name="question[]"]').value.trim();

                // Only save rows with valid data
                if (reference && question) {
                    return {
                        reference,
                        question,
                        findings: row.querySelector('select[name="findings[]"]').value,
                        evidence: row.querySelector('input[name="evidence[]"]').value,
                        note: row.querySelector('input[name="note[]"]').value
                    };
                }
                return null; // Ignore rows with empty reference or question
            }).filter(row => row !== null);

            sessionStorage.setItem('auditData', JSON.stringify(auditDataArray));
        }

        // Handle save button
        document.getElementById('save-button').addEventListener('click', function() {
            sessionStorage.removeItem('auditData');
        });

        // Handle back button
        document.getElementById('back-button').addEventListener('click', function(e) {
            e.preventDefault();
            window.history.back();
        });
    });
</script>

@endsection