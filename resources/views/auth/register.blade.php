<form action="{{ route('register') }}" method="post">
    <label for="first_name">
        <input type="text" name="first_name" id="first_name">
        @error('first_name')
        <div> {{ $message }}</div> @enderror
    </label>
    <label for="last_name">
        <input type="text" name="last_name" id="last_name">
        @error('last_name')
        <div> {{ $message }}</div> @enderror
    </label>
    <label for="email">
        <input type="email" name="email" id="email">
        @error('email')
        <div> {{ $message }}</div> @enderror
    </label>
    <label for="password">
        <input type="password" name="password" id="password">
        @error('password')
        <div> {{ $message }}</div> @enderror
    </label>
    <label for="confirm-password">
        <input type="password" name="password_confirmation" id="confirm-password">
        @error('password_confirmation')
        <div> {{ $message }}</div> @enderror
    </label>

    @csrf()
    <button type="submit">Registrar</button>
</form>
