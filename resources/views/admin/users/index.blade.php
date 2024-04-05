@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>User View
                @if(Auth::user()->role_as == '1')<a href="{{route('users.create')}}" class="btn btn-dark float-end">Create User</a>@endif
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                
            @endif
            <div class="table-responsive">
                <table  id="myDatatable" class="table table-bordered table-group-divider ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td ><span class="badge {{ $user->role_as == 1 ? 'bg-success' : ($user->role_as =='0' ? 'bg-primary': 'bg-danger') }}" style="font-size: 15px;">{{$user->name}}</span></td>
                            <td>{{$user->email}}</td> 
                           
                            <td>
                                <span class="badge {{ $user->role_as == 1 ? 'bg-success' : ($user->role_as =='0' ? 'bg-primary': 'bg-danger') }}" style="font-size: 15px;">
                                    {{-- {{ $user->role_as == '1' ? 'SuperAdmin' : ($user->role_as == '0' ? 'Employee' : 'Customer') }} --}}
                                        @if($user->role_as == '1')
                                        <i class="fas fa-crown"></i> SuperAdmin
                                    @elseif($user->role_as == '0')
                                        <i class="fas fa-user-tie"></i> Employee
                                    @else
                                        <i class="fas fa-user"></i> Customer
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if(Auth::user()->role_as =='1')
                                <a href="{{route('users.edit',$user->id)}}" >  <span class="svg-icon svg-icon-md">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                                                height="2" rx="1" />
                                        </g>
                                    </svg>
                                </span></a>
    
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin-left: 20px;margin-top:-28px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: white;border:none">
                                        <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                        </span>
                                    </button>
                                    
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
</div>
@endsection