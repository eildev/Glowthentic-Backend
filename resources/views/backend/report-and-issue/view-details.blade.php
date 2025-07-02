@extends('backend.master')
@section('admin')
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('report') }}">Reports</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report Details</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('report') }}" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back"></i> Back to
                    Reports</a>
            </div>
        </div>

        <!-- Report Details -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Report Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Issue Title</label>
                                <p class="text-muted">{{ $report->title ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Source</label>
                                <p class="text-muted">{{ ucfirst($report->source) ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <p class="text-muted">{{ $report->description ?? 'No description provided' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Source Reference</label>
                                <p class="text-muted">
                                    @if ($report->source_reference)
                                        <a href="{{ $report->source_reference }}"
                                            target="_blank">{{ $report->source_reference }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <span
                                    class="badge 
                                    {{ $report->status === 'pending'
                                        ? 'bg-warning'
                                        : ($report->status === 'in-progress'
                                            ? 'bg-primary'
                                            : ($report->status === 'solve'
                                                ? 'bg-success'
                                                : ($report->status === 'issue'
                                                    ? 'bg-danger'
                                                    : 'bg-info'))) }}">
                                    {{ ucfirst(str_replace('-', ' ', $report->status)) }}
                                </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Note</label>
                                <p class="text-muted">{{ $report->note ?? 'No notes provided' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Attachment</h5>
                    </div>
                    <div class="card-body text-center">
                        @if ($report->attachment)
                            <img src="{{ asset($report->attachment) }}" class="img-fluid rounded mb-3"
                                alt="Report Attachment" style="max-height: 300px;">
                            <br>
                            < SMALL><a href="{{ asset($report->attachment) }}" download
                                    class="btn btn-sm btn-outline-primary">Download Attachment</a></small>
                            @else
                                <p class="text-muted">No attachment available</p>
                                <img src="{{ asset('Uploads/productempty.jpg') }}" class="img-fluid rounded mb-3"
                                    alt="No Attachment" style="max-height: 300px;">
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Timestamps</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Created At</label>
                            <p class="text-muted">
                                {{ $report->created_at ? $report->created_at->format('d M Y, h:i A') : 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Updated At</label>
                            <p class="text-muted">
                                {{ $report->updated_at ? $report->updated_at->format('d M Y, h:i A') : 'N/A' }}</p>
                        </div>
                        @if ($report->deleted_at)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deleted At</label>
                                <p class="text-muted">{{ $report->deleted_at->format('d M Y, h:i A') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
