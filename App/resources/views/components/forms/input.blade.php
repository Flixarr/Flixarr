<div>
    <label for="{{$id}}" class="block text-sm text-muted">{{$name}}</label>
    <div class="mt-1">
        <input type="text" autocomplete="off" name="{{$id}}" id="{{$id}}" {{ $attributes->merge(['class' => 'block w-full text-white bg-gray-900 border-gray-700 rounded focus:outline-none focus:ring-0 focus:border-white disabled:opacity-50']) }} placeholder="{{$placeholder}}">
    </div>
</div>