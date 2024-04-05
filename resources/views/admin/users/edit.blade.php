@extends('layouts.master')
@section('content')
@if (session('message'))
<div class="alert alert-danger">{{session('message')}}</div>
@endif
<div class="row">
    &nbsp;&nbsp;
    <div class="col-md-11" style="width:99%">
        <div class="card">
           
            <div class="card-header">
                <h4>User Edit
                  <a href="{{route('users.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <form class="w-px-400 border rounded p-3 p-md-3" action="{{route('users.update',$user->id)}}"  method="POST">
                @csrf
                @method('put')
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
                @endif
                    <div class="mb-3">
                      <label class="form-label" for="form-alignment-username">Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{old('name',$user->name)}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form-alignment-username">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}">
                    </div>

                    <div class="mb-3">
                      <label>Role as</label>
                      <select name="role_as" id="role_as" class="form-control">
                          <option value="1" {{$user->role_as == '1'? 'selected':''}}>SuperAdmin</option>
                          <option value="0"{{$user->role_as == '0'? 'selected':''}}>Employee</option>
                          <option value="2"{{$user->role_as == '2'? 'selected':''}}>Customer</option>
                      </select>
                       <br/>
                    </div>
                    
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="form-alignment-password">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" name="password" class="form-control" placeholder="············" aria-describedby="form-alignment-password2" value="{{old('password',$user->password)}}" readonly>
                        <span class="input-group-text cursor-pointer" id="form-alignment-password2"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                   
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Edit User</button>
                    </div>
              
                </form>
            </div>
        </div>
    </div>
</div>
@endsection