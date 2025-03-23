<x-guest-layout>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    showStores, 
                    showError, 
                    { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showStores(position) {
            fetch(`/nearby-stores?latitude=${position.coords.latitude}&longitude=${position.coords.longitude}`)
                .then(response => response.json())
                .then(data => {
                    let storeTable = document.getElementById("storeTableBody");
                    storeTable.innerHTML = ""; // Clear previous data

                    data.forEach((store, index) => {
                        storeTable.innerHTML += `
                            <tr class="border-b">
                                <td class="p-3 text-center">${index + 1}</td>
                                <td class="p-3">${store.name}</td>
                                <td class="p-3">${store.address}</td>
                                <td class="p-3 text-center">${store.distance.toFixed(2)} km</td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>

    <body onload="getLocation()" class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <h1 class="text-2xl font-semibold mb-4 text-center">Nearby Stores</h1>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <table class="min-w-full bg-white mt-4 border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border">#</th>
                        <th class="py-2 px-4 border">Store Name</th>
                        <th class="py-2 px-4 border">Address</th>
                        <th class="py-2 px-4 border">Distance</th>
                    </tr>
                </thead>
                <tbody id="storeTableBody">
                    <tr><td colspan="4" class="p-3 text-center">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </body>
</x-guest-layout>
