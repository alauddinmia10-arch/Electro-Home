<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class ProductQuestions extends Component
{
    use WithPagination;

    public Product $product;
    public $question_text = '';

    protected $rules = [
        'question_text' => 'required|string|min:10',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function submitQuestion()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate();

        Question::create([
            'product_id' => $this->product->id,
            'user_id' => auth()->id(),
            'question' => $this->question_text,
            'is_answered' => false,
        ]);

        $this->reset(['question_text']);
        session()->flash('q_message', 'Question submitted successfully! An admin will answer it soon.');
    }

    public function render()
    {
        $questions = Question::where('product_id', $this->product->id)
            ->where('is_answered', true)
            ->with(['user', 'answeredBy'])
            ->latest('updated_at') // order by answer time roughly
            ->paginate(5, ['*'], 'questionsPage');
            
        $totalQuestions = Question::where('product_id', $this->product->id)->where('is_answered', true)->count();

        return view('livewire.product-questions', [
            'questions' => $questions,
            'totalQuestions' => $totalQuestions,
        ]);
    }
}
