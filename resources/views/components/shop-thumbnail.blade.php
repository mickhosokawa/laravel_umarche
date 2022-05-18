<div>
    @if(empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}">
    @else
        <img src="{{ asset('public/shops/' . $filename) }}">
    @endif
</div>