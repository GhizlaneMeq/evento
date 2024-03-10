@extends('layouts.dash')

@section('content')
<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>

            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                phone
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($users as $user)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full" src="https://i.pravatar.cc/150?img=1" alt="">
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $user->name }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                @if($user->banned)
                <a href="#" onclick="confirmUnban('{{ route('admin.users.unbanUser', $user) }}')" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Unban
                </a>
                @else

                    <a href="#" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" onclick="confirmBan('{{ route('admin.users.banUser', $user) }}')">Ban</a>
                @endif
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">@forelse ($user->roles as $role)
                    {{ $role->name }} |
                    @empty
                    No roles assigned.
                    @endforelse</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $user->phone }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $user->email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirmDelete()">
                    @csrf
                    @method('Delete')
                    <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                </form>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="roles[]" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Change Roles</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}

<script>
     function confirmDelete() {
        return confirm('Are you sure you want to delete this user?');
    }
     function confirmBan(banUrl) {
        if (confirm('Are you sure you want to ban this user?')) {
            window.location.href = banUrl;
        }
    }

    function confirmUnban(unbanUrl) {
        if (confirm('Are you sure you want to unban this user?')) {
            window.location.href = unbanUrl;
        }
    }
</script>
@endsection