<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-lg font-bold text-gray-900 mb-2">{{ $opportunity->title }}</h2>
    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($opportunity->description, 100) }}</p>
    
    <div class="space-y-2 mb-4 text-sm text-gray-600">
        <p>📍 {{ $opportunity->ville }}</p>
        <p>📚 {{ $opportunity->niveau }}</p>
        <p>👤 {{ $opportunity->profil_requis }}</p>
    </div>
    
    <a href="{{ route('opportunities.show', $opportunity) }}" 
       class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
        View Details
    </a>
</div>