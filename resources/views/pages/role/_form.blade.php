<div class="mb-3">
    <label class="form-label" for="nama"> Nama </label>
    <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ old('nama', $role?->name ?? '') }}">
    @error('nama') 
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>