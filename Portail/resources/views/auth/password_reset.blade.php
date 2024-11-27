<form method="POST" action="/password/reset">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div>
        <label for="password">New Password</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Reset Password</button>
</form>
