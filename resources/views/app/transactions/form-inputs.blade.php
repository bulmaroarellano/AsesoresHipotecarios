@php $editing = isset($transaction) @endphp

<div class="row">
    @if($editing)
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="folio"
            label="Folio"
            value="{{ old('folio', ($editing ? $transaction->folio : '')) }}"
            maxlength="8"
            placeholder="Folio"
            required
        ></x-inputs.text>
    </x-inputs.group>
    @endif

    <x-inputs.hidden
        name="status"
        value="{{ old('status', ($editing ? $transaction->status : '')) }}"
    ></x-inputs.hidden>
</div>
