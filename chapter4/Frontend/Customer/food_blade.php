<div>
    <x-alert />
    <x-menu-header title="Makanan" />
    <div class="row">
        @forelse ($foods as $food)
        <div class="col-md-6">
            <div class="card border-warning mb-3" style="max-width: 600px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $food->image }}" class="img-fluid rounded-start" alt="{{ $food->name }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $food->name }}<span class="float-end"></h5>
                            <p class="card-text">{{ $food->desc }}</p>
                            <p class="card-text"><small class="text-body-secondary">&nbsp;</small></p>
                            <button type="button" class="btn btn-warning float-end text-white mb-3" wire:click="addToCart('{{ $food->_id }}', '{{ $food->name }}', '{{ $food->price }}')">Tambah Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="card text-bg-warning text-center">
                <div class="card-header">
                    <div class="card-title text-white text-center">No Data Found</div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
