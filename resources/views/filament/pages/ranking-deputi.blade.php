
<x-filament-panels::page>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                colors: {
                    clifford: '#da373d',
                }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer utilities {
        .content-auto {
            content-visibility: auto;
        }
        }
    </style>
    <style>
        /* Gaya untuk container tab */
        .overflow-x-auto {
            overflow-x: auto; /* Menambahkan scroll horizontal */
            scrollbar-width: thin; /* Untuk Firefox */
        }

        /* Gaya untuk scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px; /* Tinggi scrollbar */
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background-color: rgba(29, 78, 216, 0.5); /* Warna scrollbar */
            border-radius: 10px; /* Melengkungkan tepi scrollbar */
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(229, 231, 235, 0.5); /* Warna track scrollbar */
        }
    </style>

    <div class="">
        <h3 class="font-semibold text-lg mb-2">Filter Komsat</h3>
        <div class="flex space-x-4">
            @foreach ($this->getTabs()['Komsat'] as $label => $komsat)
                <x-filament::button
                    class="{{ $komsat === $this->komsat ? 'bg-blue-600 text-white' : 'bg-gray-300 text-black' }}"
                    wire:click="filterByKomsat('{{ $komsat }}')"
                >
                    {{ $label }}
                </x-filament::button>
            @endforeach
        </div>

        <h3 class="font-semibold text-lg mt-4 mb-2">Filter Bulan</h3>
        <div class="flex space-x-4 overflow-x-auto">
            @foreach ($this->getTabs()['Bulan'] as $label => $month)
                <x-filament::button
                    class="{{ $month === $this->month ? 'bg-blue-600 text-white' : 'bg-gray-300 text-black' }}"
                    wire:click="filterByMonth({{ $month }})"
                >
                    {{ $label }}
                </x-filament::button>
            @endforeach
        </div>
    </div>

    <table class="table-auto w-full mt-6 bg-white rounded-lg shadow-md">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Komsat</th>
                <th class="px-4 py-2">Bidang</th>
                <th class="px-4 py-2">Total Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ranking as $rank)
                <tr>
                    <td class="px-4 py-2">{{ $rank['name'] }}</td>
                    <td class="px-4 py-2">{{ $rank['komsat'] }}</td>
                    <td class="px-4 py-2">{{ $rank['bidang'] }}</td>
                    <td class="px-4 py-2">{{ $rank['total_points'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <div class="">
        <a href="{{ route('ranking-deputi.pdf', ['month' => $isActiveMonth, 'komsat' => $isActiveKomsat]) }}"
            target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Export to PDF
        </a>
    </div>


</x-filament-panels::page>
