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
                            <li class="breadcrumb-item">الصفحات</li>
                        </ol>
                    </div>
                    <h4 class="page-title">عرض الصفحات</h4>
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
                                        <a href="{{ route('pages.create') }}" class="btn btn-success">أضف جديد</a>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>العنوان</th>
                                        <th>الحالة</th>
                                        <th>أنشئ في</th>
                                        <th>التحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pages as $page)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                
                                            <td>{{ $page->name }}</td>

                                            <td>
                                                <input type="checkbox" id="{{ $page->id }}"
                                                    data-id="{{ $page->id }}" class="toggle-class"
                                                    data-switch="success" data-onstyle="success" data-offstyle="danger"
                                                    data-toggle="toggle" data-on="Active" data-off="InActive"
                                                    {{ $page->is_active ? 'checked' : '' }} />
                                                <label for="{{ $page->id }}" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                            </td>
                                            <td>{{ $page->created_at->format('d-m-Y') }}</td>
                                            <td class="table-action" data-id="{{ $page->id }}">
                                                <span class="dtr-data">
                                                    <a href="{{ route('pages.edit', $page->id) }}" class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="javascript:void(0);" class="action-icon" id="deleteRow"
                                                        data-id="{{ $page->id }}"> <i class="mdi mdi-delete"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {!! $pages->links() !!}
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
                    axios.delete('/dashboard/pages/' + id)
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
                var page_id = $(this).data('id');
                // alert(page_id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('pages.active') }}",
                    data: {
                        'active': active,
                        'page_id': page_id
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
