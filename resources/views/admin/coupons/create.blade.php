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
                <h4>Coupon Create
                  <a href="{{route('coupons.index')}}" class="btn btn-dark float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <form class="w-px-400 border rounded p-3 p-md-3" action="{{route('coupons.store')}}"  method="POST">
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
                      <label class="form-label" for="form-alignment-username">Coupon Name</label>
                      <input type="text" name="coupon_name" id="coupon_name" class="form-control">
                    </div>

                    <div class="mb-3">
                      <label class="form-label" for="form-alignment-username">Coupon Discount</label>
                      <input type="text" name="discount" id="discount" class="form-control">
                    </div>
                                      
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save Coupon</button>
                    </div>
              
                </form>
            </div>
        </div>
    </div>
</div>
@endsection