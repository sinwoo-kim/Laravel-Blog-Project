<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <base href="/public">
    @include('home.homecss')

    <link rel="stylesheet" href="{{ asset('css/post-form.css') }}">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        <!-- banner section start -->

        <!-- banner section end -->
    </div>

    <div class="post-form-container">
        <div class="post-form-header">
            <h2>Create New Post</h2>
            <p class="text-muted">Share your thoughts with the community</p>
        </div>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
            class="post-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="post-title">Post Title</label>
                <input type="text" id="post-title" name="title" class="form-control" value="{{ $post->title }}"
                    required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-description">Post Content</label>
                <textarea id="post-description" name="description" class="form-control" rows="6" required>{{ $post->description }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-image">Featured Image</label>
                <div class="custom-file-upload">
                    <input type="file" id="post-image" name="image" class="file-input" accept="image/*">
                    <label for="post-image" class="file-label">
                        <i class="fa fa-cloud-upload"></i> Choose Image
                    </label>
                    <span class="file-name">{{ $post->image ? $post->image : 'No file chosen' }}</span>
                </div>
                <div class="image-preview" id="imagePreview"
                    style="{{ $post->image ? 'background-image: url(\'/postimage/' . $post->image . '\');' : '' }}">
                </div>
                <!-- 기존 이미지 경로 (hidden input) -->
                <input type="hidden" name="current_image" value="{{ $post->image }}">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary">Publish Post</button>
            </div>
        </form>
    </div>

    <!-- footer section start -->
    @include('home.footer')
    <script src="{{ asset('js/post-form.js') }}"></script>
    @include('sweetalert::alert')
</body>


</html>
