<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-bold mb-4">Add New Store</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('stores.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block font-medium">Store Name</label>
                        <input type="text" name="name" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label for="address" class="block font-medium">Address</label>
                        <input type="text" id="address" name="address" class="w-full p-2 border rounded" placeholder="Enter store address" required>
                        <p class="text-gray-600 text-sm mt-1">* Start typing and select the correct address.</p>
                        <div id="address-suggestions" class="mt-1 hidden bg-white border rounded shadow-lg"></div>
                    </div>

                    <div>
                        <label for="contact" class="block font-medium">Contact</label>
                        <input type="text" name="contact" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label for="latitude" class="block font-medium">Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="w-full p-2 border rounded bg-gray-100" readonly required>
                    </div>

                    <div>
                        <label for="longitude" class="block font-medium">Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="w-full p-2 border rounded bg-gray-100" readonly required>
                    </div>

                    <div>
                        <label for="opening_time" class="block font-medium">Opening Time</label>
                        <input type="time" id="opening_time" name="opening_time" class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label for="closing_time" class="block font-medium">Closing Time</label>
                        <input type="time" id="closing_time" name="closing_time" class="w-full p-2 border rounded" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
                    <a href="{{ route('stores.index') }}" class="ml-2 text-gray-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let timer;
        const addressInput = document.getElementById('address');
        const suggestionsContainer = document.getElementById('address-suggestions');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        // Function to search for address suggestions
        addressInput.addEventListener('input', function() {
            clearTimeout(timer);
            
            // Display the suggestions container
            suggestionsContainer.classList.remove('hidden');
            
            const query = this.value.trim();
            if (query.length < 3) {
                suggestionsContainer.innerHTML = '';
                suggestionsContainer.classList.add('hidden');
                return;
            }
            
            // Add loading indicator
            suggestionsContainer.innerHTML = '<div class="p-2 text-gray-500">Searching...</div>';
            
            // Debounce the API call
            timer = setTimeout(() => {
                fetchAddressSuggestions(query);
            }, 500);
        });

        // Function to fetch address suggestions
        function fetchAddressSuggestions(query) {
            // Using Nominatim service for address search
            fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&limit=5&addressdetails=1`, {
                headers: {
                    'Accept': 'application/json',
                    'User-Agent': 'StoreLocator/1.0' 
                }
            })
            .then(response => response.json())
            .then(data => {
                suggestionsContainer.innerHTML = '';
                
                if (data.length === 0) {
                    suggestionsContainer.innerHTML = '<div class="p-2 text-gray-500">No addresses found</div>';
                    return;
                }
                
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                    div.textContent = item.display_name;
                    div.addEventListener('click', () => {
                        addressInput.value = item.display_name;
                        latitudeInput.value = item.lat;
                        longitudeInput.value = item.lon;
                        suggestionsContainer.classList.add('hidden');
                    });
                    suggestionsContainer.appendChild(div);
                });
            })
            .catch(error => {
                console.error('Error fetching address suggestions:', error);
                suggestionsContainer.innerHTML = '<div class="p-2 text-red-500">Error fetching suggestions</div>';
            });
        }

        // Hide suggestions when clicking elsewhere
        document.addEventListener('click', function(event) {
            if (!addressInput.contains(event.target) && !suggestionsContainer.contains(event.target)) {
                suggestionsContainer.classList.add('hidden');
            }
        });

        // Validate form before submission
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!latitudeInput.value || !longitudeInput.value) {
                event.preventDefault();
                alert('Please select a valid address to get coordinates');
            }
        });
    </script>
    
</x-app-layout>
