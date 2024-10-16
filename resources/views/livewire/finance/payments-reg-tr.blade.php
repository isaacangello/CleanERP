<tr @if(!is_null($row->deleted_at)) class="blue-grey lighten-4 " @endif>
{{--    @php dd($row);  @endphp--}}
    <td class="w-20p">
        <x-text-input wire:model="title" value="{{ $row->title }}"  :disabled="$showHiddenRegs" wire:change.prevent="updateReg" />
    </td>
    <td>
        <x-text-input wire:model="notes" value="{{ $row->notes }}" :disabled="$showHiddenRegs" wire:change.prevent="updateReg" />
    </td>
    <td class="align-right">
        @if(is_null($row->deleted_at))
{{--            {{ var_export($showHiddenRegs) }}--}}
            <a href="" class="btn btn-link btn-danger btn-small" wire:click.prevent="delete"  @if($showHiddenRegs) disabled @endif>
                <span class="material-symbols-outlined">delete</span>
            </a>
        @else
            <a href="" class=" btn-link-underline blue-grey-text text-darken-3 " wire:click.prevent="restore">
                {{ $row->deleted_at }}
            </a>
        @endif

    </td>
</tr>