<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

// Mendapatkan jadwal absensi yang sedang ditampilkan
$now = Carbon::now('Asia/Jakarta');

$startTime = Carbon::parse($penilaianDeputi->start_time, 'Asia/Jakarta');
$endTime = Carbon::parse($penilaianDeputi->end_time, 'Asia/Jakarta');

?>

@if (Auth::user()->getRoleNames()[0] !== "super_admin" && !$now->between($startTime, $endTime))
    <div>
        <h2 class="text-2xl font-bold mb-4">{{ $penilaianDeputi->judul }}</h2>

        <div style="background-color: red;" class="d-flex items-center justify-content-center rounded px-3 py-3 w-full mb-4">
            <h2 class="text-lg md:text-xl text-white font-bold mb-3 text-center">Waktu Sudah Habis</h2>
            <p class="text-base md:text-lg text-white text-center">
                Waktu yang telah ditentukan untuk menyelesaikan penilaian ini telah berakhir.
            </p>
        </div>


        <div class="overflow-x-auto mb-4">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Pertanyaan</th>
                        <th class="py-3 px-6 text-left">Jawaban</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($questions as $index => $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $index+1 }}</td>
                            <td class="py-3 px-6">{{ $item->penilaian_deputi_question->question }}</td>
                            <td class="py-3 px-6">{{
                                $pd_answersOption[$index]->pd_option_id === null ?
                                "Belum Diisi" :
                                $item->penilaian_deputi_question->penilaian_deputi_option->where("id", $pd_answersOption[$index]->pd_option_id)->first()->option_text
                            }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-filament::button onclick="window.location.href='http://genbi-poin.test/admin/penilaian-deputis'" style="background-color: #096cd6; color: white;">
                Kembali
        </x-filament::button>

    </div>
@else

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @if (session()->has("message"))
    <div style="background-color: rgb(34 197 94);" class="md:col-span-2 border border-success-300 w-full px-4 py-3 mb-4 rounded relative">
        <strong class="font-bold">Penilaian Berhasil Dikirim!</strong>
        <span class="block sm:inline">{{ session('message') }}</span>
    </div>
    @endif

    @if ($this->pd_answer->is_submited)
    <div style="background-color: rgb(34 197 94);" class="md:col-span-2 border border-success-300 w-full px-4 py-3 mb-4 rounded relative">
        <strong class="font-bold">Penilaian Berhasil Dikirim!</strong>
        <span class="block sm:inline">Anda sudah mengirimkan {{ $penilaianDeputi->judul }} </span>
    </div>
    @endif

    <div class="md:col-span-2 bg-white shadow-md rounded-lg p-4">

        <h2 class="text-2xl font-bold mb-4">{{ $penilaianDeputi->judul }}</h2>
        <p class="text-gray-700 ">{{ $currentPackageQuestion->penilaian_deputi_question->question }}</p>
        <div class="mx-4 mt-6 bg-red-500">
            @foreach ($currentPackageQuestion->penilaian_deputi_question->penilaian_deputi_option as $item)
                <?php
                    $answer = $pd_answersOption
                                ->where("pd_question_id", $currentPackageQuestion->penilaian_deputi_question_id)
                                ->first();
                    $selected = $answer ? $answer->pd_option_id == $item->id : false;
                ?>
                <label class="block mb-2">
                    <input
                    type="radio"
                    value="{{ $item->id }}"
                    @if ($this->pd_answer->is_submited && $now->between($startTime, $endTime))
                        disabled
                    @endif
                    id="option_{{ $currentPackageQuestion->penilaian_deputi_question_id }}_{{ $item->id }}"
                    name="option_{{ $currentPackageQuestion->penilaian_deputi_question_id }}_{{ $item->id }}"
                    wire:model="selectedAnswers.{{ $currentPackageQuestion->penilaian_deputi_question_id }}"
                    wire:click="saveAnswer({{ $currentPackageQuestion->penilaian_deputi_question_id }}, {{ $item->id }})"
                    @if ($pd_answersOption->isNotEmpty() || $pd_answersOption->contains('pd_option_id', $item->id))
                        checked
                    @endif
                    >
                    {{ $item->option_text }}
                </label>
            @endforeach
        </div>
    </div>

    <div class="md:col-span-1 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Navigasi Penilaian</h2>
        <p class="text-gray-700 mb-4">Pilih tombol dibawah ini untuk berganti penilaian</p>
        @foreach ($questions as $index => $item)
            @php
                $isAnswered = isset($selectedAnswers[$item->penilaian_deputi_question_id]) &&
                !is_null($selectedAnswers[$item->penilaian_deputi_question_id]);

                $isActive = $currentPackageQuestion->penilaian_deputi_question->id === $item->penilaian_deputi_question_id;
            @endphp
            <x-filament::button
                wire:click="goToQuestion({{ $item->id }})"
                color="{{ $isActive ? 'info' : ($isAnswered ? 'success' : 'gray') }}"
                class="shadow-lg mb-4 px-6 py-3"
            >
            {{ $index+1 }}
            </x-filament::button>
        @endforeach
        @if (!in_array(null, $selectedAnswers) || !$now->between($startTime, $endTime))
            <x-filament::button
            class="w-full mt-5"
            wire:click="submit"
            onclick="return confirm('Apakah anda yakin ingin mengirim jawaban ini?')"
            :disabled="$this->pd_answer->is_submited && $now->between($startTime, $endTime)"
            >
                Kirim Penilaian
            </x-filament::button>
        @endif
    </div>

</div>

@endif
<script>
    // Menghitung waktu akhir
    const endTime = new Date("{{ $endTime }}").getTime(); // Konversi waktu endTime ke timestamp

    function checkTime() {
        const now = new Date().getTime(); // Waktu sekarang
        if (now >= endTime) {
            document.getElementById('submit-button').click(); // Auto submit
        }
    }

    // Cek setiap detik
    setInterval(checkTime, 1000);
</script>
