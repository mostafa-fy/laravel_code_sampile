@extends('layouts.app')

@section('content')

<div class="container">

  @foreach ($errors->all() as $error)
  <div class="alert alert-danger" role="alert">
   {{$error}}
  </div>
  @endforeach

  @if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{Session::get('success')}}
   </div>
  @endif
    <div class="text-center">
        <h4>Dispaly Users</h4>
    </div>
  <div class="row mt-5">
    <div class="col-6">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>
    </div>
  </div>

  <table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">permissions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        @foreach ($user->permissions as $permission)
            {{$permission->name}}
        @endforeach
      </td>

    </tr>
   
    @endforeach
   
  </tbody>
</table>
{{$users->links()}}
</div>
<x-create-user :permissions='$permissions'/>
@stop