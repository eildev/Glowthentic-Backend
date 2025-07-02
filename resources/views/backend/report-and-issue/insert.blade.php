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
                        <li class="breadcrumb-item active" aria-current="page">Add Report</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('report') }}" class="btn btn-danger btn-sm"><i class="bx bx-arrow-back"></i> Back to
                    Reports</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Add New Report</h5>
                    </div>
                    <div class="card-body">
                        <form id="reportForm" action="{{ route('report.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label fw-bold">Issue Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title') }}" placeholder="Enter issue title">
                                    @error('title')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="title-error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="source" class="form-label fw-bold">Source <span
                                            class="text-danger">*</span></label>
                                    <select name="source" id="source" class="form-select">
                                        <option value="" {{ old('source') == '' ? 'selected' : '' }}>Select Source
                                        </option>
                                        <option value="website" {{ old('source') == 'website' ? 'selected' : '' }}>Website
                                        </option>
                                        <option value="mail" {{ old('source') == 'mail' ? 'selected' : '' }}>Mail</option>
                                        <option value="whatsapp" {{ old('source') == 'whatsapp' ? 'selected' : '' }}>
                                            WhatsApp</option>
                                        <option value="facebook" {{ old('source') == 'facebook' ? 'selected' : '' }}>
                                            Facebook</option>
                                        <option value="others" {{ old('source') == 'others' ? 'selected' : '' }}>Others
                                        </option>
                                        <option value="admin" {{ old('source') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
                                    @error('source')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="source-error"></span>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label fw-bold">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="description-error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="attachment" class="form-label fw-bold">Attachment (Image)</label>
                                    <input type="file" name="attachment" id="attachment" class="form-control"
                                        accept="image/jpeg,image/png,image/jpg">
                                    <div class="my-1">
                                        <i><b>Note:</b> Please provide a image</i>
                                    </div>
                                    @error('attachment')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="attachment-error"></span>
                                    <div class="mt-3">
                                        <img id="showImage" class="img-fluid" height="150" width="200"
                                            src="{{ asset('Uploads/productempty.jpg') }}" alt="Preview Image">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="source_reference" class="form-label fw-bold">Source Reference</label>
                                    <input type="text" name="source_reference" id="source_reference" class="form-control"
                                        value="{{ old('source_reference') }}"
                                        placeholder="Enter source reference (e.g., URL or email)">
                                    @error('source_reference')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="source_reference-error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label fw-bold">Status <span
                                            class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Status
                                        </option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="in-progress"
                                            {{ old('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="solve" {{ old('status') == 'solve' ? 'selected' : '' }}>Solve
                                        </option>
                                        <option value="issue" {{ old('status') == 'issue' ? 'selected' : '' }}>Issue
                                        </option>
                                        <option value="other" {{ old('status') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="status-error"></span>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="note" class="form-label fw-bold">Note</label>
                                    <textarea name="note" id="note" class="form-control" rows="4" placeholder="Enter note">{{ old('note') }}</textarea>
                                    @error('note')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" id="note-error"></span>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="submitBtn" class="btn btn-primary">Add Report</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Image preview
            $("#attachment").on("change", function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#showImage").attr("src", e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            });

            // Form validation
            $("#submitBtn").on("click", function(e) {
                e.preventDefault();

                let form = $("#reportForm");
                let title = $("#title").val().trim();
                let attachment = $("#attachment")[0].files[0];

                // Clear existing error messages
                $(".text-danger").text("");

                let errors = {};

                // Validate title
                if (title === "") {
                    errors.title = "Issue Title is required!";
                }

                // Validate attachment (if provided)
                if (attachment) {
                    let fileSize = attachment.size / 1024; // Convert to KB
                    let fileType = attachment.type;
                    let allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

                    if (!allowedTypes.includes(fileType)) {
                        errors.attachment = "Only JPG, JPEG, and PNG files are allowed!";
                    } else if (fileSize > 2048) {
                        errors.attachment = "Image size must be less than 2MB!";
                    }
                }

                // Display errors if any
                if (!$.isEmptyObject(errors)) {
                    if (errors.title) $("#title-error").text(errors.title);
                    if (errors.attachment) $("#attachment-error").text(errors.attachment);
                    return false;
                }

                form.submit();
            });
        });
    </script>
@endsection
