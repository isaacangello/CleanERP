
<tr @if(!is_null($model->deleted_at)) class="blue-grey lighten-4" @endif>
<td class="flow-text padding-0">
    <input
            class="form-control flow-text "
            type="text"
            wire:change.prevent="saveChange('Label')"
            data-id="{{ $model->id }}"
            wire:model="label"
    >
    @error('label')
    <span colspan="3" class="red-text text-darken-3 text-wrap"> {{ $message }}  </span>
    @enderror
</td>
<td class="flow-text padding-0 w-10p">
    <input
            class="form-control flow-text"
            type="text"
            wire:change.prevent="saveChange('Value')"
            data-id="{{ $model->id }}"
            wire:model="value"

    >
    @error('value')
    <span colspan="3" class="red-text text-darken-3 text-wrap"> {{ $message }}  </span>
    @enderror
</td>
<td class="flow-text padding-0 ">
    <input
            class="form-control flow-text "
            type="text"
            wire:change.prevent="saveChange('Hint')"
            data-id="{{ $model->id }}"
            wire:model="hint"

    >
    @error('hint')
    <span colspan="3" class="red-text text-darken-3 text-wrap"> {{ $message }}  </span>
    @enderror
</td>
    <td>
        @if(!is_null($model->deleted_at))
            <a class="btn-link-underline red-text darken-4">{{ $model->deleted_at }}</a>
        @else

            <button class="btn btn-link btn-danger btn-delete" wire:click="deleteBilling({{ $model->id }})">
                <span class="material-symbols-outlined">delete</span>
            </button>

        @endif
    </td>
</tr>
