<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    @include('clients.layout.partials.css')
</head>

<body>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">

            @include('clients.layout.partials.header_top')

            @include('clients.layout.partials.header_nav')

        </header>

        @yield('content')

        <footer class="site-footer border-top">
            @include('clients.layout/partials/footer')
        </footer>
    </div>
    @include('clients.layout/partials/js')

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const productId = {{ $products->id }};
        const commentsList = $('#comments-list');

        // Hàm thêm bình luận vào giao diện
        function appendComment(comment) {
            const commentHtml = `
                <div class="comment mb-3">
                    <strong>${comment.user.name}</strong>
                    <p>${comment.content}</p>
                    <small>${new Date(comment.created_at).toLocaleString()}</small>
                </div>
            `;
            commentsList.append(commentHtml); // Thêm bình luận vào cuối danh sách
        }

        // Gửi bình luận qua AJAX
        $('#comment-form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('comments.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (comment) {
                    appendComment(comment); // Thêm bình luận mới vào giao diện
                    $('#comment-form textarea').val(''); // Xóa nội dung trong textarea
                },
                error: function () {
                    alert('Không thể gửi bình luận. Vui lòng thử lại.');
                }
            });
        });

        // Tải danh sách bình luận khi trang được tải
        function loadComments() {
            $.get(`/comments/${productId}`, function (comments) {
                comments.forEach(comment => appendComment(comment));
            });
        }

        loadComments(); // Gọi hàm tải bình luận
    });
</script>

</html>
