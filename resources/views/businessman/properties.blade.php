@extends('layouts.app')

@section('title', 'Meus Imóveis')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Meus Imóveis</h1>
            <a href="{{ route('businessman.property.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Cadastrar Imóvel</a>
        </div>

        @if($properties->count())
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr class="text-left">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Cidade</th>
                            <th class="px-4 py-3">Valor</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $property->id }}</td>
                                <td class="px-4 py-3">{{ $property->title }}</td>
                                <td class="px-4 py-3">{{ $property->city }}</td>
                                <td class="px-4 py-3">R$ {{ number_format($property->price_decimal, 2, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ ucfirst($property->status) }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('businessman.property.edit', $property->id) }}" class="text-blue-600 mr-3">Editar</a>
                                    <form action="{{ route('businessman.property.destroy', $property->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirma exclusão?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $properties->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-6 text-gray-600">
                Você ainda não cadastrou imóveis.
                <div class="mt-4">
                    <a href="{{ route('businessman.property.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Cadastre o primeiro</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
