@extends('layouts.admin')

@section('title', 'Sua bien the')
@section('subtitle', 'Cap nhat mau sac, gia, ton kho va cau hinh')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('productVariants.update', [$product->id, $variant->id]) }}" class="form-grid">
                @csrf
                @method('PUT')
                <div>
                    <label class="form-label">San pham</label>
                    <input type="text" value="{{ $product->product_name }}" disabled>
                </div>
                <div>
                    <label class="form-label" for="pv_color">Mau sac</label>
                    <input id="pv_color" type="text" name="pv_color" value="{{ $variant->pv_color }}" required>
                </div>
                <div>
                    <label class="form-label" for="pv_price">Gia bien the</label>
                    <input id="pv_price" type="number" name="pv_price" min="0" value="{{ $variant->pv_price }}" required>
                </div>
                <div>
                    <label class="form-label" for="pv_stock_qtt">Ton kho bien the</label>
                    <input id="pv_stock_qtt" type="number" name="pv_stock_qtt" min="0" value="{{ $variant->pv_stock_qtt }}" required>
                </div>
                <div>
                    <label class="form-label" for="configuration_id">Cau hinh</label>
                    <select id="configuration_id" name="configuration_id" required>
                        @foreach($configurations as $configuration)
                            <option value="{{ $configuration->id }}" @if($configuration->id == $variant->configuration_id) selected @endif>
                                #{{ $configuration->id }} - {{ $configuration->ram }} - {{ $configuration->storage }} - {{ $configuration->cpu }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="desc">Mo ta</label>
                    <textarea id="desc" name="desc" rows="4">{{ $variant->desc }}</textarea>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Cap nhat</button>
                    <a href="{{ route('productVariants.index', $product->id) }}" class="btn">Quay lai</a>
                </div>
            </form>
        </div>
    </div>
@endsection
