@extends('admin-master')
@section('main_content')
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
                        <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Message Details</h5>
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
                                        <a href="https://mail.google.com" class="btn btn-primary">
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
@endsection