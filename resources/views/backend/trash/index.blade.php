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
                        <li class="breadcrumb-item active" aria-current="page">Trash Bin</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-sm"><i class="bx bx-arrow-back"></i> Back
                    to Dashboard</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Trash Bin - Deleted Records</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @php
                            $hasData = false;
                            foreach ($trashedData as $modelName => $records) {
                                if ($records->isNotEmpty()) {
                                    $hasData = true;
                                    break;
                                }
                            }
                        @endphp

                        @if (!$hasData)
                            <div class="alert alert-info">No deleted records found in the trash bin.</div>
                        @else
                            @foreach ($trashedData as $modelName => $records)
                                @if ($records->isNotEmpty())
                                    <h5 class="mt-4">{{ $modelName }} Records</h5>
                                    <div class="table-responsive mb-4">
                                        <table class="table table-bordered table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name/Title</th>
                                                    <th>Deleted At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($records as $index => $record)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $record->title ?? ($record->name ?? 'N/A') }}</td>
                                                        <td>{{ $record->deleted_at->format('d M Y, h:i A') }}</td>
                                                        <td>
                                                            <form
                                                                action="{{ route('trash.restore', ['model' => $modelName, 'id' => $record->id]) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"
                                                                    onclick="return confirm('Are you sure you want to restore this {{ $modelName }}?')">
                                                                    <i class="bx bx-undo"></i> Restore
                                                                </button>
                                                            </form>
                                                            <form
                                                                action="{{ route('trash.force-delete', ['model' => $modelName, 'id' => $record->id]) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to permanently delete this {{ $modelName }}?')">
                                                                    <i class="bx bx-trash"></i> Delete Permanently
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
