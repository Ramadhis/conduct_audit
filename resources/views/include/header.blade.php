<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Conduct Audit')</title>
    <!-- Bootstrap and Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar bg-light" id="sidebar">
            <div class="sidebar-header p-3">
                <h4 class="mb-0">Audit Menu</h4>
                <button class="btn btn-sm btn-close" id="menu-close">&times;</button>
            </div>
            <ul class="list-unstyled components p-3">
                <li class="nav-item dropdown">
                    <a href="#conductAuditSubmenu" class="nav-link dropdown-toggle" data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-tasks mr-2"></i>Conduct Audit
                    </a>
                    <ul class="collapse list-unstyled" id="conductAuditSubmenu">
                        <li><a href="{{url('/')}}"><i class="fas fa-plus-circle mr-2"></i>Create Audit Checklist</a></li>
                        <li><a href="{{url('/audit-checklist')}}"><i class="fas fa-edit mr-2"></i>Update Audit Checklist</a></li>
                        <li><a href="{{url('/audit-checklist-approve')}}"><i class="fas fa-check-circle mr-2"></i>Approval Audit Checklist</a></li>
                        <li><a href="{{url('/data-audit-checklist')}}"><i class="fas fa-check-circle mr-2"></i>Create Nonconformity Report</a></li>
                    </ul>
                </li>
            </ul>
        </div>