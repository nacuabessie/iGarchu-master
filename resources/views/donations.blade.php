@extends('layouts.admin-layout')

@section('content')
    <div class="container mx-auto w-full pr-4">
        <div class="mb-4">
            <div class="flex items-center justify-between">
                <h2>Donations</h2>
                <div>
                    <label for="isActiveFilter" class="text-sm text-gray-500">Filter by IsActive:</label>
                    <select id="isActiveFilter" name="isActiveFilter" class="ml-2 border p-1 rounded-md" onchange="filterTable()">
                        <option value="all">All</option>
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                </div>
            </div>
        </div>

        @if(isset($donations) && count($donations) > 0)
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <table class="min-w-full bg-white border border-brown-500 rounded-lg overflow-hidden table-auto">
                    <thead class="bg-brown-300 text-brown-700">
                        <tr>
                            @foreach(['Caption', 'Description', 'Gathered Amount', 'Target Amount', 'Date Started','Date Ended',  'Is Active'] as $header)
                                <th class="py-2 border-b cursor-pointer" data-key="{{ $header }}" onclick="sortTable('{{ $header }}')">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="donationsTableBody">
                        @foreach($donations as $item)
                            <tr class="donation-row {{ $item['isActive'] == "true" ? 'active' : 'inactive' }}">
                                <td class="py-2 px-4 border-b">{{ $item['caption'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item['description'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item['gatheredAmount'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item['targetAmount'] }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item['dateStarted'])->format('F j, Y') }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item['dateEnded'])->format('F j, Y') }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item['isActive'] == "true" ? 'Yes' : 'No' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if ($item['gatheredAmount'] >= $item['targetAmount'] && $item['isActive'] == "true")
                                        <form method="POST" action="{{ url('/api/donations/close/' . $item['id']) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <button class="bg-red-500 text-white px-2 py-1 rounded-md">Close</button>
                                        </form>
                                    @else
                                        <button class="bg-red-200 text-white px-2 py-1 rounded-md" disabled>Close</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No donations found.</p>
        @endif

        <script>
            let sortOrder = 1;
            let sortKey = '';

            function sortTable(key) {
                if (sortKey === key) {
                    sortOrder *= -1;
                } else {
                    sortOrder = 1;
                }

                sortKey = key;

                const tableBody = document.getElementById('donationsTableBody');
                const rows = Array.from(tableBody.getElementsByClassName('donation-row'));

                const columnIndex = Array.from(document.querySelector('thead tr').children).indexOf(event.target);

                rows.sort((a, b) => {
                    const aValue = getValue(a, columnIndex);
                    const bValue = getValue(b, columnIndex);

                    return (aValue < bValue ? -sortOrder : aValue > bValue ? sortOrder : 0);
                });

                rows.forEach(row => tableBody.removeChild(row));

                rows.forEach(row => tableBody.appendChild(row));

                updateArrowIndicators();
            }

            function getValue(row, columnIndex) {
                const cell = row.getElementsByTagName('td');
                let value = cell[columnIndex].textContent.trim();

                if (sortKey === 'dateEnded' || sortKey === 'dateStarted') {
                    value = new Date(value);
                }

                return value;
            }

            function updateArrowIndicators() {
                const headers = document.querySelectorAll('thead th');
                headers.forEach(header => {
                    const columnKey = header.getAttribute('data-key');
                    header.innerHTML = `${columnKey}${columnKey.toLowerCase() === sortKey.toLowerCase() ? ` ${sortOrder === 1 ? '▲' : '▼'}` : ''}`;
                });
            }

            function filterTable() {
                const isActiveFilter = document.getElementById('isActiveFilter').value;
                const rows = document.getElementsByClassName('donation-row');

                Array.from(rows).forEach(row => {
                    const isActive = row.classList.contains('active');
                    const shouldShow = (isActiveFilter === 'all') || (isActiveFilter === 'true' && isActive) || (isActiveFilter === 'false' && !isActive);
                    row.style.display = shouldShow ? '' : 'none';
                });
            }
        </script>
    </div>
@endsection
