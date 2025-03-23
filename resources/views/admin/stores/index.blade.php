
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('stores.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Store</a>
            <table class="min-w-full bg-white mt-4 border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border">No.</th>
                        <th class="py-2 px-4 border">Store Name</th>
                        <th class="py-2 px-4 border">Address</th>
                        <th class="py-2 px-4 border">Contact</th>
                        <th class="py-2 px-4 border">Coordinates</th>
                        <th class="py-2 px-4 border">Opening Time</th>
                        <th class="py-2 px-4 border">Closing Time</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                        <tr>
                            <td class="py-2 px-4 border">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">{{ $store->name }}</td>
                            <td class="py-2 px-4 border">{{ $store->address }}</td>
                            <td class="py-2 px-4 border">{{ $store->contact }}</td><td class="py-2 px-4 border">{{ $store->latitude }},{{ $store->longitude }}</td><td class="py-2 px-4 border">{{ $store->opening_time }}</td><td class="py-2 px-4 border">{{ $store->closing_time }}</td>
                            <td class="py-2 px-4 border">
                                <a href="{{ route('stores.edit', $store) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('stores.destroy', $store) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>