<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <base href="/public">
    @include('home.homecss')

    <style>
        .header_section {
            position: relative;
            z-index: 100;
            /* 헤더가 다른 요소 위에 오도록 z-index 설정 */
            width: 100%;
        }

        .post-form-container {
            position: relative;
            z-index: 10;
            max-width: 800px;
            width: 100%;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            clear: both;
        }

        .post-form-header {
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            border-bottom: 1px solid #eee;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .post-form-header h2 {
            color: #333;
            font-weight: 600;
            margin: 0 0 10px 0;
            display: block;
            width: 100%;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .custom-file-upload {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .file-input {
            display: none;
        }

        .file-label {
            padding: 10px 15px;
            background-color: #f0f0f0;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
            border: 1px solid #ddd;
        }

        .file-label:hover {
            background-color: #e5e5e5;
        }

        .file-name {
            margin-left: 15px;
            color: #666;
        }

        .image-preview {
            max-width: 100%;
            height: 200px;
            margin-top: 15px;
            border: 2px dashed #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #4a90e2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a7bc8;
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #e5e5e5;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .post-form-container {
                padding: 20px;
                margin: 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
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

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
            @csrf

            <div class="form-group">
                <label for="post-title">Post Title</label>
                <input type="text" id="post-title" name="title" class="form-control" placeholder="Enter post title"
                    required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-description">Post Content</label>
                <textarea id="post-description" name="description" class="form-control" rows="6"
                    placeholder="Write your post content here..." required></textarea>
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
                    <span class="file-name">No file chosen</span>
                </div>
                <div class="image-preview" id="imagePreview"></div>
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
    @include('sweetalert::alert')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('post-image');
            const fileName = document.querySelector('.file-name');
            const imagePreview = document.getElementById('imagePreview');

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.style.backgroundImage = `url(${e.target.result})`;
                        imagePreview.textContent = '';
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    fileName.textContent = 'No file chosen';
                    imagePreview.style.backgroundImage = 'none';
                    imagePreview.textContent = 'Image preview will appear here';
                }
            });

            // 초기 상태 설정
            imagePreview.textContent = 'Image preview will appear here';
        });
    </script>

</body>


</html>
