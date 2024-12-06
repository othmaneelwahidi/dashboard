@extends('layouts.navigation')
@extends('layouts.navbar')
@section('content')
    <h1>Action Logs</h1>
    <div class="table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Administrateur</th>
                    <th>Notification</th>
                    <th>DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actions as $index => $action)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $action->user->name }}</td>
                        <td class="{{ $action->action }}">
                            {{ ucfirst(str_replace('_', ' ', $action->action)) }}
                        </td>
                        <td>{{ $action->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
