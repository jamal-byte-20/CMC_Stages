<!-- resources/views/opportunities/index.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Opportunities</h1>
            <p class="mt-2 text-gray-600">Discover opportunities created by our trusted partners</p>
        </div>

        <!--  Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                {{-- FUTURE FILTER --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">All Categories</option>
                        <option value="internship" {{ request('category') == 'internship' ? 'selected' : '' }}>Internship</option>
                        <option value="scholarship" {{ request('category') == 'scholarship' ? 'selected' : '' }}>Scholarship</option>
                        <option value="job" {{ request('category') == 'job' ? 'selected' : '' }}>Job</option>
                        <option value="volunteer" {{ request('category') == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                        <option value="project" {{ request('category') == 'project' ? 'selected' : '' }}>Project</option>
                    </select>
                </div>
                
            </form>
        </div>

        <!-- Opportunities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($opportunities as $opportunity)
                {{-- Create card with empty state also and get based on the fillable of Opportunity --}}
                <x-opportunity-card :opportunity="$opportunity" />
            @empty
                <div class="col-span-full text-center py-12">
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">No Opportunities Found</h3>
                    <p class="text-gray-500">Check back later for new opportunities</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>