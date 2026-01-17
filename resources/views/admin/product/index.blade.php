@extends('admin.common.master')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title fw-semibold mb-0">
            <span class="d-none d-md-inline">Danh sách sản phẩm</span>
            <span class="d-inline d-md-none">Sản phẩm</span>
        </h5>
        <div>
            <button type="button" class="btn btn-sm-md btn-success ms-0 me-md-1" id="btn-search"><i class="ti ti-search"></i><span class="d-none d-sm-inline"> Tìm kiếm</span></button>
            <button type="button" class="btn btn-sm-md btn-danger ms-0 me-md-1" id="btn-multi-delete" data-url="{{ route('admin.product.destroy') }}" {{ $products->count() > 0 ? '' : 'disabled' }}><i class="ti ti-trash"></i><span class="d-none d-sm-inline"> Xóa</span></button>
            <button type="button" class="btn btn-sm-md btn-primary link" id="btn-create" data-url="{{ route('admin.product.create') }}"><i class="ti ti-plus"></i><span class="d-none d-sm-inline"> Thêm mới</span></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-fixed mb-0 align-middle" id="table-product">
            <thead class="text-dark">
                <tr>
                    <th class="w-5">
                        <input type="checkbox" class="form-check-input check-all" value="">
                    </th>
                    <th class="w-20 sortable" data-sort="name">
                        <span class="fw-semibold mb-0">Tên sản phẩm</span>
                    </th>
                    <th class="w-10">
                        <span class="fw-semibold mb-0">Hình ảnh</span>
                    </th>
                    <th class="w-10">
                        <span class="fw-semibold mb-0">Giá bán</span>
                    </th>
                    <th class="w-10">
                        <span class="fw-semibold mb-0">Số lượng</span>
                    </th>
                    <th class="w-10 sortable" data-sort="status">
                        <span class="fw-semibold mb-0">Trạng thái</span>
                    </th>
                    <th class="w-10 sortable" data-sort="created_at">
                        <span class="fw-semibold mb-0">Ngày tạo</span>
                    </th>
                    <th class="w-15"></th>
                </tr>
            </thead>
            <tbody>
                @if($products->count() > 0)
                    @foreach ($products as $product)
                        @php
                            $variants = $product->variants;
                            $stockQuantity = $variants->sum('stock_quantity');
                            
                            // Calculate price display
                            $isVariantProduct = $product->type == VARIANT_PRODUCT;
                            $variantCount = $variants->count();
                            
                            if ($isVariantProduct && $variantCount >= 2) {
                                // For variant products with 2+ variants, show min ~ max price
                                $salePrices = [];
                                $originalPrices = [];
                                $hasSalePrice = false;
                                
                                foreach ($variants as $variant) {
                                    $originalPrice = $variant->price ?? 0;
                                    $salePrice = $variant->sale_price ?? null;
                                    
                                    if ($originalPrice > 0) {
                                        $originalPrices[] = $originalPrice;
                                        
                                        // Use sale_price if exists and > 0, otherwise use original price
                                        if ($salePrice && $salePrice > 0) {
                                            $salePrices[] = $salePrice;
                                            $hasSalePrice = true;
                                        } else {
                                            $salePrices[] = $originalPrice;
                                        }
                                    }
                                }
                                
                                if (!empty($salePrices) && !empty($originalPrices)) {
                                    $minSalePrice = min($salePrices);
                                    $maxSalePrice = max($salePrices);
                                    $minOriginalPrice = min($originalPrices);
                                    $maxOriginalPrice = max($originalPrices);
                                    
                                    // Format sale price range
                                    if ($minSalePrice == $maxSalePrice) {
                                        $salePriceText = number_format($minSalePrice, 0, ',', '.') . ' đ';
                                    } else {
                                        $salePriceText = number_format($minSalePrice, 0, ',', '.') . ' ~ ' . number_format($maxSalePrice, 0, ',', '.') . ' đ';
                                    }
                                    
                                    if ($hasSalePrice) {
                                        // Format original price range
                                        if ($minOriginalPrice == $maxOriginalPrice) {
                                            $originalPriceText = number_format($minOriginalPrice, 0, ',', '.') . ' đ';
                                        } else {
                                            $originalPriceText = number_format($minOriginalPrice, 0, ',', '.') . ' ~ ' . number_format($maxOriginalPrice, 0, ',', '.') . ' đ';
                                        }
                                        
                                        // Show sale price on top, original price strikethrough below
                                        $displayPrice = '<div><span class="text-danger fw-semibold">' . $salePriceText . '</span><br><span class="text-muted text-decoration-line-through small">' . $originalPriceText . '</span></div>';
                                        $priceClass = '';
                                    } else {
                                        // No sale price, just show price range
                                        $displayPrice = '<span class="fw-semibold">' . $salePriceText . '</span>';
                                        $priceClass = '';
                                    }
                                } else {
                                    $displayPrice = '-';
                                    $priceClass = 'text-muted';
                                }
                            } else {
                                // For single product or variant product with 1 variant
                                $firstVariant = $variants->first();
                                $price = $firstVariant->price ?? 0;
                                $salePrice = $firstVariant->sale_price ?? null;
                                
                                if ($salePrice && $salePrice > 0) {
                                    $displayPrice = '<div><span class="text-danger fw-semibold">' . number_format($salePrice, 0, ',', '.') . ' đ</span><br><span class="text-muted text-decoration-line-through small">' . number_format($price, 0, ',', '.') . ' đ</span></div>';
                                    $priceClass = '';
                                } elseif ($price > 0) {
                                    $displayPrice = number_format($price, 0, ',', '.') . ' đ';
                                    $priceClass = 'fw-semibold';
                                } else {
                                    $displayPrice = '-';
                                    $priceClass = 'text-muted';
                                }
                            }
                        @endphp
                        <tr>
                            <td><input type="checkbox" name="id[]" class="form-check-input check-item" value="{{ $product->id ?? '' }}"></td>
                            <td>{{ $product->name ?? '' }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded view-image product-thumbnail" data-image-url="{{ asset('storage/' . $product->image) }}" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer; transition: all 0.3s ease; border: 2px solid #e0e0e0;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="ti ti-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if(!empty($priceClass) && $priceClass != '')
                                    <span class="{{ $priceClass }}">{!! $displayPrice !!}</span>
                                @else
                                    {!! $displayPrice !!}
                                @endif
                            </td>
                            <td>{{ number_format($stockQuantity, 0, ',', '.') }}</td>
                            <td>
                                <h6 class="mb-0">
                                    <span class="badge {{ PRODUCT_STATUS_BADGE[$product->status] ?? '' }}">
                                        {{ PRODUCT_STATUS[$product->status] ?? '' }}
                                    </span>
                                </h6>
                            </td>
                            <td>{{ $product->created_at ? $product->created_at->format('d/m/Y') : '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $product->id ?? '' }}" data-url="{{ route('admin.product.destroy') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning btn-edit link" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Chỉnh sửa"
                                    data-url="{{ route('admin.product.edit', $product->id) }}"
                                >
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary btn-copy" data-id="{{ $product->id ?? '' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sao chép">
                                    <i class="ti ti-copy"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td class="text-center" colspan="8">Không tìm thấy dữ liệu</td>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex flex-column-reverse flex-lg-row justify-content-center justify-content-lg-between align-items-center mt-4 text-center text-lg-start gap-3">
        <div>
            @if($products->total() > 0)
                <span class="text-muted small d-none d-lg-inline">
                    {{ "Hiển thị {$products->firstItem()}~{$products->lastItem()} trong số {$products->total()} kết quả. " }}
                </span>
            @endif
            @if(!empty(request()->all()))
                <span class="text-muted small">
                    <a href="{{ route('admin.product.index') }}">Đặt lại tìm kiếm</a>
                </span>
            @endif
        </div>
        {{ $products->links() }}
    </div>
    @include('admin.product.modal.search_modal')
    
    <div class="modal fade" id="modal-view-image" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true" data-bs-backdrop="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-header border-0 position-absolute top-0 end-0 z-3 bg-transparent">
                    <button type="button" class="btn-close btn-close-white bg-white bg-opacity-75 rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;"></button>
                </div>
                <div class="modal-body p-0 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.6);">
                    <div class="image-container-wrapper">
                        <img src="" alt="Preview" id="modal-image-preview" class="modal-image-preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const PRODUCT_URL = '{{ route('admin.product.index') }}';
    </script>
    <script src="{{ asset('js/admin/product/index.js') }}?v={{ VERSION }}"></script>
@endpush

