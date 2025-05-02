<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.css')

    <style type="text/css">
        .title_deg {
            font-size: 30px;
            font-weight: bold;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .table_deg {
            border: 1px solid white;
            width: 80%;
            text-align: center;
            margin-left: 70px;
        }

        .th_deg {
            background-color: skyblue;
        }

        .img_deg {
            height: 100px;
            width: 150px;
            padding: 10px;
        }
    </style>
</head>

<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->

        <div class="page-content">

            @if (session()->has('message'))
                <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 class="title_deg">All Post</h1>

            <table class="table_deg">
                <tr class="th_deg">
                    <th>Post title</th>
                    <th>Description</th>
                    <th>Post by</th>
                    <th>Post Status</th>
                    <th>UserType</th>
                    <th>Image</th>
                    <th>Delete</th>
                    <th>Edit</th>
                    <th>Status</th>

                </tr>
                @foreach ($post as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->post_status }}</td>
                        <td>{{ $post->usertype }}</td>
                        <td><img class="img_deg" src="postimage/{{ $post->image }}"></td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure to Delete This?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
                        </td>
                        <td id="status-cell-{{ $post->id }}">
                            @if ($post->post_status === 'pending')
                                <form id="accept-form-{{ $post->id }}"
                                    action="{{ route('admin.posts.status.update', $post->id) }}" method="POST"
                                    onsubmit="return handleStatusUpdate(event, {{ $post->id }}, 'active')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="post_status" value="active">
                                    <button type="submit" class="btn btn-outline-secondary">Accept</button>
                                </form>
                            @elseif($post->post_status === 'active')
                                <form id="reject-form-{{ $post->id }}"
                                    action="{{ route('admin.posts.status.update', $post->id) }}" method="POST"
                                    onsubmit="return handleStatusUpdate(event, {{ $post->id }}, 'reject')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="post_status" value="reject">
                                    <button type="submit" class="btn btn-outline-danger">Reject</button>
                                </form>
                            @elseif($post->post_status === 'reject')
                                <form id="accept-form-{{ $post->id }}"
                                    action="{{ route('admin.posts.status.update', $post->id) }}" method="POST"
                                    onsubmit="return handleStatusUpdate(event, {{ $post->id }}, 'active')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="post_status" value="active">
                                    <button type="submit" class="btn btn-outline-secondary">Accept</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>

        @include('admin.footer')
    </div>
    <script src="{{ asset('js/handleStatusUpdate.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
