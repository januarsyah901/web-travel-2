<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex font-sans bg-gray-100 m-0 p-0">
    <div class="w-64 bg-gray-800 text-white h-screen p-5 box-border">
        <h2 class="mt-0 text-white">Admin Menu</h2>
        <ul class="list-none p-0">
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ !$section ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Dashboard</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}?section=packages" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ $section == 'packages' ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Packages</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}?section=bookings" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ $section == 'bookings' ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Bookings</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}?section=galleries" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ $section == 'galleries' ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Galleries</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}?section=mutawwifs" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ $section == 'mutawwifs' ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Mutawwifs</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}?section=partners" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ $section == 'partners' ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Partners</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.dashboard') }}?section=testimonials" class="text-gray-300 no-underline block p-2 rounded transition-colors duration-300 {{ $section == 'testimonials' ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">Testimonials</a>
            </li>
        </ul>
    </div>
    <div class="flex-1 p-5 box-border">
        <div class="bg-white p-5 rounded-lg shadow-lg">
            <h1 class="text-gray-800 mb-2">Admin Dashboard{{ $section ? ' - ' . ucfirst($section) : '' }}</h1>
            <div class="mb-8 flex justify-between items-center">
                <p>Hello, {{ Auth::guard('admin')->user()->name }}</p>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white border-none px-5 py-2 rounded cursor-pointer hover:bg-red-600">Logout</button>
                </form>
            </div>

            @if($resource)
                <h2 class="text-gray-800">{{ ucfirst($resource) }}</h2>
                <a href="{{ route($resource . '.create') }}" class="bg-green-500 text-white px-5 py-2 rounded inline-block mb-5 no-underline hover:bg-green-600">Create New {{ ucfirst(substr($resource, 0, -1)) }}</a>
                @if($data->count() > 0)
                    <table class="w-full border-collapse mt-5">
                        <thead>
                            <tr>
                                @foreach($fields as $field)
                                    <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">{{ ucfirst(str_replace(['.', '_'], [' ', ' '], $field)) }}</th>
                                @endforeach
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr class="hover:bg-gray-50">
                                    @foreach($fields as $field)
                                        <td class="p-3 text-left border-b border-gray-300">
                                            @if(str_contains($field, 'registered_at') || str_contains($field, 'birthDate'))
                                                {{ data_get($item, $field) ? data_get($item, $field)->format('Y-m-d H:i') : 'N/A' }}
                                            @elseif(str_contains($field, 'price'))
                                                ${{ number_format(data_get($item, $field), 2) }}
                                            @elseif(str_contains($field, '_path'))
                                                @if(data_get($item, $field))
                                                    <a href="{{ asset('storage/' . data_get($item, $field)) }}" target="_blank" class="text-blue-500 hover:underline">View</a>
                                                @else
                                                    N/A
                                                @endif
                                            @else
                                                {{ data_get($item, $field) }}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="p-3 text-left border-b border-gray-300">
                                        <a href="{{ route($resource . '.edit', $item->id) }}" class="bg-blue-500 text-white px-2.5 py-1 rounded mr-1 no-underline hover:bg-blue-600">Edit</a>
                                        <form method="POST" action="{{ route($resource . '.destroy', $item->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white border-none px-2.5 py-1 rounded cursor-pointer hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-500 italic">No {{ $resource }} found.</p>
                @endif
            @else
                <h2 class="text-gray-800">List of Users</h2>
                @if($users->count() > 0)
                    <table class="w-full border-collapse mt-5">
                        <thead>
                            <tr>
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">ID</th>
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">Full Name</th>
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">Birth Date</th>
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">Address</th>
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">Phone</th>
                                <th class="p-3 text-left bg-gray-100 text-gray-800 border-b border-gray-300">Has Passport</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 text-left border-b border-gray-300">{{ $user->id }}</td>
                                    <td class="p-3 text-left border-b border-gray-300">{{ $user->fullName }}</td>
                                    <td class="p-3 text-left border-b border-gray-300">{{ $user->birthDate ? $user->birthDate->format('Y-m-d') : 'N/A' }}</td>
                                    <td class="p-3 text-left border-b border-gray-300">{{ $user->address }}</td>
                                    <td class="p-3 text-left border-b border-gray-300">{{ $user->phone }}</td>
                                    <td class="p-3 text-left border-b border-gray-300">{{ $user->hasPassport ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-500 italic">No users found.</p>
                @endif
            @endif
        </div>
    </div>
</body>
</html>
