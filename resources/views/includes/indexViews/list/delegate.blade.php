<tr>
    <td class="sorting_1" tabindex="0">{{ $delegates->firstItem()+$index }}</td>
    <td> {{ $delegate->fullname }} </td>
    <td> {{ $delegate->qualification }}</td>
    <td> {{ $delegate->phone }}</td>
    <td> @lang('site.driveType_' . $delegate->delegateDrive->type)</td>
    <td> {{ $delegate->delegateDrive->color }}</td>
    <td> {{ $delegate->delegateDrive->plate_number }}</td>
    <td class="text-left">
        <x-enable-button ability="delegate_edit" route="delegate.changeActive" isActive="{{$delegate->active }}"
            id="{{ $delegate->id }}" />
    </td>
    <td>
        <x-button :route="route('delegate.show', $delegate->id)" type="view" class="showSingleModel" />
        <x-button :route="route('delegate.edit', $delegate->id)" type="edit" />
        <x-button :route="route('delegate.destroy', $delegate->id)" type="delete" class="showSingleModel" />
    </td>
</tr>
