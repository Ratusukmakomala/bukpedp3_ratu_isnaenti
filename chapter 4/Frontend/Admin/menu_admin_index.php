<?php

namespace App\Livewire\Admin\Menu;

use App\Services\Admin\Menu;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components/layouts/admin')]
class Index extends Component
{
    public $menus;

    public function render()
    {
        return view('livewire.admin.menu.index');
    }

    public function mount()
    {
        $menu = new Menu();
        $this->menus = $menu->getMenus();
    }

    public function delete($id)
    {
        $menu = new Menu();
        $menu->deleteMenu($id);

        $this->dispatch('reload');
    }

    #[On('reload')]
    public function reload()
    {
