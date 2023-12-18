@foreach ($posts as $post)
    <x-blog.title-card :post="$post" :link="true" :show-breadcrumb="false" />
@endforeach
