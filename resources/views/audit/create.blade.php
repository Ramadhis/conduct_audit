@extends('index')

@section('content')
<div id="page-content" class="container-fluid">
    <div id="mainContent">
        <form class="audit-form" method="post" action="{{url('/audit-checklist/create/store')}}" id="auditChecklistForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="audit_plan_no">Nomor Rencana Audit:</label>
                    <input type="text" id="audit_plan_no" name="audit_plan_no" class="form-control" value="{{ $auditPlan->i_aud_plnnbr }}" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="audit_type">Jenis Audit:</label>
                    <input type="text" id="audit_type" name="audit_type" class="form-control" value="{{$auditPlan->n_aud_type}}" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="program_code">Kode Program:</label>
                    <select id="program_code" name="program_code" class="form-control">
                        <option value="AH">AH</option>
                        <option value="HB">HB</option>
                        <option value="CH">CH</option>
                    </select><br>
                </div>
                <div class="col-md-6">
                    <label for="subject">Subjek:</label>
                    <input type="text" id="subject" name="subject" class="form-control" value="{{ $auditPlan -> n_subject }}" readonly><br>
                    <input type="hidden" id="n_aud_plan" name="n_aud_plan" class="form-control" value="{{ $auditPlan -> n_aud_plan }}" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="date_of_audit">Tanggal Audit:</label>
                    <input type="date" id="date_of_audit" name="date_of_audit" value="{{ $auditPlan -> d_aud_start }}" class="form-control"><br>
                </div>
                <div class="col-md-6">
                    <label for="area_manager">Area Manager:</label>
                    <input type="text" id="area_manager" name="area_manager" class="form-control"><br>
                </div>
                <div class="col-md-6">
                    <label for="concurrence">Konkurensi:</label>
                    <input type="text" id="concurrence" name="concurrence" class="form-control" value="{{ $auditPlan -> i_id_cncrnc}}" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="display_audit">Audit Checklist:</label>
                    <a href="{{url('/audit-checklist/create/question/' . $auditPlan->id)}}" class="btn btn-primary">Display Audit Checklist</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" name="submit_action" value="submit" class="btn btn-success" id="submit-button">Submit</button>
                    <button type="button" class="btn btn-danger" id="cancel-button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('.audit-form').addEventListener('submit', function(e) {
        const auditData = sessionStorage.getItem('auditData');
        if (auditData) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'audit_details';
            hiddenInput.value = auditData;
            this.appendChild(hiddenInput);
        }

        sessionStorage.removeItem('auditData');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const auditData = JSON.parse(sessionStorage.getItem('selectedAuditData'));
        if (auditData) {
            const formatDate = (dateStr) => {
                const [day, month, year] = dateStr.split('-');
                return `${year}-${month}-${day}`;
            };
            document.getElementById('audit_plan_no').value = auditData.planNo;
            document.getElementById('audit_type').value = auditData.auditType;
            document.getElementById('subject').value = auditData.auditPlan;
            document.getElementById('date_of_audit').value = formatDate(auditData.dateStart);
            document.getElementById('concurrence').value = auditData.concurence;
        }

        document.getElementById('cancel-button').addEventListener('click', function() {
            window.history.back();
        });
    });
</script>
@endsection