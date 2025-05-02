<div class="services_section layout_padding bg-slate-100">
    <div class="container">
        <h1 class="services_taital">Blog Posts </h1>
        <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have
            suffered alteration</p>
        <div class="services_section_2">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}"
                        class="group bg-gray-100 dark:bg-slate-800 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col h-full no-underline">
                        <div class="relative w-full aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('postimage/' . $post->image) }}"
                                class="w-full h-full object-cover rounded-t-xl transition-transform duration-500 group-hover:scale-105 p-3"
                                alt="{{ $post->title }}">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h4
                                class="text-xl font-bold mb-2 truncate text-gray-800 dark:text-white group-hover:text-indigo-600 transition-colors">
                                {{ $post->title }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Post by <span
                                    class="font-medium text-gray-700 dark:text-gray-300">{{ $post->name }}</span>
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
