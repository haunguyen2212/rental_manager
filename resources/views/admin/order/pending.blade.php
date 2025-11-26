@extends('admin.common.master')

@section('title', 'Đơn hàng chờ xử lí')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Đơn hàng chờ xử lí</span>
            <span class="d-inline d-md-none">Đơn chờ</span>
        </h5>
        <div>
            <button type="button" class="btn btn-sm-md btn-success ms-0 me-md-1" id="btn-search">
                <i class="ti ti-search"></i>
                <span class="d-none d-sm-inline"> Tìm kiếm</span>
            </button>
            <button type="button" class="btn btn-sm-md btn-secondary ms-0 me-md-1" id="btn-export" disabled>
                <i class="ti ti-file-export"></i>
                <span class="d-none d-sm-inline"> Export</span>
            </button>
            <button type="button" class="btn btn-sm-md btn-danger ms-0 me-md-1" id="btn-multi-cancel" disabled>
                <i class="ti ti-x"></i>
                <span class="d-none d-sm-inline"> Hủy nhiều</span>
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-fixed mb-0 align-middle" id="table-order-pending">
            <thead class="text-dark">
                <tr>
                    <th class="w-5">
                        <input type="checkbox" class="form-check-input check-all" value="">
                    </th>
                    <th class="w-10">
                        <span class="fw-semibold mb-0">Mã đơn</span>
                    </th>
                    <th class="w-15">
                        <span class="fw-semibold mb-0">Khách hàng</span>
                    </th>
                    <th class="w-15">
                        <span class="fw-semibold mb-0">Số điện thoại</span>
                    </th>
                    <th class="w-15">
                        <span class="fw-semibold mb-0">Ngày tạo</span>
                    </th>
                    <th class="w-15">
                        <span class="fw-semibold mb-0">Tổng tiền</span>
                    </th>
                    <th class="w-10">
                        <span class="fw-semibold mb-0">Trạng thái</span>
                    </th>
                    <th class="w-15"></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($orders) && $orders->count() > 0)
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <input type="checkbox" name="id[]" class="form-check-input check-item" value="{{ $order->id ?? '' }}">
                            </td>
                            <td>{{ $order->code ?? '' }}</td>
                            <td>{{ $order->customer_name ?? '' }}</td>
                            <td>{{ $order->customer_phone ?? '' }}</td>
                            <td>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '' }}</td>
                            <td>{{ number_format($order->total_amount ?? 0) }} đ</td>
                            <td>
                                <h6 class="mb-0">
                                    <span class="badge bg-warning-subtle text-warning">
                                        Chờ xử lí
                                    </span>
                                </h6>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success btn-approve" data-id="{{ $order->id ?? '' }}">
                                    <i class="ti ti-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-cancel" data-id="{{ $order->id ?? '' }}">
                                    <i class="ti ti-x"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary btn-detail link" data-id="{{ $order->id ?? '' }}">
                                    <i class="ti ti-info-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="8">Không tìm thấy đơn hàng chờ xử lí</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column-reverse flex-lg-row justify-content-center justify-content-lg-between align-items-center mt-4 text-center text-lg-start gap-3">
        <div>
            @if(isset($orders) && $orders->total() > 0)
                <span class="text-muted small d-none d-lg-inline">
                    {{ "Hiển thị {$orders->firstItem()}~{$orders->lastItem()} trong số {$orders->total()} kết quả. " }}
                </span>
            @endif
        </div>
        @if(isset($orders))
            {{ $orders->links() }}
        @endif
    </div>
@endsection
