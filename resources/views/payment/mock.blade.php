<x-layouts.app>
    <div class="max-w-2xl mx-auto py-16 px-4">
        <div class="bg-white rounded shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-8 text-center text-white">
                <h2 class="text-2xl font-bold mb-2">SSLCommerz (Mock Sandbox)</h2>
                <p class="opacity-90">This is a local testing gateway.</p>
            </div>
            
            <div class="p-8 text-center space-y-6">
                <p class="text-gray-600">Simulate a payment response for Order: <span class="font-bold text-gray-900">{{ $tran_id }}</span></p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <!-- Success -->
                    <form action="{{ route('payment.success') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tran_id" value="{{ $tran_id }}">
                        <input type="hidden" name="val_id" value="mock_val_id_{{ time() }}">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded shadow-md transition-colors">
                            Simulate Success
                        </button>
                    </form>

                    <!-- Fail -->
                    <form action="{{ route('payment.fail') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tran_id" value="{{ $tran_id }}">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-medium rounded shadow-md transition-colors">
                            Simulate Failure
                        </button>
                    </form>

                    <!-- Cancel -->
                    <form action="{{ route('payment.cancel') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tran_id" value="{{ $tran_id }}">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded shadow-md transition-colors">
                            Simulate Cancel
                        </button>
                    </form>
                </div>
                
                <p class="text-xs text-gray-400 mt-8">Note: In production with real credentials, this page is skipped and users are sent directly to the bank payment portal.</p>
            </div>
        </div>
    </div>
</x-layouts.app>
