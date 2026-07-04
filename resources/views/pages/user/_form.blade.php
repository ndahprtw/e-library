<div class="mb-3">
    <label class="form-label" for="nama"> Nama </label>
    <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ old('nama', $user?->name ?? '') }}">
    @error('nama') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="email"> Email </label>
    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', $user?->email ?? '') }}">
    @error('email') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="role">Role</label>
    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
        <option value="" selected disabled>Pilih Role</option>

        @foreach ($roles as $role)
            <option value="{{ $role->name }}"
                {{ old('role', $user?->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="password"> Password </label>
    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
    <i>Kosongkan jika tidak ingin mengubah password</i>
    @error('password') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>