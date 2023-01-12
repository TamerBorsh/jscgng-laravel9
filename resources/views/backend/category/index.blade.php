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
                            <li class="breadcrumb-item">الأقسام</li>
                        </ol>
                    </div>
                    <h4 class="page-title">عرض الأقسام</h4>
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
                                        <a href="{{ route('categories.create') }}" class="btn btn-success">أضف جديد</a>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الحالة</th>
                                        <th>أنشئ في</th>
                                        <th>التحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $category->name }}</td>
                                            <td><span
                                                    @if ($category->State == 'نشط') class="badge bg-success" @else class="badge bg-danger" @endif>{{ $category->State }}</span>
                                            </td>
                                            <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                            <td class="table-action" data-id="{{ $category->id }}">
                                                <span class="dtr-data">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    <a href="javascript:void(0);" class="action-icon" id="deleteRow"
                                                        data-id="{{ $category->id }}"> <i class="mdi mdi-delete"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body -->
                    {!! $categories->links() !!}
                </div> <!-- end card-->
            </div> <!-- end col-->
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
                    axios.delete('/dashboard/categories/' + id)
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
    </script>
@endsection
