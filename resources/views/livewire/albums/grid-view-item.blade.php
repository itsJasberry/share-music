@props([
'album_cover' => '',
'name' => '',
'created_at' => '',
'release_date' => '',
'artist' => '',
'withBackground' => false,
'model',
'actions' => [],
'hasDefaultAction' => false,
'selected' => false
])

<div class="w-fit relative glassmorphism {{ $withBackground ? 'rounded-4xl shadow-2xl' : '' }}">
    <div class="flex w-full h-full p-3 pl-5">
        <div class="h-[325px] w-[20px] border-l-4 border-white/40 absolute top-0 "></div>
        <div class="cd-container ml-5" style="width: 300px; height: 300px; border-radius: 50%; background: url('{{ $album_cover }}') center/cover;">
            <div class="cd-inner-ring"></div>
            @if ($hasDefaultAction)
                <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
                    <img src="{{ $album_cover }}" alt="{{ $album_cover }}" class=" cursor-pointer rounded-t-md w-[300px] h-[300px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
                </a>
            @else
                <img src="{{ $album_cover }}" alt="{{ $album_cover }}" class="rounded-t-3xl  w-[300px] h-[300px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
            @endif
            <div class="cd-hole" style="width: 40px; height: 40px; background: #fff; border-radius: 50%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>
        </div>
    </div>

    <div class="-z-10 pl-5  w-full p-4 pb-6 bg-white/40 rounded-xl">
        @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
                {!! $name !!}
            </a>
        @else
            <div class="font-bold text-lg hover:underline hover:cursor-pointer" title="{{ $name }}">
                {{ strlen($name) > 26 ? substr($name, 0, 26) . '...' : $name }}
            </div>
        @endif
            <div class="flex justify-between items-center">
                <div>{{$artist}}</div>
                <div class="text-sm text-gray-500">{{ $release_date }}</div>
            </div>



            @if (count($actions))
                <div class="flex justify-end items-center">
                    <x-lv-actions.drop-down :actions="$actions" :model="$model" />
                </div>
            @endif
    </div>

</div>
<script>
    document.querySelectorAll('.cd-container').forEach(function(container) {
        container.addEventListener('mouseover', function() {
            this.style.animationPlayState = 'running';
        });

        container.addEventListener('mouseout', function() {
            this.style.animationPlayState = 'paused';
        });
    });
</script>
