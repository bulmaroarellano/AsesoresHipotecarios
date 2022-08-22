@php $editing = isset($order) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="destino" label="Destino" id="destino">
            @php $selected = old('destino', ($editing ? $order->destino : '')) @endphp
            <option value="casa" {{ $selected == 'casa' ? 'selected' : '' }}>Casa</option>
            <option value="auto" {{ $selected == 'auto' ? 'selected' : '' }} >Auto</option>
            <option value="préstamo" {{ $selected == 'prestamo' ? 'selected' : '' }} >Prestamo</option>
            <option value="tarjeta de crédito" {{ $selected == 'tarjeta de credito' ? 'selected' : '' }} >Tarjeta de credito</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
        id="monto_solicitado"
            name="monto_solicitado"
            label="Monto Solicitado"
            value="{{ old('monto_solicitado', ($editing ? $order->monto_solicitado : '')) }}"
            maxlength="255"
            placeholder="Monto Solicitado"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="plazo"
            label="Plazo"
            value="{{ old('plazo', ($editing ? $order->plazo : '')) }}"
            maxlength="2"
            placeholder="Plazo"
        ></x-inputs.text>
    </x-inputs.group>
</div>
