<x-forum.layouts.app>

<div class="my-8">
    <h2 class="text-2xl font-bold md:text-3xl mb-6">Editar Pregunta</h2>

    <form action="{{ route('questions.update', $question) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-300 mb-2">
                Título de la pregunta
            </label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $question->title) }}"
                class="w-full p-3 border border-gray-600 rounded-md text-sm bg-neutral-800 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="¿Cuál es tu pregunta?"
                required
            >
            @error('title')
                <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="category_id" class="block text-sm font-semibold text-gray-300 mb-2">
                Categoría
            </label>
            <select
                name="category_id"
                id="category_id"
                class="w-full p-3 border border-gray-600 rounded-md text-sm bg-neutral-800 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
            >
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $question->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold text-gray-300 mb-2">
                Descripción detallada
            </label>
            <textarea
                name="content"
                id="content"
                rows="8"
                class="w-full p-3 border border-gray-600 rounded-md text-sm bg-neutral-800 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Describe tu pregunta en detalle..."
                required
            >{{ old('content', $question->content) }}</textarea>
            @error('content')
                <span class="block text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex gap-4">
            <button
                type="submit"
                class="rounded-md bg-indigo-600 hover:bg-indigo-500 px-6 py-3 text-sm font-semibold text-white cursor-pointer transition-colors"
            >
                Actualizar Pregunta
            </button>
            <a
                href="{{ route('question.show', $question) }}"
                class="rounded-md bg-gray-600 hover:bg-gray-500 px-6 py-3 text-sm font-semibold text-white cursor-pointer transition-colors inline-block"
            >
                Cancelar
            </a>
        </div>
    </form>
</div>

</x-forum.layouts.app>
