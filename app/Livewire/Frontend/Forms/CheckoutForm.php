<?php

namespace App\Livewire\Frontend\Forms;

use App\DTO\PaymentDTO;
use App\Enums\OrderStatus;
use App\Factories\PaymentGatewayFactory;
use App\Interfaces\PaymentGatewayInterface;
use App\Services\Cart\ExtendedCart;
use App\Traits\RegisterUtilities;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CheckoutForm extends Component
{
    use RegisterUtilities;

    public $gateway = 'paypal';

    public $addresses;

    public $address_id;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $phone = '';

    public $city;

    public $address;

    public $note;

    public function mount()
    {
        $this->addresses = auth()?->user()?->addresses()->orderBy('is_primary', 'desc')->get();
        $this->address_id = $this->addresses->where('is_primary', true)->first()?->id;
    }

    public function render()
    {
        return view('livewire.frontend.forms.checkout-form');
    }

    #[On('placeOrder')]
    public function save($gateway): void
    {
        $this->gateway = $gateway;
        if (! $this->isSupportedGateway()) {
            Toaster::error(__('The selected payment gateway is not supported'));

            return;
        }

        if (! $this->address_id) {
            $this->validate();
            $user = auth()->check() ? auth()->user() : $this->createUser(true);
            if (! $user) {
                return;
            }

            $this->createAddress($user);
        }

        try {
            if ($this->gateway == 'cash') {
                $this->handleCashOrder();

                return;
            }

            $this->handleGatewayOrder();

        } catch (\Exception $e) {
            Toaster::error($e->getMessage());

            return;
        }
    }

    protected function handleCashOrder(): void
    {
        $order = $this->cart()->createOrder($this->address_id, $this->gateway);
        $order->update(['status' => OrderStatus::PROCESSING]);
        $this->redirect(route('payment.success', $order->id), true);
    }

    protected function handleGatewayOrder(): void
    {
        try {
            DB::beginTransaction(); // Start a transaction manually

            $order = $this->cart()->createOrder($this->address_id, $this->gateway);
            $response = $this->payment()->pay(new PaymentDTO(
                $order->total,
                $order->currency,
                $order->id,
                $order->user->name,
                $order->user->email,
                $order->user->phone,
                $order->shippingAddress->address,
                $order->shippingAddress->city
            ));

            if (! $response['success']) {
                throw new Exception($response['message']);
            }

            $order->update(['payment_id' => $response['payment_id']]);
            DB::commit();

            redirect()->away($response['url']);
        } catch (\Throwable $e) {
            DB::rollBack(); // Rollback the transaction on any error
            Toaster::error($e->getMessage());
        }
    }

    protected function createAddress($user): void
    {
        $address = $user->addresses()->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'note' => $this->note,
        ]);

        $this->addresses->push($address);
        $this->address_id = $address->id;

        $this->reset(['name', 'phone', 'city', 'address', 'note']);
    }

    protected function cart(): ExtendedCart
    {
        return app(ExtendedCart::class)->shopping();
    }

    protected function payment(): PaymentGatewayInterface
    {
        return PaymentGatewayFactory::make($this->gateway);
    }

    protected function isSupportedGateway(): bool
    {
        return in_array($this->gateway, ['paypal', 'stripe', 'paymob', 'cash']);
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [Rule::requiredIf(fn () => ! auth()->check()), 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [Rule::requiredIf(fn () => ! auth()->check()), 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'phone:mobile'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:255'],
        ];
    }
}
