@extends('index')

@section('content')

<div id="page-content" class="container-fluid">
    <div id="mainContent">
        <h2>Data Pre Audit</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Plan Number</th>
                        <th>Year</th>
                        <th>Type</th>
                        <th>Plan</th>
                        <th>Organization</th>
                        <th>Subject</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preAudits as $audit)
                    <tr>
                        <td>{{ $audit->i_aud_plnnbr }}</td>
                        <td>{{ $audit->d_aud_year }}</td>
                        <td>{{ $audit->n_aud_type }}</td>
                        <td>{{ $audit->n_aud_plan }}</td>
                        <td>{{ $audit->c_aud_org }}</td>
                        <td>{{ $audit->n_subject }}</td>
                        <td>{{ $audit->d_aud_start }}</td>
                        <td>{{ $audit->d_aud_finish }}</td>
                        <td>
                            <a href="{{ url('/audit-checklist/create/' . $audit->id) }}" class="btn btn-success">
                                Create Checklist
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