@extends('layouts.app')

@section('title', 'Cadastrar Imóvel')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-semibold mb-4">Cadastrar Imóvel</h1>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('businessman.property.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <input name="title" placeholder="Título" value="{{ old('title') }}" class="border p-2 rounded" />
                    <input name="city" placeholder="Cidade" value="{{ old('city') }}" class="border p-2 rounded" />
                    <input name="price" placeholder="Valor" value="{{ old('price') }}" class="border p-2 rounded" />
                    <input name="registration_number" placeholder="Matrícula (privada)" value="{{ old('registration_number') }}" class="border p-2 rounded" />

                    <label class="text-sm font-medium">Tipo</label>
                    <select name="type" class="border p-2 rounded">
                        <option value="apartment">Apartamento</option>
                        <option value="house">Casa</option>
                        <option value="commercial">Comercial</option>
                        <option value="land">Terreno</option>
                        <option value="other">Outro</option>
                    </select>

                    <label class="text-sm font-medium">Imagens (até 6)</label>
                    <input type="file" name="images[]" accept="image/*" multiple class="border p-2 rounded" />

                    <label class="text-sm font-medium">Vídeo (opcional)</label>
                    <input type="file" name="video" accept="video/*" class="border p-2 rounded" />

                    <textarea name="description" placeholder="Descrição" class="border p-2 rounded">{{ old('description') }}</textarea>

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
