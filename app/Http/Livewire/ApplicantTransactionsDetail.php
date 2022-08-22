<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Applicant;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantTransactionsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Applicant $applicant;
    public Transaction $transaction;
    public $ordersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Transaction';

    protected $rules = [
        'transaction.folio' => [
            'required',
            'unique:transactions,folio',
            'max:8',
            'string',
        ],
        'transaction.status' => ['required', 'boolean'],
        'transaction.order_id' => ['required', 'exists:orders,id'],
    ];

    public function mount(Applicant $applicant)
    {
        $this->applicant = $applicant;
        $this->ordersForSelect = Order::pluck('monto_solicitado', 'id');
        $this->resetTransactionData();
    }

    public function resetTransactionData()
    {
        $this->transaction = new Transaction();

        $this->transaction->order_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTransaction()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.applicant_transactions.new_title');
        $this->resetTransactionData();

        $this->showModal();
    }

    public function editTransaction(Transaction $transaction)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.applicant_transactions.edit_title');
        $this->transaction = $transaction;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        if (!$this->transaction->applicant_id) {
            $this->validate();
        } else {
            $this->validate([
                'transaction.folio' => [
                    'required',
                    Rule::unique('transactions', 'folio')->ignore(
                        $this->transaction
                    ),
                    'max:8',
                    'string',
                ],
                'transaction.status' => ['required', 'boolean'],
                'transaction.order_id' => ['required', 'exists:orders,id'],
            ]);
        }

        if (!$this->transaction->applicant_id) {
            $this->authorize('create', Transaction::class);

            $this->transaction->applicant_id = $this->applicant->id;
        } else {
            $this->authorize('update', $this->transaction);
        }

        $this->transaction->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Transaction::class);

        Transaction::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTransactionData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->applicant->transactions as $transaction) {
            array_push($this->selected, $transaction->id);
        }
    }

    public function render()
    {
        return view('livewire.applicant-transactions-detail', [
            'transactions' => $this->applicant->transactions()->paginate(20),
        ]);
    }
}
