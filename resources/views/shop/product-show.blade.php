@extends('layouts.shop')

@section('title', ($product->product_name ?? 'San pham') . ' - Phone Store')

@section('content')
    @php($firstVariant = $variants->first())

    <div style="display: flex; gap: 10px; align-items: center; color: var(--muted); font-weight: 800; margin: 6px 0 18px; flex-wrap: wrap;">
        <a href="{{ route('shop.home') }}">Trang chu</a>
        <span>/</span>
        <span>{{ $product->brand_name ?? 'Thuong hieu' }}</span>
        <span>/</span>
        <span>{{ $product->product_name ?? 'San pham' }}</span>
    </div>

    <div style="display: grid; grid-template-columns: minmax(320px, .95fr) minmax(360px, 1fr); gap: 22px; align-items: start;">
        <section>
            <h1 style="margin: 0 0 10px; font-size: 28px; line-height: 1.25;">{{ $product->product_name ?? 'San pham' }}</h1>

            <div style="display: flex; align-items: center; gap: 16px; color: var(--muted); font-weight: 800; margin-bottom: 18px; flex-wrap: wrap;">
                <span style="color: #f59e0b;">★ <strong style="color: var(--text);">4.9</strong></span>
                <span>Yeu thich</span>
                <span>Hoi dap</span>
                <span>Thong so</span>
                <span>So sanh</span>
            </div>

            <div class="panel" style="padding: 24px; min-height: 400px; background: linear-gradient(135deg, #dd5b8b 0%, #f6b185 100%); color: #fff;">
                <div style="display: grid; grid-template-columns: 240px 1fr; gap: 24px; align-items: center;">
                    <div style="background: #fff; border-radius: 12px; min-height: 250px; display: flex; align-items: center; justify-content: center;">
                        @if(!empty($product->image))
                            <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('Images/' . $product->image)) }}" alt="{{ $product->product_name }}" style="max-width: 82%; max-height: 230px; object-fit: contain;">
                        @else
                            <div class="phone-art" style="width: 120px; height: 190px;"></div>
                        @endif
                    </div>
                    <div>
                        <h2 style="margin: 0 0 14px; font-size: 24px;">TINH NANG NOI BAT</h2>
                        <ul style="margin: 0; padding-left: 20px; font-size: 17px; line-height: 1.55; font-weight: 700;">
                            <li>Hieu nang on dinh, phu hop nhu cau hoc tap, lam viec va giai tri.</li>
                            <li>Man hinh hien thi sac net, mau sac ro rang.</li>
                            <li>Camera, pin va kha nang ket noi phu hop su dung hang ngay.</li>
                            <li>Nhieu lua chon mau sac va dung luong theo tung bien the.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section>
            @if($firstVariant)
                <div class="panel" style="padding: 18px; border-color: #9cc0ff; background: #f8fbff; margin-bottom: 20px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; align-items: center; text-align: center;">
                        <div>
                            <div id="variant-price" style="font-size: 28px; font-weight: 900;">
                                {{ number_format((float) $firstVariant->pv_price, 0, ',', '.') }}đ
                            </div>
                            <div style="color: var(--muted); text-decoration: line-through; font-weight: 800;">
                                {{ number_format((float) (($firstVariant->pv_price ?? 0) + 2000000), 0, ',', '.') }}đ
                            </div>
                        </div>
                        <div style="border-left: 1px solid #c7d9ff;">
                            <div style="color: #2f7cff; font-weight: 900;">Thu cu len doi chi tu</div>
                            <div id="trade-price" style="font-size: 24px; font-weight: 900;">
                                {{ number_format(max((float) $firstVariant->pv_price - 3000000, 0), 0, ',', '.') }}đ
                            </div>
                            <div style="color: var(--danger); font-weight: 800;">Dinh gia ngay</div>
                        </div>
                    </div>
                    <div style="border-top: 1px dashed #c7d9ff; margin-top: 14px; padding-top: 12px; text-align: center; font-weight: 800;">
                        Tiet kiem them cho khach hang thanh vien
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <h2 style="font-size: 22px; margin: 0 0 12px;">Phien ban</h2>
                    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px;">
                        @foreach($variants->unique('storage') as $variant)
                            <button type="button" class="select-card storage-option" data-storage="{{ $variant->storage }}">
                                <span>{{ $variant->storage }}</span>
                                <span class="selected-mark">✓</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <h2 style="font-size: 22px; margin: 0 0 12px;">Mau sac</h2>
                    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px;">
                        @foreach($variants as $variant)
                            <button type="button" class="select-card color-option" data-storage="{{ $variant->storage }}" data-color="{{ $variant->pv_color }}">
                                <span style="display: flex; align-items: center; gap: 10px;">
                                    <span class="mini-phone"></span>
                                    <span>
                                        <strong style="display: block;">{{ $variant->pv_color }}</strong>
                                        <span>{{ number_format((float) $variant->pv_price, 0, ',', '.') }}đ</span>
                                    </span>
                                </span>
                                <span class="selected-mark">✓</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="panel" style="padding: 16px; border-color: #9cc0ff; margin-bottom: 16px;">
                    <h2 style="font-size: 20px; margin: 0 0 12px;">Khuyen mai di kem</h2>
                    <div style="display: grid; gap: 8px; color: var(--text); font-weight: 700;">
                        <div>Tra gop 0%, ho tro thanh toan linh hoat.</div>
                        <div id="variant-stock">Ton kho: {{ $firstVariant->pv_stock_qtt }}</div>
                        <div id="variant-desc">{{ $firstVariant->desc }}</div>
                    </div>
                </div>

                <a id="add-to-cart-btn" href="{{ route('carts.addToCart', $firstVariant->id) }}" class="btn btn-primary" style="width: 100%; min-height: 48px; font-size: 17px;">
                    Them vao gio hang
                </a>
            @else
                <div class="panel empty">San pham nay chua co bien the de mua.</div>
            @endif
        </section>
    </div>

    @if($firstVariant)
        <div class="panel" style="padding: 18px; margin-top: 22px;">
            <div class="section-head" style="margin-top: 0;">
                <div>
                    <h2 style="font-size: 22px;">Thong so ky thuat</h2>
                    <div style="color: var(--muted); font-weight: 700;">Tu dong thay doi theo phien ban va mau dang chon.</div>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="cart-table">
                    <tbody>
                    <tr><th>CPU</th><td id="cfg-cpu">{{ $firstVariant->cpu }}</td><th>RAM</th><td id="cfg-ram">{{ $firstVariant->ram }}</td></tr>
                    <tr><th>Bo nho</th><td id="cfg-storage">{{ $firstVariant->storage }}</td><th>GPU</th><td id="cfg-gpu">{{ $firstVariant->gpu }}</td></tr>
                    <tr><th>Man hinh</th><td id="cfg-screen">{{ $firstVariant->screen }}</td><th>He dieu hanh</th><td id="cfg-os">{{ $firstVariant->os }}</td></tr>
                    <tr><th>Pin</th><td id="cfg-battery">{{ $firstVariant->battery }}</td><th>Camera</th><td id="cfg-camera">{{ $firstVariant->camera }}</td></tr>
                    <tr><th>Ket noi</th><td id="cfg-connect">{{ $firstVariant->connect }}</td><th>Tinh nang khac</th><td id="cfg-other">{{ $firstVariant->other_function }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <style>
            .select-card {
                position: relative;
                min-height: 62px;
                border: 1px solid var(--line);
                border-radius: 10px;
                background: #fff;
                padding: 12px;
                cursor: pointer;
                font-weight: 800;
                text-align: center;
            }
            .select-card.active {
                border-color: #e60012;
                box-shadow: 0 0 0 1px #e60012 inset;
            }
            .select-card.disabled {
                opacity: .45;
                cursor: not-allowed;
            }
            .selected-mark {
                display: none;
                position: absolute;
                top: 0;
                right: 0;
                width: 22px;
                height: 22px;
                border-radius: 0 9px 0 10px;
                background: #e60012;
                color: #fff;
                line-height: 22px;
                font-size: 13px;
            }
            .select-card.active .selected-mark {
                display: block;
            }
            .mini-phone {
                width: 28px;
                height: 42px;
                border-radius: 7px;
                background: linear-gradient(145deg, #f8fafc, #f6b185);
                border: 2px solid #d1d5db;
                flex: 0 0 auto;
            }

            @media (max-width: 980px) {
                main .container > div[style*="grid-template-columns: minmax(320px"] {
                    grid-template-columns: 1fr !important;
                }
            }
            @media (max-width: 640px) {
                .color-option {
                    grid-column: span 3;
                }
            }
        </style>

        <script>
            const variants = @json($variants);
            let selectedStorage = variants[0]?.storage;
            let selectedColor = variants[0]?.pv_color;

            const formatPrice = (value) => new Intl.NumberFormat('vi-VN').format(Number(value || 0)) + 'đ';

            const getSelectedVariant = () => {
                let variant = variants.find((item) => item.storage === selectedStorage && item.pv_color === selectedColor);

                if (!variant) {
                    variant = variants.find((item) => item.storage === selectedStorage) || variants[0];
                    selectedColor = variant?.pv_color;
                }

                return variant;
            };

            const setActive = () => {
                document.querySelectorAll('.storage-option').forEach((button) => {
                    button.classList.toggle('active', button.dataset.storage === selectedStorage);
                });

                document.querySelectorAll('.color-option').forEach((button) => {
                    const available = button.dataset.storage === selectedStorage;
                    const active = available && button.dataset.color === selectedColor;
                    button.classList.toggle('active', active);
                    button.classList.toggle('disabled', !available);
                    button.disabled = !available;
                    button.style.display = available ? 'block' : 'none';
                });
            };

            const renderVariant = () => {
                const variant = getSelectedVariant();

                if (!variant) return;

                document.getElementById('variant-price').textContent = formatPrice(variant.pv_price);
                document.getElementById('trade-price').textContent = formatPrice(Math.max(Number(variant.pv_price || 0) - 3000000, 0));
                document.getElementById('variant-stock').textContent = 'Ton kho: ' + variant.pv_stock_qtt;
                document.getElementById('variant-desc').textContent = variant.desc || '';
                document.getElementById('cfg-cpu').textContent = variant.cpu || '';
                document.getElementById('cfg-ram').textContent = variant.ram || '';
                document.getElementById('cfg-storage').textContent = variant.storage || '';
                document.getElementById('cfg-gpu').textContent = variant.gpu || '';
                document.getElementById('cfg-screen').textContent = variant.screen || '';
                document.getElementById('cfg-os').textContent = variant.os || '';
                document.getElementById('cfg-battery').textContent = variant.battery || '';
                document.getElementById('cfg-camera').textContent = variant.camera || '';
                document.getElementById('cfg-connect').textContent = variant.connect || '';
                document.getElementById('cfg-other').textContent = variant.other_function || '';
                document.getElementById('add-to-cart-btn').href = '{{ url('/carts/addToCart') }}/' + variant.id;

                setActive();
            };

            document.querySelectorAll('.storage-option').forEach((button) => {
                button.addEventListener('click', () => {
                    selectedStorage = button.dataset.storage;
                    renderVariant();
                });
            });

            document.querySelectorAll('.color-option').forEach((button) => {
                button.addEventListener('click', () => {
                    selectedColor = button.dataset.color;
                    renderVariant();
                });
            });

            renderVariant();
        </script>
    @endif
@endsection
