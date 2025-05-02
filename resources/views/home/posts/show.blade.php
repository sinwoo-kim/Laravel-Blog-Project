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

        <div class="div_center">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                onsubmit="return confirm('Are you sure to Delete This?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>





    </div>








    <!-- footer section start -->
    @include('home.footer')
    @include('sweetalert::alert')
</body>

</html>
