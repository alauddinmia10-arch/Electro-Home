<div>
    @if($successMessage)
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">Thank you! Your wholesale request has been submitted successfully. We will contact you soon.</span>
        </div>
        <div class="text-center mt-4">
            <button type="button" @click="wholesaleModalOpen = false" class="bg-blue-600 text-white font-bold py-2 px-6 rounded hover:bg-blue-700 transition-colors">
                Close
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit">
            <!-- Product Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Product</label>
                <input type="text" value="{{ \App\Models\Product::find($productId)?->name }}" class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 text-gray-600 focus:outline-none" disabled>
            </div>
            
            <div class="mb-4 grid grid-cols-2 gap-4">
                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity <span class="text-red-500">*</span></label>
                    <input type="number" id="quantity" wire:model="quantity" min="1" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    @error('quantity') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>
                
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone <span class="text-red-500">*</span></label>
                    <input type="tel" id="phone" wire:model="phone" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    @error('phone') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('name') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email (Optional)</label>
                <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>

            <!-- reCAPTCHA -->
            <div class="mb-6" x-data="{
                init() {
                    window.handleRecaptchaCallback = (response) => {
                        $wire.set('captcha', response);
                    }
                    
                    window.addEventListener('reset-recaptcha', () => {
                        if (typeof grecaptcha !== 'undefined') {
                            grecaptcha.reset();
                        }
                    });
                }
            }">
                <div wire:ignore>
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback="handleRecaptchaCallback"></div>
                </div>
                @error('captcha') <span class="text-red-500 text-xs italic mt-1 block">{{ $message }}</span> @enderror
            </div>
            
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>


            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline w-full sm:w-auto transition-colors" wire:loading.attr="disabled">
                    <span wire:loading.remove>Submit Request</span>
                    <span wire:loading>Submitting...</span>
                </button>
            </div>
        </form>
    @endif
</div>
