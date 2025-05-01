<!DOCTYPE html>
<html lang="en">

<head>

    @include('home.homecss')
    <style>
        .img_deg {
            height: 200px;
            width: 300px;
            padding: 30px;
            margin: auto;
        }

        .post_deg {
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
    <!-- header section end -->
    @foreach ($posts as $post)
        <div class="post_deg">
            <img class="img_deg" src ="/postimage/{{ $post->image }}">
            <h4 class="title_deg">{{ $post->title }}</h4>
            <p>{{ $post->description }}</p>
        </div>
    @endforeach

    <!-- footer section start -->
    @include('home.footer')
</body>

</html>
