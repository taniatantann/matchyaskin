@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div id="test-container" class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <div>
                <span class="font-bold text-lg" id="step">1</span>
                <span class="text-gray-600">of {{ count($questions) }} questions</span>
            </div>
            <a href="#" class="text-sm text-blue-600">• Fitzpatrick Scale</a>
        </div>

        <div class="h-2 bg-gray-200 rounded mb-6">
            <div id="progress-bar" class="h-2 bg-blue-600 rounded" style="width: 10%;"></div>
        </div>

        <h2 class="text-xl font-semibold mb-6" id="question-text">
            {{ $questions[0]['question'] }}
        </h2>

        <form id="quiz-form">
            @csrf
            <div class="space-y-3" id="answer-options">
                @foreach ($questions[0]['choices'] as $i => $choice)
                    <button type="button" class="answer-button w-full border py-2 rounded text-sm"
                            data-score="{{ $choice['score'] }}">
                        {{ $choice['text'] }}
                    </button>
                @endforeach
            </div>

            <div class="flex justify-between mt-8">
                <button type="button" id="prevBtn" class="bg-gray-200 px-4 py-2 rounded text-sm">Previous</button>
                <button type="button" id="nextBtn" class="bg-blue-600 text-white px-6 py-2 rounded text-sm">Next</button>
            </div>
        </form>
    </div>
</div>

<script>
    const questions = @json($questions);
    let currentStep = 0;
    const answers = [];

    function renderStep() {
        const question = questions[currentStep];
        document.getElementById('step').innerText = currentStep + 1;
        document.getElementById('question-text').innerText = question.question;

        const answerOptions = document.getElementById('answer-options');
        answerOptions.innerHTML = '';
        question.choices.forEach((choice, index) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'answer-button w-full border py-2 rounded text-sm';
            btn.innerText = choice.text;
            btn.dataset.score = choice.score;
            btn.addEventListener('click', () => {
                answers[currentStep] = {
                    question: question.question,
                    answer: choice.text,
                    score: choice.score
                };
                goToNext();
            });
            answerOptions.appendChild(btn);
        });

        document.getElementById('progress-bar').style.width = ((currentStep + 1) / questions.length * 100) + '%';
        document.getElementById('prevBtn').style.visibility = currentStep === 0 ? 'hidden' : 'visible';
        document.getElementById('nextBtn').innerText = currentStep === questions.length - 1 ? 'Finish' : 'Next';
    }

    function goToNext() {
        if (currentStep < questions.length - 1) {
            currentStep++;
            renderStep();
        } else {
            submitAnswers();
        }
    }

    function goToPrev() {
        if (currentStep > 0) {
            currentStep--;
            renderStep();
        }
    }

    function submitAnswers() {
        fetch("{{ route('personal.test.submit') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ answers })
        }).then(res => res.json())
          .then(data => {
              window.location.href = data.redirect;
          });
    }

    document.getElementById('prevBtn').addEventListener('click', goToPrev);
    document.getElementById('nextBtn').addEventListener('click', goToNext);

    renderStep();

    
</script>
@endsection