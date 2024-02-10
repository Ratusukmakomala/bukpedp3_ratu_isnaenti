<?php

namespace App\Livewire\Admin\Menu;

use Livewire\Component;
use App\Services\Admin\Menu;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('components/layouts/admin')]
class Create extends Component
{
    use WithFileUploads;

    public $name, $price, $desc, $type, $image;

    public function render()
    {
        return view('livewire.admin.menu.create');
    }

    public function store()
    {
        $menu = new Menu();
        $imagePath = $this->image->store('images', 'public');
        $data = [
            'name'      => $this->name,
            'price'     => $this->price,
            'desc'      => $this->desc,
            'type'      => $this->type,
            'image'     => $imagePath,
        ];
        $menu->storeMenu($data);
        session()->flash('success','Data Menu Berhasil Ditambahkan');
        Storage::disk('public')->delete($imagePath);
        return redirect()->route('admin.menu.index');
    }
}
