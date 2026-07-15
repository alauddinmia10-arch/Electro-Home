<div>
    <div class="mt-8 bg-white border border-gray-100 rounded-2xl p-6 md:p-10 shadow-sm" id="qa">
        <h2 class="text-xl font-bold font-bangla mb-4">Questions & Answers about {{ $product->name }}</h2>
        
        <div class="mb-8 bg-gray-50 p-4 rounded-xl border border-gray-100">
            @if (session()->has('q_message'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('q_message') }}
                </div>
            @endif
            
            <form wire:submit.prevent="submitQuestion">
                <textarea wire:model="question_text" rows="3" placeholder="Write Your Question Here..." class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-3 resize-none"></textarea>
                @error('question_text') <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                
                <div class="flex justify-end">
                    @auth
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded text-sm font-semibold hover:bg-blue-700 transition-colors">Ask Question</button>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded text-sm font-semibold hover:bg-blue-700 transition-colors">Sign in to Ask</a>
                    @endauth
                </div>
            </form>
        </div>
        
        <div>
            <h3 class="text-sm font-medium text-gray-700 border-b border-gray-200 pb-3 mb-6">Questions answered by Electro.bd ({{ $totalQuestions }})</h3>
            
            <div class="space-y-6">
                @forelse($questions as $question)
                    <div class="pb-6 border-b border-gray-100 last:border-b-0">
                        {{-- Question --}}
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-6 h-6 shrink-0 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mt-0.5">?</div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 mb-1">{{ $question->question }}</p>
                                <p class="text-xs text-gray-500">By <span class="text-gray-700">{{ $question->user->email ?? $question->user->name }}</span> on {{ $question->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        
                        {{-- Answer --}}
                        @if($question->is_answered && $question->answer)
                        <div class="flex items-start gap-3 ml-2 pl-4 border-l-2 border-gray-200">
                            <div class="w-5 h-5 shrink-0 text-gray-400 flex items-center justify-center mt-0.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-700 mb-1 whitespace-pre-line">{{ $question->answer }}</p>
                                <p class="text-xs text-gray-500">By <span class="font-medium text-gray-700">Electro.bd</span> on {{ $question->updated_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                @empty
                    <div class="text-gray-500 text-sm text-center py-4">No questions answered yet.</div>
                @endforelse
                
                <div class="mt-4">
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
