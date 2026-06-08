<!-- resources/views/components/navigation.blade.php -->
<nav class="bg-white shadow-sm border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-gray-900">PartnerConnect</a>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Opportunities</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Partners</a>
                @auth
                    <a href="#" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                @else
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Sign In</a>
                @endauth
            </div>
        </div>
    </div>
</nav>