@extends('layouts.app')
@section('content')

<div class="container-xl top">
  <h1>{{ $family->name }} Family</h1>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($members as $member)
      <tr class="  @if ($member->admin) table-warning @endif ">
        <th scope="row" class="py-3">{{$member->name}}</th>
        <td class="py-3">{{$member->email}}</td>
        <td class="py-3">{{$member->name}}</td>
        <td class="py-3">
          <div class="btn-group">
            <form action="/users/{{$member->id}}" method="POST">
              @method('PUT')
              @csrf

              @can('admin-family', $member)
              @if($member->admin)
              <button type="submit" title="Admin" class="mx-1 btn-sm btn-warning">Demote from Admin</button>
              @else
              <button type="submit" title="Admin" class="mx-1 btn-sm btn-warning">Promote to Admin</button>
              @endif
              @endcan
            </form>

            <form action="/users/{{$member->id}}" method="POST">
              @method('DELETE')

              @can('admin-family', $member)
              @csrf

              <button type="submit" title="delete" class="mx-auto btn-sm btn-danger">Delete Member</button>
              @endcan

            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @can('admin')
  <h1>Secure Invite Link</h1>
  <p>Share this link with people who you would like to invite to contribute to your cookbook</p>  
  <p>This link will expire after 5 days</p>  
  <p>{{ $inviteLink}}    </p>
  @endcan

  <br>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

</div>
@endsection