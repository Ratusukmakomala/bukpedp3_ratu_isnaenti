<div>
    <x-alert />
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title">
                <div class="row">
                    <div class="col-md-6">
                        Pemesanan
                    </div>
                    <div class="col-md-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#orderModal">
                            Order
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="orderModalLabel">Order</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="modalClose"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-title" style="text-align: center;">HARAP DI ISI</div>
                                            </div>
                                            <div class="card-body">
                                                <form wire:submit='store' method="POST">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="order_name">
                                                                    <i class="bi bi-person"></i>
                                                                </span>
                                                                <input type="text" class="form-control @error('order_name') is-invalid @enderror"
                                                                    placeholder="Nama Pemesan" wire:model='order_name'>
                                                            </div>
                                                            @error('order_name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-text" id="table_number">
                                                                    <i class="bi bi-journal-richtext"></i>
                                                                </span>
                                                                <input type="number" class="form-control @error('table_number') is-invalid @enderror"
                                                                    placeholder="Table No" wire:model='table_number'>
                                                            </div>
                                                            @error('table_number')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <label class="input-group-text" for="payment">Pembayaran</label>
                                                                <select class="form-select @error('payment') is-invalid @enderror" id="payment"
                                                                    wire:model='payment'>
                                                                    <option selected>Choose...</option>
                                                                    <option value="cash">Cash</option>
                                                                    <option value="debit">Debit</option>
                                                                </select>
                                                            </div>
                                                            @error('payment')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
