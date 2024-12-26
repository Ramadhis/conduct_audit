@extends('index') <!-- Gunakan layout utama -->

@section('content')
<div id="page-content" class="container-fluid">
    <div id="mainContent">
        <form class="audit-form" method="POST" action="{{ route('audit.checklist.update') }}">
            @csrf <!-- Token CSRF untuk keamanan -->

            <div class="row">
                <div class="col-md-6">
                    <label for="audit_plan_no">Nomor Rencana Audit:</label>
                    <input type="text" id="audit_plan_no" name="audit_plan_no" value="{{ $auditData->i_id_audplnnbr }}" class="form-control" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="audit_type">Jenis Audit:</label>
                    <input type="text" id="audit_type" name="audit_type" value="{{ $auditPlan->n_aud_type }}" class="form-control" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="program_code">Kode Program:</label>
                    <select id="program_code" name="program_code" class="form-control" readonly>
                        <option value="{{$auditData->i_id_pgmcode}}">{{$auditData->i_id_pgmcode}}</option>
                    </select><br>
                </div>
                <div class="col-md-6">
                    <label for="subject">Subjek:</label>
                    <input type="text" id="subject" name="subject" value="{{ $auditData->subject }}" class="form-control" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="date_of_audit">Tanggal Audit:</label>
                    <input type="date" id="date_of_audit" name="date_of_audit" value="{{ $auditData->d_actl_audstart }}" class="form-control"><br>
                </div>
                <div class="col-md-6">
                    <label for="area_manager">Area Manager:</label>
                    <input type="text" id="area_manager" name="area_manager" value="{{ $auditData->i_id_areamgr }}" class="form-control" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="concurrence">Konkurensi:</label>
                    <input type="text" id="concurrence" name="concurrence" value="{{ $auditData->i_id_cncrnc}}" class="form-control" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="concurrence">Audit Checklist No:</label>
                    <input type="text" id="audit_checklist_no" name="audit_checklist_no" value="{{ $auditData->i_id_audchknbr }}" class="form-control" readonly><br>
                </div>
                <div class="col-md-6">
                    <label for="display_audit">Audit Checklist:</label>
                    <a href="{{ route('audit.question.edit', urlencode($auditData->i_id_audchknbr)) }}" class="btn btn-primary">Display Audit Checklist</a>

                </div>
                <div class="col-md-6">
                    <label>Closing Meeting:</label>
                    <input type="radio" name="meeting" id="meeting_yes" value="yes"> Yes
                    <input type="radio" name="meeting" id="meeting_no" value="no"> No
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" name="submit_action" value="submit" class="btn btn-primary">Submit</button>
                    <button type="button" value="cancel" class="btn btn-secondary" id="cancel-button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('include.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener ke radio button
        const meetingYes = document.getElementById('meeting_yes');
        const meetingNo = document.getElementById('meeting_no');

        // Jika tombol "Yes" diklik, arahkan ke halaman audit_meeting.blade.php
        meetingYes.addEventListener('change', function() {
            if (this.checked) {
                window.location.href = "{{ route('meeting.edit' , urlencode($auditData->i_id_audchknbr)) }}";
            }
        });

        // Tambahkan event handler ke tombol "No" jika diperlukan logika tambahan
        meetingNo.addEventListener('change', function() {
            if (this.checked) {
                alert('No Closing Meeting selected.');
            }
        });

        document.getElementById('cancel-button').addEventListener('click', function() {
            window.location.href = "{{ url('/audit-checklist') }}";
        });
    });
</script>

@endsection