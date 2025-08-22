<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-content {
            margin-left: 220px;
            padding: 30px;
        }
        .form-control:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.2rem rgba(73, 80, 87, 0.25);
        }
        .btn-primary {
            background-color: #495057;
            border-color: #495057;
        }
        .btn-primary:hover {
            background-color: #343a40;
            border-color: #343a40;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .category-checkboxes {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
    </style>
</head>
<body>

    @include('admin.sidebar')

    <div class="main-content">
        <h3>{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Add/Edit Product Form --}}
        <form method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category (Select one or more)</label>
                <div class="category-checkboxes">
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input type="checkbox" name="category[]" id="category_{{ $category }}" value="{{ $category }}"
                                   class="form-check-input"
                                   {{ in_array($category, old('category', isset($product) ? explode(',', $product->category) : [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $category }}">{{ $category }}</label>
                        </div>
                    @endforeach
                </div>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', isset($product) ? $product->quantity : '') }}" required min="0">
            </div>

            <div class="mb-3">
                <label for="unit_price" class="form-label">Unit Price </label>
                <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', isset($product) ? $product->unit_price : '') }}" step="0.01" required min="0">
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" name="unit" id="unit" class="form-control" value="{{ old('unit', isset($product) ? $product->unit : '') }}" required placeholder="e.g., ml, g, pieces">
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Add Product' }}</button>
            @if(isset($product))
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
            @endif
        </form>

        {{-- Product List --}}
        <h3 class="mt-5">Product List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Unit Price ($)</th>
                    <th>Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $prod)
                    <tr>
                        <td>{{ $prod->name }}</td>
                        <td>{{ $prod->category }}</td>
                        <td>{{ $prod->quantity }}</td>
                        <td>{{ number_format($prod->unit_price, 2) }}</td>
                        <td>{{ $prod->unit }}</td>
                        <td>
                            <a href="{{ route('product.edit', $prod->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('product.destroy', $prod->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>