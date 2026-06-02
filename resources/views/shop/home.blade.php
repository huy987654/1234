@extends('layouts.shop')

@section('title', 'Phone Store - Dien thoai chinh hang')

@section('content')
    <section class="hero-grid">
        <aside class="panel side-menu">
            @forelse($productTypes as $type)
                <a href="#products">{{ $type->product_type_name }}</a>
            @empty
                <a href="#products">Dien thoai</a>
                <a href="#products">Phu kien</a>
                <a href="#products">May cu</a>
            @endforelse
        </aside>

        <div class="panel hero-banner">
            <div>
                <div class="hero-eyebrow">Uu dai moi trong ngay</div>
                <h1 class="hero-title">Dien thoai chinh hang, gia tot cho moi nhu cau</h1>
                <p class="hero-copy">Mua nhanh, xem cau hinh ro rang, them gio hang chi voi mot lan bam.</p>
                <a href="#products" class="btn btn-primary">Xem san pham</a>
            </div>
            <div class="hero-phone"></div>
        </div>

        <div class="promo-stack">
            <div class="promo-box">
                <strong>Tra gop 0%</strong>
                Ho tro mua dien thoai linh hoat, thu tuc nhanh.
            </div>
            <div class="promo-box">
                <strong>Thu cu doi moi</strong>
                Len doi may moi voi muc gia tiet kiem hon.
            </div>
        </div>
    </section>

    <section class="trust-row">
        <div class="trust-item">Hang chinh hang<span>San pham nguon goc ro rang</span></div>
        <div class="trust-item">Bao hanh 12 thang<span>Yen tam trong qua trinh su dung</span></div>
        <div class="trust-item">Giao nhanh<span>Nhan hang nhanh trong khu vuc</span></div>
        <div class="trust-item">Ho tro tan tam<span>Tu van dung nhu cau</span></div>
    </section>

    <section id="products">
        <div class="section-head">
            <div>
                <h2>Danh sach san pham</h2>
                <div style="color: var(--muted); font-weight: 700; margin-top: 5px;">
                    @if(!empty($keyword))
                        Ket qua tim kiem cho "{{ $keyword }}"
                    @else
                        Lua chon dien thoai phu hop voi ban
                    @endif
                </div>
            </div>
            <div class="filter-pills">
                @forelse($brands->take(4) as $brand)
                    <span>{{ $brand->brand_name }}</span>
                @empty
                    <span>iPhone</span>
                    <span>Samsung</span>
                    <span>Xiaomi</span>
                    <span>Oppo</span>
                @endforelse
            </div>
        </div>

        <div class="product-grid">
            @forelse($products as $product)
                <article class="product-card">
                    <a href="{{ route('shop.products.show', $product->id) }}" class="product-thumb" aria-label="Xem {{ $product->product_name }}">
                        @if(!empty($product->image))
                            <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Images/' . $product->image)) }}" alt="{{ $product->product_name }}" style="max-width: 86%; max-height: 132px; object-fit: contain;">
                        @else
                            <div class="phone-art"></div>
                        @endif
                    </a>
                    <a href="{{ route('shop.products.show', $product->id) }}" class="product-name">
                        {{ $product->product_name }}
                    </a>
                    <div class="product-meta">
                        {{ $product->brand_name }} - {{ $product->product_type_name }}
                    </div>
                    @php($displayPrice = $product->min_variant_price ?? $product->price)
                    <div class="price">Tu {{ number_format((float) $displayPrice, 0, ',', '.') }} đ</div>
                    <div class="tag-row">
                        <span class="tag">Tra gop 0%</span>
                        <span class="tag">Ton: {{ $product->stock_quantity }}</span>
                    </div>
                    <div style="margin-top: auto; display: flex; align-items: center; justify-content: space-between; gap: 10px; color: var(--muted); font-weight: 800;">
                        <span>2 Gio</span>
                        <span>Ha Noi</span>
                    </div>
                </article>
            @empty
                <div class="panel empty" style="grid-column: 1 / -1;">
                    Chua co san pham nao de hien thi.
                </div>
            @endforelse
        </div>
    </section>
@endsection
