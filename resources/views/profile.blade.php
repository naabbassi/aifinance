@extends('layout')
@section('title')
    AIF :: My Profile
@endsection
@section('content')
<div class="card card">
    <div class="card-header bg-"><h4 class="">Personal Information</h4></div>
    <div class="card-body">
      <form method="POST" action="/user/profile/update">
        @csrf
        <div class="row">
          <div class="form-group col-6">
            <label for="name">First Name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" autofocus>
            @error('name')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
          </div>
          <div class="form-group col-6">
            <label for="family">Last Name</label>
            <input id="family" type="text" class="form-control" name="family" value="{{ $user->family }}">
            @error('family')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
          </div>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label >Birthday</label>
                @php
                    $date = new DateTime($user->birthday);
                @endphp
                <input type="date" name="birthday" class="form-control" value="{{ $date->format('Y-m-d')}}">
                @error('birthday')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
              </div>
          <div class="form-group col-6">
              <label>Gender</label>
              <select class="form-control selectric" name="sex">
                  <option @if($user->sex == 'm') selected @endif value="m">Man</option>
                  <option @if($user->sex == 'w') selected @endif value="w">Woman</option>
                </select>
                @error('sex')
                  <small class="form-text text-danger ">{{ $message }}</small>
                @enderror
            </div>
          </div>
        <div class="row">
          <div class="form-group col-6">
            <label>Country</label>
            <select class="form-control selectric" name="country">
              @foreach ($countries as $item)
              <option @if($user->country == $item->id) selected @endif value={{$item->id}}>{{$item->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-6">
              <label>Phone</label>
              <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
              @error('phone')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
            </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary ">
            Update information
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="card card">
    <div class="card-header bg-dark"><h4 class="text-danger">Change Password</h4></div>
    <div class="card-body">
      <form method="POST" action="/user/profile/password/update">
        @csrf
        <div class="row">
          <div class="form-group col-12">
            <label>Current Password</label>
            <input  type="password" class="form-control" name="current_password">
            @error('current_password')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
          </div>
          <div class="form-group col-6">
            <label>New Password</label>
            <input  type="password" class="form-control" name="password" value="{{ old('password') }}">
            @error('password')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
          </div>
          <div class="form-group col-6">
            <label >Repeat Password</label>
            <input  type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
            @error('password_confirmation')
              <small class="form-text text-danger ">{{ $message }}</small>
             @enderror
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary ">
            Change Password
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection 
