@extends('layouts.admin')

@section('title', 'Them bien the')
@section('subtitle', 'Them mau sac, dung luong, gia va cau hinh cho san pham')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('productVariants.store', $product->id) }}" class="form-grid">
                @csrf
                <div>
                    <label class="form-label">San pham</label>
                    <input type="text" value="{{ $product->product_name }}" disabled>
                </div>
                <div>
                    <label class="form-label" for="pv_color">Mau sac</label>
                    <input id="pv_color" type="text" name="pv_color" required>
                </div>
                <div>
                    <label class="form-label" for="pv_price">Gia bien the</label>
                    <input id="pv_price" type="number" name="pv_price" min="0" required>
                </div>
                <div>
                    <label class="form-label" for="pv_stock_qtt">Ton kho bien the</label>
                    <input id="pv_stock_qtt" type="number" name="pv_stock_qtt" min="0" required>
                </div>
                <div>
                    <label class="form-label" for="configuration_id">Cau hinh</label>
                    <select id="configuration_id" name="configuration_id" required>
                        @foreach($configurations as $configuration)
                            <option value="{{ $configuration->id }}">
                                #{{ $configuration->id }} - {{ $configuration->ram }} - {{ $configuration->storage }} - {{ $configuration->cpu }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="desc">Mo ta</label>
                    <textarea id="desc" name="desc" rows="4"></textarea>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Luu</button>
                    <a href="{{ route('productVariants.index', $product->id) }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
