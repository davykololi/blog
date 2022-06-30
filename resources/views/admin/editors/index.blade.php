@extends('layouts.admin')
@section('title', '| Editors')

 
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2>EDITORS</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('admin.editors.create') }}"> Create </a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Impersonate</th>
                            <th>Banned</th>
                            <th>Status</th>
                            <th>Online</th>
                            <th>Last Seen</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @canBeImpersonated($user,$guard=null)
                                <a href="{{route('admin.impersonate',$user->id)}}" data-toggle='tooltip' data-placement='top' title="Impersonate" class="icon-style">xx
                                </a>
                                @endCanBeImpersonated 
                            </td>
                            <td>
                                @if($user->isBanned())
                                    <label class="label label-danger">Yes</label>
                                @else
                                    <label class="label label-success">No</label>
                                @endif
                            </td>
                            <td>
                                @if($user->isBanned())
                                    <a href="{{route('admin.revoke',[$user->id])}}" class="label label-success">Revoke</a>
                                @else
                                    <a href="{{route('admin.bann',$user->id)}}" class="label label-danger">Bann</a>
                                @endif
                            </td>
                            <td>
                                @if(Cache::has('is_online' . $user->id))
                                    <label class="badge badge-pill badge-success">Online</label>
                                @else
                                    <label class="badge badge-pill badge-danger">Offline</label>
                                @endif
                            </td>
                            <td>
                                <label class="badge badge-info badge-pill">
                                    {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </label>
                            </td>
                            <td>
                                <form action="{{ route('admin.editors.destroy',$user->id) }}" method="POST">
                   
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.editors.show',$user->id) }}">Show</a>
                    
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.editors.edit',$user->id) }}">Edit</a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete {!! $user->name !!}?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
