@extends('admin-master')
@section('main_content')

<style>
    /* Dark mode styles for modal */
    [data-theme="dark"] .modal-content {
        background-color: #2d3748;
        color: #f7fafc;
        border: 1px solid #4a5568;
    }

    [data-theme="dark"] .modal-header {
        background-color: #1a202c;
        border-bottom-color: #4a5568;
    }

    [data-theme="dark"] .modal-title {
        color: #f7fafc;
    }

    [data-theme="dark"] .modal-body {
        background-color: #2d3748;
    }

    [data-theme="dark"] .modal-body dt {
        color: #e2e8f0;
    }

    [data-theme="dark"] .modal-body dd {
        color: #cbd5e0;
    }

    [data-theme="dark"] .modal-body a {
        color: #63b3ed;
    }

    [data-theme="dark"] .modal-body a:hover {
        color: #90cdf4;
    }

    [data-theme="dark"] .modal-footer {
        background-color: #1a202c;
        border-top-color: #4a5568;
    }

    [data-theme="dark"] .close {
        color: #f7fafc;
        opacity: 0.8;
    }

    [data-theme="dark"] .close:hover {
        color: #ffffff;
        opacity: 1;
    }

    /* Table enhancements for dark mode */
    [data-theme="dark"] .card {
        background-color: #2d3748;
        border-color: #4a5568;
    }

    [data-theme="dark"] .card-header {
        background-color: #1a202c;
        border-bottom-color: #4a5568;
        color: #f7fafc;
    }

    [data-theme="dark"] .table {
        color: #e2e8f0;
    }

    [data-theme="dark"] .table thead th {
        background-color: #1a202c;
        color: #f7fafc;
        border-color: #4a5568;
    }

    [data-theme="dark"] .table td {
        border-color: #4a5568;
        color: #cbd5e0;
    }

    [data-theme="dark"] .bg-light {
        background-color: #1a202c !important;
    }

    [data-theme="dark"] .badge-warning {
        background-color: #ed8936;
        color: #fff;
    }

    [data-theme="dark"] .badge-info {
        background-color: #4299e1;
        color: #fff;
    }

    [data-theme="dark"] .badge-success {
        background-color: #48bb78;
        color: #fff;
    }

    [data-theme="dark"] .badge-primary {
        background-color: #4299e1;
        color: #fff;
    }

    /* Button enhancements */
    [data-theme="dark"] .btn-group .btn {
        border-color: #4a5568;
    }

    /* Ensure modal backdrop works in dark mode */
    [data-theme="dark"] .modal-backdrop.show {
        opacity: 0.7;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Messages</h3>
                <div class="card-tools">
                    <span class="badge badge-primary">{{ $messages->where('status', 'unread')->count() }} Unread</span>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr class="{{ $message->status === 'unread' ? 'bg-light' : '' }}">
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>
                                <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $message->message }}
                                </div>
                            </td>
                            <td>
                                @if($message->status === 'unread')
                                    <span class="badge badge-warning">Unread</span>
                                @elseif($message->status === 'read')
                                    <span class="badge badge-info">Read</span>
                                @else
                                    <span class="badge badge-success">Replied</span>
                                @endif
                            </td>
                            <td>{{ $message->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if($message->status === 'unread')
                                        <a href="{{ route('contactMarkAsRead', $message->id) }}" 
                                           class="btn btn-sm btn-info" 
                                           title="Mark as Read">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    
                                    @if($message->status !== 'replied')
                                        <a href="{{ route('contactMarkAsReplied', $message->id) }}" 
                                           class="btn btn-sm btn-success" 
                                           title="Mark as Replied">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    @endif
                                    
                                    <button type="button" 
                                            class="btn btn-sm btn-primary" 
                                            data-toggle="modal" 
                                            data-target="#messageModal{{ $message->id }}"
                                            title="View Full Message">
                                        <i class="fas fa-envelope-open"></i>
                                    </button>
                                    
                                    <a href="{{ route('contactDelete', $message->id) }}" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Are you sure you want to delete this message?')"
                                       title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal for full message -->
                        <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Message Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Name:</dt>
                                            <dd class="col-sm-9">{{ $message->name }}</dd>
                                            
                                            <dt class="col-sm-3">Email:</dt>
                                            <dd class="col-sm-9">
                                                <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                            </dd>
                                            
                                            <dt class="col-sm-3">Subject:</dt>
                                            <dd class="col-sm-9">{{ $message->subject }}</dd>
                                            
                                            <dt class="col-sm-3">Date:</dt>
                                            <dd class="col-sm-9">{{ $message->created_at->format('F d, Y h:i A') }}</dd>
                                            
                                            <dt class="col-sm-3">Message:</dt>
                                            <dd class="col-sm-9">{{ $message->message }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="https://mail.google.com" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-reply"></i> Reply via Email
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No contact messages found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
// Ensure theme is applied when modals open
document.addEventListener('DOMContentLoaded', function() {
    // Apply theme to modals when they're shown
    $('.modal').on('show.bs.modal', function() {
        const theme = document.documentElement.getAttribute('data-theme');
        this.setAttribute('data-theme', theme);
    });
});
</script>

@endsection