
<tr wire:key="{{ $id }}">
<td class="flow-text padding-0">
    <input
            class="form-control flow-text"
            type="text"
            wire:change.prevent="saveChange('Label')"
            data-id="{{ $id }}"
            wire:model="label"
    >
</td>
<td class="flow-text padding-0">
    <input
            class="form-control flow-text"
            type="text"
            wire:change.prevent="saveChange('Value')"
            data-id="{{ $id }}"
            wire:model="value"

    >
</td>
<td class="flow-text padding-0">
    <input
            class="form-control flow-text"
            type="text"
            wire:change.prevent="saveChange('Hint')"
            data-id="{{ $id }}"
            wire:model="hint"

    >
</td>
</tr>
