@extends('backend.master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Report And Issue Table</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Manage Report And Issue</h5>
                    </div>
                    <div class="table-responsive">
                        <table id="order_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Issue Title</th>
                                    <th>Description</th>
                                    <th>Attachment</th>
                                    <th>Source</th>
                                    <th>Source Reference</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                    // dd($products->varient);
                                @endphp
                                @if ($reports->count() > 0)
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($report->title, 29) }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($report->description, 29) }}</td>
                                            <td>
                                                <img src="/{{ $report->attachment ?? 'uploads/productempty.jpg' }}"
                                                    class="img-fluid" alt="Report Image" style="height:80px;">
                                            </td>
                                            <td>{{ $report->source ?? 'N/A' }}</td>
                                            <td>{{ $report->source_reference ?? '' }}</td>
                                            <td>{{ Illuminate\Support\Str::limit($report->note, 29) }}</td>
                                            <td>
                                                <form action="{{ route('report.status', $report->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH') <!-- Use PATCH for updates -->
                                                    <select name="status" class="form-select form-select-sm"
                                                        onchange="this.form.submit()">
                                                        <option value="pending"
                                                            {{ $report->status === 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="in-progress"
                                                            {{ $report->status === 'in-progress' ? 'selected' : '' }}>In
                                                            Progress</option>
                                                        <option value="solve"
                                                            {{ $report->status === 'solve' ? 'selected' : '' }}>Solve
                                                        </option>
                                                        <option value="issue"
                                                            {{ $report->status === 'issue' ? 'selected' : '' }}>Issue
                                                        </option>
                                                        <option value="other"
                                                            {{ $report->status === 'other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </form>
                                            </td>
                                            <td>
                                                <div class="col">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                        <ul class="dropdown-menu" data-popper-placement="bottom-start"
                                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('report.view.details', $report->id) }}">View
                                                                    Details</a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('report.edit', $report->id) }}">Edit</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('report.delete', $report->id) }}"
                                                                    id="delete">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center text-warning">Data not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
