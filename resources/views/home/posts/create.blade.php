<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <base href="/public">
    @include('home.homecss')

    <style type="text/css">
        .post_title {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            padding: 30px;
            color: white;
        }

        .div_center {
            padding: 25px;
        }

        label {
            display: inline-block;
            width: 200px;
            font-size: 18px;
            font-weight: bold;
        }

        .title_deg {
            font-size: 30px;
            font-weight: bold;
            padding: 30px;
        }

        .div_deg {
            text-align: center;
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

    <div class="div_deg">
        <h3 class="title_deg">Add Post</h3>
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="div_center">
                <label>Post Title</label>
                <input type="text" name="title">
            </div>
            <div class="div_center">
                <label>Post Description</label>
                <textarea name="description"></textarea>
            </div>
            <div class="div_center">
                <label>Add Image</label>
                <input type="file" name="image">
            </div>
            <div class="div_center">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>

    <!-- footer section start -->
    @include('home.footer')
</body>

</html>
