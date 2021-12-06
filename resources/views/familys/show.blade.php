@extends('layouts.app')
@section('content')

<div class="container top">
    <h1>{{ $family->name }} Family Membership</h1>
</div>

<!-- Invite -->
<div class="container">
    @can('admin')
    <h2 class="mt-2">Invite Link</h2>
    <p>Share this secure link with people who you would like to invite to contribute to your cookbook</p>

    <!-- The button used to copy the text -->
    <button class="btn btn-primary" onclick="copyTextToClipboard()">Copy Secure Link</button>
    <!-- The link field -->
    <input class="mt-1 col-6" type="text" value="{{ $inviteLink }}" id="myInput">
    <p>This link will expire after 5 days</p>
    @endcan
</div>

<!-- Members List -->
<div class="container">
    <h2 class="mt-2">Members</h2>
    @foreach ($members as $member)
    <div class="row border ">
        <div class="col-sm py-2">
            {{ $member->name }} ({{ $member->email }})
        </div>
        <div class="col-sm">
            <div class="btn-group ">
                <form action="/users/{{ $member->id }}" method="POST">
                    @method('PUT')
                    @csrf

                    @can('admin-family', $member)
                    @if ($member->admin)
                    <button type="submit" title="Admin" class="btn-sm btn-warning me-1 my-1">Demote from
                        Admin</button>
                    @else
                    <button type="submit" title="Admin" class="btn-sm btn-warning me-1 my-1 ">Promote to
                        Admin</button>
                    @endif
                    @endcan
                </form>

                <form action="/users/{{ $member->id }}" method="POST">
                    @method('DELETE')

                    @can('admin-family', $member)
                    @csrf

                    <button type="submit" title="delete" class="mx-auto btn-sm btn-danger my-1">Delete
                        Member</button>
                    @endcan
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>


<!-- Errors -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection