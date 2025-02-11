
<tr @if(!is_null($model->deleted_at)) class="text-gray-600" @endif>
<td class="border border-l-0">
    <input
            class="text-sm"
            type="text"
            wire:change.prevent="saveChange('Label')"
            data-id="{{ $model->id }}"
            wire:model="label"
            @if($showHiddenRegs) disabled @endif
    >
    @error('label')
    <span colspan="3" class="text-red-600  text-wrap"> {{ $message }}  </span>
    @enderror
</td>
<td class="text-sm border border-l-0">
    <input
            class="text-sm"
            type="text"
            wire:change.prevent="saveChange('Value')"
            data-id="{{ $model->id }}"
            wire:model="value"
            @if($showHiddenRegs) disabled @endif
    >
    @error('value')
    <span colspan="3" class="text-red-600  text-wrap"> {{ $message }}  </span>
    @enderror
</td>
<td class="border border-l-0">
    <input
            class="text-sm"
            type="text"
            wire:change.prevent="saveChange('Hint')"
            data-id="{{ $model->id }}"
            wire:model="hint"
            @if($showHiddenRegs) disabled @endif
    >
    @error('hint')
    <span colspan="3" class="text-red-600  text-wrap"> {{ $message }}  </span>
    @enderror
</td>
    <td class="align-right">
        @if(!is_null($model->deleted_at))
            <a wire:click="$dispatch('triggerRestoreBilling', { id:{{ $model->id }} })" class="">{{ $model->deleted_at }}</a>
        @else
{{--            {{ var_export($showHiddenRegs) }}--}}
            <a  class="btn btn-link btn-danger   @if($showHiddenRegs) disabled @endif" wire:click="deleteBilling({{ $model->id }})">
                <i class="fa-duotone fa-solid fa-trash"></i>
            </a>

        @endif
    </td>
</tr>
