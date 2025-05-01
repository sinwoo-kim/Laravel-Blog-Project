<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <base href="/public">
    @include('home.homecss')
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')

    </div>
    <!-- header section end -->
    <div style="max-width: 600px; margin: 0 auto; text-align: center;">
        <img src="/postimage/{{ $post->image }}"
            style="display: block; max-width: 100%; height: auto; margin: 0 auto; padding: 20px;" />

        <h4><b>{{ $post->title }}</b></h4>
        <h4>{{ $post->description }}</h4>
        <p>Post by <b>{{ $post->name }}</b></p>
    </div>








    <!-- footer section start -->
    @include('home.footer')
</body>

</html>
