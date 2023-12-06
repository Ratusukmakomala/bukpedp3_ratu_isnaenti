<?php

namespace App\Livewire\Admin\Menu;

use Livewire\Component;
use App\Services\Admin\Menu;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('components/layouts/admin')]
class Edit extends Component
{
    use WithFileUploads;

    public $name, $price, $desc, $type, $image, $oldImage, $menu;

    public function render()
    {
        return view('livewire.admin.menu.edit');
    }

    public function mount($id)
    {
        $menu       = new Menu();
        $oldMenu    = $menu->getMenu($id);
        $this->menu = $oldMenu;
        $this->name = $oldMenu->name;
        $this->price = $oldMenu->price;
        $this->desc = $oldMenu->desc;
        $this->type = $oldMenu->type;
        $this->oldImage = $oldMenu->image;
    }

    public function update()
    {
        $menu = new Menu();
        $data = [
            'name'      => $this->name,
            'price'     => $this->price,
            'desc'      => $this->desc,
            'type'      => $this->type
        ];
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $data['image'] = $imagePath;
        }
        $menu->updateMenu($this->menu->_id, $data);
        session()->flash('success','Data Menu Berhasil Diubah');
        if ($this->image) {
            Storage::disk('public')->delete($imagePath);
        }
        return redirect()->route('admin.menu.index');
    }
}

