@extends('backend.layouts.master')
@section('stylesheet')
    <style>
        .link a {
            float: left;
            margin-right: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">الرئيسية<i
                                        class="dripicons-chevron-left"></i></a></li>
                            <li class="breadcrumb-item">المقالات</li>
                        </ol>
                    </div>
                    <h4 class="page-title">عرض المقالات</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <table class="table table-hover  table-centered mb-0">
                                <div class="row">
                                    <div class="col-md-5">
                                        <form action="" method="get">
                                            <div class="input-group mb-3">
                                                <input type="search" name="search" id="search" class="form-control"
                                                    placeholder="ابحث هنا ..." value="{{ request('search') }}" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-7 link">
                                        <a href="{{ route('posts.create') }}" class="btn btn-success">أضف جديد</a>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>العنوان</th>
                                        <th>القسم</th>
                                        <th>الكاتب</th>
                                        @can('delete-post')
                                            <th>الحالة</th>
                                        @endcan
                                        <th>أنشئ في</th>
                                        <th>التحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="table-user">
                                                @if ($post->photo)
                                                    <img src="{{  $post->photo }}"
                                                        alt="user-avatar" class="me-2 rounded-circle">
                                                @else
                                                    <img src="{{ asset('images/uploads/posts/post.png') }}"
                                                        alt="user-avatar" class="me-2 rounded-circle"
                                                        style=" width: auto; ">
                                                @endif
                                            </td>
                                            <td>{{ $post->name }}</td>

                                            <td>{{ $post->category->name_ar }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            @can('delete-post')

                                            <td>
                                                <input type="checkbox" id="{{ $post->id }}"
                                                    data-id="{{ $post->id }}" class="toggle-class"
                                                    data-switch="success" data-onstyle="success" data-offstyle="danger"
                                                    data-toggle="toggle" data-on="Active" data-off="InActive"
                                                    {{ $post->is_active ? 'checked' : '' }} />
                                                <label for="{{ $post->id }}" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                            </td>
                                            @endcan
                                            <td>{{ $post->created_at->format('d-m-Y') }}</td>

                                            <td class="table-action" data-id="{{ $post->id }}">
                                                <span class="dtr-data">
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="javascript:void(0);" class="action-icon" id="deleteRow"
                                                        data-id="{{ $post->id }}"> <i class="mdi mdi-delete"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {!! $posts->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('body').on('click', '#deleteRow', function(e) {
            e.preventDefault();
            let id = $(this).data('id')
            Swal.fire({
                title: 'هل أنت واثق؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، احذفها!',
                cancelButtonText: 'إلغاء',

            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('tr').remove();
                    axios.delete('/dashboard/posts/' + id)
                        .then(function(response) {
                            // console.log(response);
                            showMessage(response.data);
                        }).catch(function(error) {
                            // console.log(error);
                            showMessage(error.response.data);
                        })
                }
            });

            function showMessage(data) {
                Swal.fire({
                    position: 'top-end',
                    icon: data.icon,
                    title: data.title,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });

        // ====================================================================
        $(function() {
            $('.toggle-class').change(function() {
                var active = $(this).prop('checked') == true ? 1 : 0;
                var post_id = $(this).data('id');
                // alert(post_id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('posts.active') }}",
                    data: {
                        'active': active,
                        'post_id': post_id
                    },
                    success: function(data) {
                        // console.log(data.success)
                    }
                });
            })
        });
        // ====================================================================
    </script>
@endsection
