@extends('layouts.app')

@section('title', 'Editar Imóvel')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-semibold mb-4">Editar Imóvel</h1>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('businessman.property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4">
                    <input name="title" placeholder="Título" value="{{ old('title', $property->title) }}" class="border p-2 rounded" />
                    <input name="city" placeholder="Cidade" value="{{ old('city', $property->city) }}" class="border p-2 rounded" />
                    <input name="price" placeholder="Valor" value="{{ old('price', $property->price) }}" class="border p-2 rounded" />
                    <input name="registration_number" placeholder="Matrícula (privada)" value="{{ old('registration_number', $property->registration_number) }}" class="border p-2 rounded" />

                    <label class="text-sm font-medium">Imagens (até 6) - enviar novas imagens acrescenta</label>
                    <input type="file" name="images[]" accept="image/*" multiple class="border p-2 rounded" />
                    @if($property->images->count())
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($property->images as $img)
                                <div class="p-1 border rounded">
                                    <img src="{{ asset('storage/' . $img->path) }}" alt="" class="w-full h-32 object-cover" />
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <label class="text-sm font-medium">Vídeo (opcional)</label>
                    <input type="file" name="video" accept="video/*" class="border p-2 rounded" />

                    <label class="text-sm font-medium">Tipo</label>
                    <select name="type" class="border p-2 rounded">
                        <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>Apartamento</option>
                        <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>Casa</option>
                        <option value="commercial" {{ old('type', $property->type) == 'commercial' ? 'selected' : '' }}>Comercial</option>
                        <option value="land" {{ old('type', $property->type) == 'land' ? 'selected' : '' }}>Terreno</option>
                        <option value="other" {{ old('type', $property->type) == 'other' ? 'selected' : '' }}>Outro</option>
                    </select>

                    <textarea name="description" placeholder="Descrição" class="border p-2 rounded">{{ old('description', $property->description) }}</textarea>

                    <div class="flex justify-end space-x-2 mt-4">
                        <a href="{{ route('businessman.properties') }}" class="px-4 py-2 rounded border">Voltar</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
