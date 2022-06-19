<form action="{{ route('login') }}" method="post">
    <label for="email">
        <input type="email" name="email" id="email">
        @error('email') <div> {{ $message }}</div> @enderror
    </label>
    <label for="password">
        <input type="password" name="password" id="password">
        @error('password') <div> {{ $message }}</div> @enderror
    </label>
    @csrf()
    <button type="submit">Entrar</button>
</form>
