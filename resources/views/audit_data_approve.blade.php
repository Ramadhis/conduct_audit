@extends('index')

@section('content')

<div id="page-content" class="container-fluid">
    <div id="mainContent">
        <h2>Data Audit Checklist</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Checklist Number</th>
                        <th>Plan Number</th>
                        <th>Subject</th>
                        <th>Program Code</th>
                        <th>Audit Plan</th>
                        <th>Actual Start Date</th>
                        <th>Area Manager</th>
                        <th>concurrence</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditChecklists as $audit)
                    <tr>
                        <td>{{ $audit->i_id_audchknbr }}</td>
                        <td>{{ $audit->i_id_audplnnbr }}</td>
                        <td>{{ $audit->subject }}</td>
                        <td>{{ $audit->i_id_pgmcode }}</td>
                        <td>{{ $audit->n_aud_plan }}</td>
                        <td>{{ $audit->d_actl_audstart }}</td>
                        <td>{{ $audit->i_id_areamgr}}</td>
                        <td>{{ $audit->i_id_cncrnc }}</td>
                        <td>
                            <a href="{{ route('audit.checklist.approved', urlencode($audit->i_id_audchknbr))}}" class="btn btn-success">
                                Approve
                            </a>
                            <a href="{{ route('audit.checklist.rejected', urlencode($audit->i_id_audchknbr))}}" class="btn btn-danger">
                                Reject
                            </a>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection