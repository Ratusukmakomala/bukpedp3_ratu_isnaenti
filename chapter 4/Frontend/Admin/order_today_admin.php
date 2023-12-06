<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Services\Admin\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components/layouts/admin')]
class Today extends Component
{
    public $orders;

    public function render()
    {
        return view('livewire.admin.order.today');
    }

    public function mount()
    {
        $order = new Order;
        $this->orders = $order->getOrderToday();
    }

    public function changeStatus($id, $status)
    {
        $order = new Order;
        $order->putOrderStatus($id, ['status' => $status]);
        session()->flash('success', "Pesanan menuju $status");
        $this->dispatch('reload');
    }

    #[On('reload')]
    public function reload()
    {
        $order = new Order;
        $this->orders = $order->getOrderToday();
    }
}
