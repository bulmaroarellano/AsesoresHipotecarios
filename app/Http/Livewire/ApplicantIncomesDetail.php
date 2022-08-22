<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantIncomesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Applicant $applicant;
    public Income $income;
    public $incomeFechaContratacion;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Income';

    protected $rules = [
        'income.empresa' => ['nullable', 'max:255', 'string'],
        'income.comprobante_ingresos' => [
            'nullable',
            'in:recibos de nómina,recibo de pago por honorarios,recibo de pago por arrendamiento,movimiento de cuenta de ahorro,otro',
        ],
        'income.salario_bruto' => ['nullable', 'max:9'],
        'income.salario_neto' => ['nullable', 'max:9'],
        'income.tipo_empleo' => ['nullable', 'in:formal,informal,otro'],
        'incomeFechaContratacion' => ['nullable', 'date'],
    ];

    public function mount(Applicant $applicant)
    {
        $this->applicant = $applicant;
        $this->resetIncomeData();
    }

    public function resetIncomeData()
    {
        $this->income = new Income();

        $this->incomeFechaContratacion = null;
        $this->income->comprobante_ingresos = 'Recibos de nómina';
        $this->income->tipo_empleo = 'formal';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newIncome()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.applicant_incomes.new_title');
        $this->resetIncomeData();

        $this->showModal();
    }

    public function editIncome(Income $income)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.applicant_incomes.edit_title');
        $this->income = $income;

        $this->incomeFechaContratacion = $this->income->fecha_contratacion->format(
            'Y-m-d'
        );

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
        $this->validate();

        if (!$this->income->applicant_id) {
            $this->authorize('create', Income::class);

            $this->income->applicant_id = $this->applicant->id;
        } else {
            $this->authorize('update', $this->income);
        }

        $this->income->fecha_contratacion = \Carbon\Carbon::parse(
            $this->incomeFechaContratacion
        );

        $this->income->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Income::class);

        Income::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetIncomeData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->applicant->incomes as $income) {
            array_push($this->selected, $income->id);
        }
    }

    public function render()
    {
        return view('livewire.applicant-incomes-detail', [
            'incomes' => $this->applicant->incomes()->paginate(20),
        ]);
    }
}
