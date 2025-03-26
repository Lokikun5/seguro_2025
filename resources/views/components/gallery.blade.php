<div class="media-gallery">
    @foreach($media as $item)
        @if($item->type == 'photo')
            <div style="display:inline-block; margin:10px;">
                <a href="javascript:void(0)" class="open-modal" data-slide-index="{{ $loop->index }}">
                    <img src="{{ asset('storage/media/photos/' . $item->file_name) }}" alt="{{ $item->name }}" style="width:150px; height:150px; object-fit:cover;">
                </a>
                <p>{{ $item->legende }}</p>
            </div>
        @endif
    @endforeach
</div>