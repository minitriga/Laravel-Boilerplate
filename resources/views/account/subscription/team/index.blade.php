@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('account.subscription.team.update') }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                
                <div class="form-group">
                    <label for="name" class="control-label">Team Name</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name', $team->name) }}" required>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            @if ($team->users->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mamber Name</th>
                            <th>Member Email</th>
                            <th>Added</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team->users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->pivot->created_at->toDateString() }}</td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('remove-{{ $user->id }}').submit();">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>  
                </table>
            @else
                <p>You've not added any team members.</p>
            @endif

            @foreach ($team->users as $user)
                <form action="{{ route('account.subscription.team.member.delete', $user) }}" method="POST" id="remove-{{ $user->id }}" class="hidden">
                    @csrf
                    {{ method_field('DELETE') }}
                </form>
            @endforeach
            
            <form action="{{ route('account.subscription.team.member.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="control-label">Add a member by email</label>
                    <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email', $team->email) }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Add Member</button>
            </form>

        </div>
    </div>


@endsection
