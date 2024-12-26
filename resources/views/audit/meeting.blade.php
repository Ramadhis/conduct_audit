@extends('index') <!-- Menggunakan layout utama, bisa disesuaikan -->

@section('content')
<div id="page-content" class="container-fluid">
    {{-- action="{{ route('proses_audit') }}" --}}
    <div id="mainContent">
        <form class="audit-form" method="post" action="{{route('meeting.update')}}">
            @csrf <!-- Token CSRF untuk keamanan form -->
            <input type="hidden" name="audit_id" value="{{ $auditData->id }}">

            <div class="row">
                <div class="col-md-4">
                    <label for="audit_plan_no">Audit Plan No:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="audit_plan_no" name="audit_plan_no" value="{{ $auditData->i_id_audplnnbr }}" class="form-control" readonly><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="audit_type">Audit Checklist No:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="audit_check_no" name="audit_check_no" value="{{ $auditData->i_id_audchknbr }}" class="form-control" readonly><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="program_code">Year :</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="year" name="year" value="{{$auditPlan->d_aud_year}}" class="form-control" readonly><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="audit_type">Audit Team:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="audit_team" name="audit_team" value="{{$auditPlan->c_aud_org}}" class="form-control" readonly><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="audit_type">Audit type:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="audit_type" name="audit_type" value="{{$auditPlan->n_aud_type}}" class="form-control" readonly><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="audit_type">Audit Plan:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="audit_plan" name="audit_plan" value="{{$auditData->n_aud_plan}}" class="form-control" readonly><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="audit_type">Tempat:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="tempat" name="tempat" value="" class="form-control"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="audit_type">Link Meeting:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="link_m" name="link_m" class="form-control"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="time">Time:</label>
                </div>
                <div class="col-md-4">
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="time" id="hour-minute" name="hour-minute" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" name="submit_action" value="submit" class="form-control">Submit</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" name="submit_action" value="cancel" class="form-control">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection