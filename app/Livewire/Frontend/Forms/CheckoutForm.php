<?php

namespace App\Livewire\Frontend\Forms;

use App\Enums\OrderStatus;
use App\Services\Cart\ExtendedCart;
use App\Factories\PaymentGatewayFactory;
use App\Interfaces\PaymentGatewayInterface;
use App\Traits\RegisterUtilities;
use DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CheckoutForm extends Component
{
    use RegisterUtilities;

    public $single = false;

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
        $this->addresses = auth()?->user()?->addresses ?? collect();
        $this->address_id = $this->addresses->first()?->id;
    }

    public function render()
    {
        return view('livewire.frontend.forms.checkout-form');
    }

    public function updatedAddressId(): void
    {
        $address = $this->addresses->find($this->address_id);
        if ($address) {
            $this->name = $address->name;
            $this->phone = $address->phone;
            $this->city = $address->city;
            $this->address = $address->address;
        }

        $this->reset(['name', 'phone', 'city', 'address']);
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
            //            DB::beginTransaction();

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
        $this->cart()->destroy();
        $this->redirect(route('payment.success', $order->id), true);
    }

    protected function handleGatewayOrder(): void
    {
        DB::beginTransaction();
        $order = $this->cart()->createOrder($this->address_id, $this->gateway);
        $response = $this->payment()->pay($order->total, $order->id, $order->user->name, $order->user->email, $order->user->phone, $order->shippingAddress->address, $order->shippingAddress->city);
        DB::commit();

        if (! $response['success']) {
            Toaster::error($response['message']);

            return;
        }

        $order->update(['payment_id' => $response['payment_id']]);
        redirect()->away($response['url']);
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
    }

    protected function cart(): ExtendedCart
    {
        return $this->single ? app(ExtendedCart::class)->instance('single') : app(ExtendedCart::class)->shopping();
    }

    protected function payment(): PaymentGatewayInterface
    {
        return PaymentGatewayFactory::make($this->gateway);
    }

    protected function isSupportedGateway(): bool
    {
        return in_array($this->gateway, ['paypal', 'stripe', 'cash']);
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
