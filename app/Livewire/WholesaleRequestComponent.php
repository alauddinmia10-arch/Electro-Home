<?php

namespace App\Livewire;

use App\Models\WholesaleRequest;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class WholesaleRequestComponent extends Component
{
    public $productId;
    public $quantity = 1;
    public $name = '';
    public $phone = '';
    public $email = '';
    public $captcha = '';
    
    public $successMessage = false;

    public function submit()
    {
        $this->validate([
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'captcha' => 'required',
        ], [
            'captcha.required' => 'Please complete the reCAPTCHA verification.',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $this->captcha,
        ]);

        if (! $response->json('success')) {
            $this->addError('captcha', 'reCAPTCHA verification failed. Please try again.');
            $this->dispatch('reset-recaptcha');
            return;
        }

        $wholesaleRequest = WholesaleRequest::create([
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => 'pending',
        ]);

        $admins = User::where('is_admin', true)->orWhere('id', 1)->get(); 
        
        Notification::make()
            ->title('New Wholesale Request')
            ->body("{$this->name} has requested {$this->quantity} units of product ID {$this->productId}.")
            ->success()
            ->sendToDatabase($admins);

        $this->successMessage = true;
        
        $this->reset(['quantity', 'name', 'phone', 'email', 'captcha']);
        $this->quantity = 1;
        
        $this->dispatch('wholesale-request-submitted');
    }

    public function render()
    {
        return view('livewire.wholesale-request-component');
    }
}
