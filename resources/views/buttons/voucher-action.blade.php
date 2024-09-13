<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <a href="#" class="btn btn-info px-3 m-0"
       data-bs-toggle="modal"
       data-bs-target="#voucherEditModal"
       onclick="Livewire.emit('editVoucher', {'id' : {{ $id }}})"
    >
        <i class="fas fa-pencil"></i>
    </a>
    <a href="#" class="btn btn-warning px-3 m-0"
       data-bs-toggle="modal"
       data-bs-target="#expenseModal"
       onclick="Livewire.emit('editExpenses', {'id' : {{ $id }}})"
    >
        <i class="fas fa-receipt"></i>
    </a>
</div>
