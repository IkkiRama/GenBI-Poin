<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\PenilaianDeputiAnswer;
use App\Models\PenilaianDeputiQuestion;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PenilaianDeputi as ModelPenilaianDeputi;
use App\Models\PenilaianDeputiAnswersOption;
use App\Models\PenilaianDeputiOption;

class PenilaianDeputi extends Component
{
    public $penilaianDeputi;
    public $pd_answer;
    public $questions; // per row yang ada di tabel package question
    public $pd_answersOption;
    public $selectedAnswers = [];
    public $currentPackageQuestion;
    public $deputi;


    public function mount($penilaianId) {
        $this->penilaianDeputi = ModelPenilaianDeputi::with("package_penilaian_deputi.penilaian_deputi_question.penilaian_deputi_option")->find($penilaianId);

        if ($this->penilaianDeputi) {
            $this->questions = $this->penilaianDeputi->package_penilaian_deputi;

            if ($this->questions->isNotEmpty()) {
                $this->currentPackageQuestion = $this->questions->first();
            }
        }

        // penilaian deputi answer
        $this->pd_answer = PenilaianDeputiAnswer::where('user_id', Auth::id())
                        ->where('penilaian_deputi_id', $this->penilaianDeputi->id)
                        ->first();

        $this->deputi = User::
                        where("id","!=", Auth::user()->id)
                        ->where("komsat", Auth::user()->komsat)
                        ->where("bidang", Auth::user()->bidang)
                        ->whereHas('roles', function (Builder $query) {
                            $query->where('name', 'deputi');
                        })
                        ->first();
        if (!$this->pd_answer) {

            $this->pd_answer = PenilaianDeputiAnswer::create([
                'user_id' => Auth::id(),
                'deputi_id' => $this->deputi->id,
                'penilaian_deputi_id' => $this->penilaianDeputi->id,
            ]);

            foreach ($this->questions as $question) {
                PenilaianDeputiAnswersOption::create([
                    "pd_question_id" => $question->penilaian_deputi_question_id,
                    "pd_option_id" => null,
                    "pd_answer_id" => $this->pd_answer->id,
                    "score" => 0
                ]);
            }
        }

        $this->pd_answersOption = PenilaianDeputiAnswersOption::where('pd_answer_id', $this->pd_answer->id)->get();

        foreach ($this->pd_answersOption as $answersOption) {
            $this->selectedAnswers[$answersOption->pd_question_id] = $answersOption->pd_option_id;
        }

    }

    public function render()
    {
        return view('livewire.penilaian-deputi');
    }


    function goToQuestion($package_question_id) {
        $this->currentPackageQuestion = $this->questions->where('id', $package_question_id)->first();
    }

    function saveAnswer($questionId, $optionId) {

        $option = PenilaianDeputiOption::find($optionId);
        $score = $option->score ?? 0;

        $PenilaianDeputiAnswer = PenilaianDeputiAnswersOption::where("pd_answer_id", $this->pd_answer->id)
                        ->where("pd_question_id", $questionId)
                        ->first();

        if ($PenilaianDeputiAnswer) {
            $PenilaianDeputiAnswer->update([
                'pd_option_id' => $optionId,
                'score' => $score
            ]);
        }

        $this->pd_answersOption = PenilaianDeputiAnswersOption::where('pd_answer_id', $this->pd_answer->id)->get();

        foreach ($this->pd_answersOption as $answersOption) {
            $this->selectedAnswers[$answersOption->pd_question_id] = $answersOption->pd_option_id;
        }

    }

    function submit() {
        $this->pd_answer->update([
            "is_submited" => true
        ]);

        session()->flash("message", "Data Berhasil di Simpan");
        return redirect()->to('http://genbi-poin.test/admin/penilaian-deputis');
    }
}
