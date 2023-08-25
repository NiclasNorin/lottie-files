<div class="lottie-animation" data-js-lottie-animation>
    <div class="lottie-container" style="width: {{$width}}; justify-self: {{$position}}" data-js-lottie-player-container>
        @include('partials.icons')
    <lottie-player 
        {{ $attributeList }}
        mode="normal" 
        style="width: 100%"
        >
    </lottie-player>
    </div>
</div>