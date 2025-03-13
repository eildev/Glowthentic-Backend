@extends('backend.master')
@section('admin')
    <div class="page-content">
        <div class="row">
            <div class="card border-0 border-top border-3 border-info col-md-12">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-info">Contact Us Message list</h5>

                        <a href="#" class="btn btn-info btn-sm text-light ">
                            <i class='bx bx-plus'></i>
                        </a>
                    </div>
                    <hr>
                    @if ($contact_us->count() > 0)
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Customer Name</th>
                                        <th>Subjects</th>
                                        <th>Message</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serialNumber = 1;
                                    @endphp

                                    @foreach ($contact_us as $message)
                                        {{-- @dd($message); --}}
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td>{{ $message->message }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>
                                                @if ($message->read == 1)
                                                    <span class="badge rounded-pill bg-primary">Read</span>
                                                @else
                                                    <span class="badge rounded-pill bg-warning">Unread</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">View Meassage</button>
                                                <a href="{{ route('contact-message.delete', $message->id) }}"
                                                    class="btn btn-sm btn-danger" id="delete">Move to trash</a>

                                            </td>
                                        </tr>
                                         <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $message->subject }}</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('reply.mail') }}" method="POST">
                                        @csrf
                                    <div class="modal-body">
                                        <p class="fw-bold">{{ $message->name }}</p>
                                        <p>{{ $message->message }}</p>
                                        <input type="hidden" name="mail" value="{{ $message->email }}">
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Write Replay
                                                Message
                                                Here</label>
                                            <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Send Replay</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col">

                        </div>
                    @else
                        <div class="text-center">Data not Found</div>
                    @endif
                </div>
            </div>



        </div>
        <!--end row-->
    </div>
@endsection
