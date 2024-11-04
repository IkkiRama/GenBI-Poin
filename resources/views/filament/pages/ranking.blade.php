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
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background-color: rgba(29, 78, 216, 0.5);
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(229, 231, 235, 0.5);
        }
    </style>

    {{-- Filter Komsat --}}
    <h2 class="text-lg font-semibold">Filter Komsat</h2>

    <div class="flex space-x-4">
        <x-filament::button
            class="px-4 py-2 rounded
                {{ $this->isActiveKomsat === null ? 'bg-blue-600' : 'bg-white' }}
                hover:bg-blue-700 focus:outline-none transition-colors duration-300 ease-in-out"
            wire:click="filterByKomsat(null)"
            color="{{ $this->isActiveKomsat === null ? 'primary' : 'gray'}}"
        >
            Semua Komsat
        </x-filament::button>
        <x-filament::button
            class="px-4 py-2 rounded
                {{ $this->isActiveKomsat === 'unsoed' ? 'bg-blue-600' : 'bg-white' }}
                hover:bg-blue-700 focus:outline-none transition-colors duration-300 ease-in-out"
            wire:click="filterByKomsat('unsoed')"
            color="{{ $this->isActiveKomsat === 'unsoed' ? 'primary' : 'gray'}}"
        >
            Unsoed
        </x-filament::button>
        <x-filament::button
            class="px-4 py-2 rounded
                {{ $this->isActiveKomsat === 'ump' ? 'bg-blue-600' : 'bg-white' }}
                hover:bg-blue-700 focus:outline-none transition-colors duration-300 ease-in-out"
            wire:click="filterByKomsat('ump')"
            color="{{ $this->isActiveKomsat === 'ump' ? 'primary' : 'gray'}}"
        >
            UMP
        </x-filament::button>
        <x-filament::button
            class="px-4 py-2 rounded
                {{ $this->isActiveKomsat === 'uin' ? 'bg-blue-600' : 'bg-white' }}
                hover:bg-blue-700 focus:outline-none transition-colors duration-300 ease-in-out"
            wire:click="filterByKomsat('uin')"
            color="{{ $this->isActiveKomsat === 'uin' ? 'primary' : 'gray'}}"
        >
            UIN
        </x-filament::button>
    </div>

    {{-- Filter Bulan --}}
    <h2 class="text-lg font-semibold">Filter Bulan</h2>
    <div class="overflow-x-auto">
        <div class="flex min-w-max ">
            @foreach ($this->getTabs() as $label => $month)
                <x-filament::button
                    class="px-4 py-2 rounded
                        {{ $this->isActiveMonth === $month ? 'bg-blue-600' : 'bg-white' }}
                        hover:bg-blue-700 focus:outline-none transition-colors duration-300 ease-in-out"
                    wire:click="filterByMonth({{ $month }})"
                    color="{{ $this->isActiveMonth === $month ? 'primary' : 'gray'}}"
                >
                    {{ $label }}
                </x-filament::button>
            @endforeach
        </div>
    </div>


    {{-- Tabel Ranking --}}
    @if($ranking->isNotEmpty())
        <table class="table-auto w-full mt-6 bg-white rounded-lg shadow-md">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Nama</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Komsat</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Bidang</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Total Poin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $rank)
                    <tr class="bg-white border-b">
                        <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $rank['name'] }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $rank['komsat'] }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $rank['bidang'] }}</td>
                        <td class="px-4 py-2 text-sm font-semibold text-gray-900">{{ $rank['total_points'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-4 text-gray-500">Tidak ada data untuk ditampilkan.</p>
    @endif

    <div class="">
        <a href="{{ route('export.ranking', ['month' => $isActiveMonth, 'komsat' => $isActiveKomsat]) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Export to PDF</a>
    </div>
</x-filament-panels::page>
