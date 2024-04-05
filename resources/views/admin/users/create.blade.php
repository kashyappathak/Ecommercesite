@extends('layouts.master')
@section('content')
@if (session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="row">
    &nbsp;&nbsp;
    <div class="col-md-11" style="width:99%">
      <br/>
        <div class="card">
           
            <div class="card-header">
                <h4>User Create
                  <a href="{{route('users.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <form class="w-px-400 border rounded p-3 p-md-3" action="{{route('users.store')}}"  method="POST">
                @csrf
                @method('post')
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
                @endif
                    <div class="mb-3">
                      <label class="form-label" for="form-alignment-username">Name</label>
                      <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="form-alignment-username">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="form-alignment-role_as">role_as</label>
                        <select name="role_as" id="role_as" class="form-control">
                          <option>Select a Role</option>
                          <option value="1">SuperAdmin</option>
                          <option value="0">Employee</option>
                          <option value="2">Customer</option>
                        </select>
                      </div>
            
                    <div class="mb-3 form-password-toggle">
                      <label class="form-label" for="form-alignment-password">Password</label>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" name="password" class="form-control" placeholder="············" >
                        <span class="input-group-text cursor-pointer" id="form-alignment-password2"><i class="ti ti-eye-off"></i></span>
                      </div>
                    </div>
                   
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save User</button>
                    </div>
              
                </form>
            </div>
        </div>
    </div>
</div>
@endsection