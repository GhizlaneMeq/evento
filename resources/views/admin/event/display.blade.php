{{-- @extends('layouts.dash')

@section('content')
<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Title
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Location
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Available Seats
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($events as $event)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->title }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->date->format('M d, Y') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->location }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->availableSeats }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $event->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($event->status) }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <form action="{{ route('admin.events.updateStatus', $event) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()">
                        <option value="confirmed" {{ $event->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $event->status === 'cancelled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Display pagination links -->
{{ $events->links() }}

@endsection
 --}}

 @extends('layouts.dash')

@section('content')
<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Title
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Date
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Location
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Available Seats
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($events as $event)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->title }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->date->format('M d, Y') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->location }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $event->availableSeats }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span id="status-{{ $event->id }}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $event->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($event->status) }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <select name="status" onchange="updateEventStatus('{{ route('admin.events.updateStatus', $event) }}', this.value)">
                    <option value="confirmed" {{ $event->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $event->status === 'cancelled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

v {{ $events->links() }}

@endsection

@section('scripts')
<script>
    function updateEventStatus(url, status) {
        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            /* const statusElement = document.getElementById('status-' + data.id);
            console.log(statusElement)
            statusElement.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
            statusElement.className = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' + (data.status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800');*/
        })
        .catch(error => { 
            console.error('There was a problem with the fetch operation:', error);
        });
    }
</script>
@endsection
