<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($editMode)
                {{ __('songs.labels.edit_form_title') }}
            @else
                {{ __('songs.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('songs.attributes.title') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="song.title" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('songs.index') }}" secondary class="mr-2 bg-blue-200" label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" class="bg-blue-300" spinner />
        </div>
    </form>
</div>
