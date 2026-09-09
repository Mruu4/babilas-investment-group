<x-layouts.admin title="Real Estate">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-big-navy-dark">Real Estate</h2>
            <p class="text-gray-500 text-sm mt-1">Manage property listings shown on the public website.</p>
        </div>
        <a href="{{ route('admin.properties.create') }}"
           class="inline-flex items-center gap-2 bg-big-navy-dark hover:bg-big-navy text-white px-4 py-2.5 rounded-lg text-sm font-medium transition shrink-0">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Property
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-xl border border-slate-200 p-4 mb-6 flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name or location..."
                   class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
        </div>
        <div class="sm:w-56">
            <select name="status" class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                <option value="">All Statuses</option>
                @foreach (['Available', 'Sold', 'Under Development', 'Coming Soon'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium transition">
            Filter
        </button>
        @if (request('search') || request('status'))
            <a href="{{ route('admin.properties.index') }}" class="text-sm text-gray-400 hover:text-gray-600 self-center">Clear</a>
        @endif
    </form>

    @if ($properties->isEmpty())
        {{-- Empty state --}}
        <div class="bg-white rounded-xl border border-slate-200 p-10 text-center">
            <div class="p-4 bg-slate-100 rounded-full text-slate-400 mb-3 inline-flex">
                <i data-lucide="building-2" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-semibold text-slate-800">No properties yet</h3>
            <p class="text-sm text-slate-500 mt-1 mb-4">Add your first property listing to get started.</p>
            <a href="{{ route('admin.properties.create') }}"
               class="inline-block bg-big-navy-dark hover:bg-big-navy text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Add Property
            </a>
        </div>
    @else

        {{-- Mobile: stacked cards --}}
        <div class="grid grid-cols-1 gap-3 sm:hidden">
            @foreach ($properties as $property)
            <div class="bg-white rounded-xl border border-slate-200 p-4">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="font-semibold text-slate-800">{{ $property->name }}</p>
                        <p class="text-xs text-slate-500">{{ $property->location }}</p>
                    </div>
                    <span class="text-[10px] font-semibold px-2 py-1 rounded-full
                        {{ $property->status === 'Available' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $property->status }}
                    </span>
                </div>
                <p class="text-sm text-slate-600 mt-2">{{ $property->price ? ($property->currency === 'USD' ? '$' : '₦') . ' ' . number_format($property->price) : 'Price on request' }}</p>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('admin.properties.edit', $property) }}" class="flex-1 text-center text-xs font-medium bg-slate-100 hover:bg-slate-200 text-slate-700 py-2 rounded-lg">Edit</a>
                    <form method="POST" action="{{ route('admin.properties.destroy', $property) }}" class="flex-1"
                          onsubmit="return confirm('Delete this property? This cannot be undone.');">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full text-xs font-medium bg-red-50 hover:bg-red-100 text-red-600 py-2 rounded-lg">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Desktop: table --}}
        <div class="hidden sm:block bg-white rounded-xl border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-left text-xs uppercase tracking-wider text-slate-400">
                        <th class="px-5 py-3">Property</th>
                        <th class="px-5 py-3">Location</th>
                        <th class="px-5 py-3">Price</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($properties as $property)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                @if ($property->images->first())
                                    <img src="{{ asset('storage/' . $property->images->first()->path) }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i data-lucide="image" class="w-4 h-4"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-800">{{ $property->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $property->property_type }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">{{ $property->location }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $property->price ? ($property->currency === 'USD' ? '$' : '₦') . ' ' . number_format($property->price) : '—' }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full
                                {{ $property->status === 'Available' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $property->status }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.properties.edit', $property) }}" class="text-slate-500 hover:text-big-navy-dark p-1.5" title="Edit">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.properties.destroy', $property) }}"
                                      onsubmit="return confirm('Delete this property? This cannot be undone.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-500 hover:text-red-600 p-1.5" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $properties->links() }}
        </div>
    @endif

</x-layouts.admin>
