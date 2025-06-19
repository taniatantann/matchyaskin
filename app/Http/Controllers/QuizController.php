<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    // soal fitz
    protected $questions = [
        1 => 'Apa warna mata Anda?',
        2 => 'Apa warna alami rambut Anda?',
        3 => 'Apa warna kulit Anda yang tidak terekspos?',
        4 => 'Apakah terdapat bintik di area kulit Anda yang tidak terekspos?',
        5 => 'Apa yang terjadi jika Anda di bawah sinar matahari terlalu lama?',
        6 => 'Seberapa parah kulit Anda dapat berubah kecokelatan?',
        7 => 'Apakah Anda berubah kecokelatan jika di bawah paparan sinar matahari selama beberapa jam?',
        8 => 'Apakah wajah Anda sensitif dengan matahari?',
        9 => 'Seberapa sering Anda berjemur?',
        10 => 'Kapan Anda terakhir kali berjemur di bawah matahari atau tanning di tanning beds?'
    ];

    // tampilin halaman soal sesuai step
    public function showStep($step)
    {
        if (!array_key_exists($step, $this->questions)) {
            return redirect()->route('user.quiz.result');
        }

        $question = $this->questions[$step];

        // jawaban khusus buat setiap soal
        $choices = [
            1 => ['Biru muda, abu muda, atau hijau muda', 'Biru, hijau, atau abu-abu', 'Biru', 'Cokelat Tua', 'Hitam Kecokelatan'],
            2 => ['Merah', 'Pirang', 'Cokelat muda atau pirang gelap', 'Cokelat Tua', 'Hitam'],
            3 => ['Kemerahan', 'Sangat Pucat', 'Pucat agak krem', 'Cokelat Muda', 'Cokelat Tua'],
            4 => ['Banyak', 'Beberapa', 'Sedikit', 'Sangat Sedikit', 'Tidak Ada'],
            5 => ['Selalu terbakar, kemerahan, melepuh dan mengelupas', 'Sering melepuh, diikuti dengan mengelupas', 'Kadang terbakar, diikuti dengan mengelupas', 'Jarang terbakar', 'Tidak pernah terbakar'],
            6 => ['Sangat jarang atau tidak pernah sama sekali', 'Sedikit kecokelatan', 'Kecokelatan yang masih wajar', 'Kecokelatan dengan mudah', 'Sangat cepat berubah menjadi cokelat tua'],
            7 => ['Tidak pernah', 'Jarang', 'Kadang-kadang', 'Sering', 'Selalu'],
            8 => ['Sangat sensitif', 'Sensitif', 'Normal', 'Resistan', 'Tidak pernah ada masalah'],
            9 => ['Tidak pernah', 'Jarang', 'Kadang-kadang', 'Sering', 'Selalu'],
            10 => ['Lebih dari 3 bulan yang lalu', 'Dalam 2 hingga 3 bulan terakhir', 'Dalam 1 hingga 2 bulan terakhir', 'Dalam minggu terakhir', 'Dalam beberapa hari terakhir'],
        ];

        return view('user.quiz.step', compact('step', 'question'))->with('options', $choices[$step]);
    }

    // simpan jawaban di session utk step tertentu terus lanjut ke next step
    public function storeStep(Request $request, $step)
    {
        $request->validate([
            'answer' => 'required|integer|min:0|max:4',
        ]);

        Session::put("quiz.step_$step", $request->input('answer'));

        $nextStep = $step + 1;
        if (!array_key_exists($nextStep, $this->questions)) {
            return redirect()->route('user.quiz.result');
        }

        return redirect()->route('user.quiz.step', ['step' => $nextStep]);
    }

    // hitung skor total dan tentuin tipe kulit fitznya
    public function showResult()
{
    $totalScore = 0;
    foreach ($this->questions as $key => $_) {
        $totalScore += Session::get("quiz.step_$key", 0);
    }

    $result = match (true) {
        $totalScore <= 6 => 'Type 1',
        $totalScore <= 13 => 'Type 2',
        $totalScore <= 20 => 'Type 3',
        $totalScore <= 27 => 'Type 4',
        $totalScore <= 34 => 'Type 5',
        default => 'Type 6'
    };

    // cek user udh login/belum, kalau udh -> update jenis kulit fitznya di db
    if (auth()->check()) {
        auth()->user()->update([
            'fitzpatrick_type' => $result,
            'fitzpatrick_score' => $totalScore,
        ]);
    }

    // arahin ke halaman baumann intro kalo udh selesai
    return redirect()->route('user.baumann.intro');
}

}
