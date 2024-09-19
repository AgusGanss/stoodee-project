@extends('layouts.template')
@section('content')

<style>
/* Styles for the form and status switch */
.container-fluid {
    background-color: #f5f5f5;
    padding: 20px 10px;
}

/* Styles for the status switch */
.status-switch {
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.status-switch input[type="checkbox"] {
    display: none;
}

.switch-label {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 34px;
    background-color: #ccc;
    border-radius: 34px;
    transition: background-color 0.3s;
    cursor: pointer;
}

.switch-inner {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 34px;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5px;
    box-sizing: border-box;
}

.switch-active,
.switch-inactive {
    color: white;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.switch-active {
    padding-left: 5px;
    display: none;
}

.switch-inactive {
    margin-left: 30px;
}

.switch-handle {
    position: absolute;
    top: 2px;
    left: 2px;
    width: 30px;
    height: 30px;
    background-color: white;
    border-radius: 50%;
    transition: all 0.3s;
}

.status-switch input[type="checkbox"]:checked + .switch-label {
    background-color: #4CAF50;
}

.status-switch input[type="checkbox"]:checked + .switch-label .switch-inner .switch-active {
    display: block;
}

.status-switch input[type="checkbox"]:checked + .switch-label .switch-inner .switch-inactive {
    display: none;
}

.status-switch input[type="checkbox"]:checked + .switch-label .switch-handle {
    left: calc(100% - 32px);
}

.status-label {
    margin-left: 10px;
    font-weight: bold;
    color: #333;
}
</style>

<div class="container-fluid">
    <div class="form-container">
        <form class="elegant-form" action="{{ route('iklan.dalam.update', $iklan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Jika Anda menggunakan metode PUT untuk update -->

            <h2>Edit Iklan Depan</h2>

            <!-- Form Input untuk Foto Iklan -->
            <div class="form-group image-input-group">
                <label for="foto">Image Iklan</label>
                <input type="file" id="foto" name="foto" accept="image/*">
                <div class="image-preview" id="imagePreview">
                    @if ($iklan->foto)
                        <img src="{{ asset('foto/' . $iklan->foto) }}" alt="Image Preview" id="previewImage">
                    @else
                        <img src="#" alt="Image Preview" id="previewImage" style="display: none;">
                    @endif
                </div>
                <small>IMAGE: 600x360</small>
            </div>

            <!-- Form Input untuk Video Iklan -->
            <div class="form-group image-input-group">
                <label for="video">Video Iklan</label>
                <input type="file" id="video" name="video" accept="video/*" onchange="previewVideo(event)">
                <div class="video-preview">
                    <video id="videoPreview" width="400" controls style="display: none;">
                        Your browser does not support the video tag.
                    </video>
                </div>
                @if ($iklan->video)
                    <div class="existing-video">
                        <label>Video Saat Ini:</label>
                        <video width="400" controls>
                            <source src="{{ asset('video/' . $iklan->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
            </div>

            <!-- Input untuk Program -->
            <div class="form-group">
                <label for="program_id">Program</label>
                <select id="program_id" class="form-control @error('program_id') is-invalid @enderror" name="program_id">
                    <option value="">Pilih Program...</option>
                    @foreach ($program as $programs)
                        <option value="{{ $programs->id }}" {{ old('program_id', $iklan->program_id) == $programs->id ? 'selected' : '' }}>
                            {{ $programs->judul_program }}
                        </option>
                    @endforeach
                </select>
                @error('program_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Link Iklan -->
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $iklan->link) }}">
                @error('link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link2">Link2</label>
                <input type="text" name="link2" class="form-control @error('link2') is-invalid @enderror" value="{{ old('link2', $iklan->link2) }}">
                @error('link2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Status Switch -->
            <div class="status-switch">
                <input type="checkbox" id="statusSwitch" name="status" {{ old('status', $iklan->status) == 'active' ? 'checked' : '' }}>
                <label for="statusSwitch" class="switch-label">
                    <span class="switch-inner">
                        <span class="switch-active">Active</span>
                        <span class="switch-inactive">Inactive</span>
                    </span>
                    <span class="switch-handle"></span>
                </label>
                <span class="status-label">Status</span>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    function previewVideo(event) {
        const file = event.target.files[0];
        const videoPreview = document.getElementById('videoPreview');

        if (file) {
            const fileURL = URL.createObjectURL(file);
            videoPreview.src = fileURL;
            videoPreview.style.display = 'block'; // Show the video element
        } else {
            videoPreview.src = '';
            videoPreview.style.display = 'none'; // Hide the video element if no file
        }
    }

    // JavaScript for Image Preview
    document.getElementById('foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const imagePreview = document.getElementById('previewImage');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
        }
    });
</script>

@endsection
