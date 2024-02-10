<?php

namespace App\Livewire\Admin\Order;

use App\Services\Admin\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components/layouts/admin')]
class History extends Component
{
    public $histories;

    public function render()
    {
        return view('livewire.admin.order.history');
    }

    public function mount()
    {
        $order = new Order;
        $this->histories = $order->getOrderHistory();
    }
}
