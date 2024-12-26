@extends('index')

@section('title', 'Non-Conformity Report')

@section('content')
<div id="page-content" class="container-fluid">

    <div id="mainContent">
        <form id="auditForm" class="audit-form" method="post" action="{{ route('audit.checklist.store.ncr') }}" enctype="multipart/form-data">
            @csrf <!-- Token CSRF untuk keamanan form -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Informasi Audit -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Informasi Audit
                    <input type="hidden" name="audit_checklist_id" value="{{ $auditData->i_id_audchknbr }}">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="audit_plan_no">Nomor Rencana Audit:</label>
                            <input type="text" id="audit_plan_no" name="audit_plan_no" value="{{ $auditPlan->i_aud_plnnbr }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="audit_type">Jenis Audit:</label>
                            <input type="text" id="audit_type" name="audit_type" value="{{ $auditPlan->n_aud_type }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="program_code">Kode Program:</label>
                            <select id="program_code" name="program_code" class="form-control" readonly>
                                <option value="{{$auditData->i_id_pgmcode}}">{{$auditData->i_id_pgmcode}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="subject">Subjek:</label>
                            <input type="text" id="subject" name="subject" value="{{ $auditData->subject }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_of_audit">Tanggal Audit:</label>
                            <input type="date" id="date_of_audit" name="date_of_audit" value="{{ $auditData->d_actl_audstart }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="area_manager">Area Manager:</label>
                            <input type="text" id="area_manager" name="area_manager" value="{{ $auditData->i_id_areamgr }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="concurrence">Konkurensi:</label>
                            <input type="text" id="concurrence" name="concurrence" value="{{ $auditData->i_id_cncrnc}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="process">Process/Area/Dept:</label>
                            <input type="text" id="process" name="process" value="{{ $auditData->i_id_cncrnc}}" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Tabs -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    Navigasi Tab
                </div>
                <div class="card-body">
                    <div class="btn-group w-100" role="group" aria-label="Tabs">
                        <button type="button" class="btn btn-outline-secondary active" onclick="showTab('nonconformityDetails')">Nonconformity Details</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="showTab('orgPlannedAct')">Org Planned Act</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="showTab('auditorVerification')">Auditor Verification</button>
                    </div>
                </div>
            </div>

            <!-- Konten Tabs -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    Konten Tab
                </div>
                <div class="card-body">
                    <div id="nonconformityDetails" class="tab-content">
                        <h6>Nonconformity Details</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="quality_element">Quality Element:</label>
                                <select id="quality_element" name="quality_element" class="form-control">
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" id="quality_element_other" name="quality_element_other" class="form-control mt-2">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="classification">Classification:</label>
                                <select id="classification" name="classification" class="form-control">
                                    <option value="Minor">Minor</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="key_requirement">Key Requirement:</label>
                                <select id="key_requirement" name="key_requirement" class="form-control">
                                    <option value="Nonsustaining C/A">Nonsustaining C/A (Repetitive)</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="reference">Reference:</label>
                                <textarea id="reference" name="reference" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="responsible_manager">Responsible Manager:</label>
                                <select id="responsible_manager" name="responsible_manager" class="form-control">
                                    <option value="select" selected>Select</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="objective_evidence">Objective Evidence:</label>
                                <textarea id="objective_evidence" name="objective_evidence" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label for="upload-attachment" class="btn btn-primary">Attachment</label>
                            <input type="file" name="attachment" id="upload-attachment" />
                        </div>
                    </div>

                    <div id="orgPlannedAct" class="tab-content" style="display: none;">
                        <!-- Containment Action -->
                        <h6>Containment Action</h6>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Evidence</th>
                                        <th>Responsible</th>
                                        <th>ECD</th>
                                    </tr>
                                </thead>
                                <tbody id="containmentActionTable">
                                    <tr>
                                        <td><input type="text" class="form-control" name="containment_action[]"></td>
                                        <td><input type="file" class="form-control" name="containment_evidence[]"></td>
                                        <td><input type="text" class="form-control" name="containment_responsible[]"></td>
                                        <td><input type="date" class="form-control" name="containment_ecd[]"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success" onclick="addContainmentRow()">Add row</button>
                        </div>

                        <!-- Root Cause -->
                        <h6>Root Cause</h6>
                        <textarea class="form-control mb-3" name="root_cause" rows="3" placeholder="Type here"></textarea>

                        <!-- Impact of All Identified and Root Cause -->
                        <h6>Impact of All Identified and Root Cause</h6>
                        <textarea class="form-control mb-3" name="impact" rows="3" placeholder="Type here"></textarea>

                        <!-- Corrective Action -->
                        <h6>Corrective Action</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Evidence</th>
                                        <th>Responsible</th>
                                        <th>ECD</th>
                                    </tr>
                                </thead>
                                <tbody id="correctiveActionTable">
                                    <tr>
                                        <td><input type="text" class="form-control" name="corrective_action[]"></td>
                                        <td><input type="file" class="form-control" name="corrective_evidence[]"></td>
                                        <td><input type="text" class="form-control" name="corrective_responsible[]"></td>
                                        <td><input type="date" class="form-control" name="corrective_ecd[]"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success" onclick="addCorrectiveRow()">Add row</button>
                        </div>
                    </div>
                </div>

                <div id="auditorVerification" class="tab-content" style="display: none;">
                    <h5>Details</h5>
                    <textarea id="verification_notes" name="verification_notes" class="form-control"></textarea>
                </div>
            </div>


            <!-- Tombol -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" id="submitForm" class="btn btn-primary form-control">Save</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary form-control">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
    document.getElementById('submitForm').addEventListener('click', function(e) {
        saveContaimentToSessionStorage();
        saveCorrectiveToSessionStorage();

        // Optional: Kirim form data secara otomatis
        document.getElementById('auditForm').submit();
    });

    function saveContaimentToSessionStorage() {
        const rows = document.querySelectorAll('#containmentActionTable tr');
        const auditDataContaiment = Array.from(rows).map(row => {
            const action = row.querySelector('input[name="containment_action[]"]').value.trim();
            if (action) {
                return {
                    action,
                    evidence: row.querySelector('input[name="containment_evidence[]"]').value,
                    responsible: row.querySelector('input[name="containment_responsible[]"]').value,
                    ecd: row.querySelector('input[name="containment_ecd[]"]').value
                };
            }
        }).filter(row => row !== null);
        sessionStorage.setItem('contaimentData', JSON.stringify(auditDataContaiment));
    }

    function saveCorrectiveToSessionStorage() {
        const rows = document.querySelectorAll('#correctiveActionTable tr');
        const auditDataCorrective = Array.from(rows).map(row => {
            const action = row.querySelector('input[name="corrective_action[]"]').value.trim();
            if (action) {
                return {
                    action,
                    evidence: row.querySelector('input[name="corrective_evidence[]"]').value,
                    responsible: row.querySelector('input[name="corrective_responsible[]"]').value,
                    ecd: row.querySelector('input[name="corrective_ecd[]"]').value
                };
            }
        }).filter(row => row !== null);
        sessionStorage.setItem('correctiveData', JSON.stringify(auditDataCorrective));
    }
</script>

@include('include.footer')
@endsection