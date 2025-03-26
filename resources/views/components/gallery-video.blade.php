<div class="media-gallery">
    @foreach($media as $item)
        <div>
            @if($item->type == 'video')
                <iframe width="560" height="315" src="{{ $item->file_url }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <p>{{ $item->legende }}</p>
            @endif
        </div>
    @endforeach
</div>