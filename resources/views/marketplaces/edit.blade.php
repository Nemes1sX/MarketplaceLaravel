<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Listing</h2>

                    <form action="{{ route('marketplaces.update', $marketplace) }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $marketplace->name) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $marketplace->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="active" {{ old('status', $marketplace->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $marketplace->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            @if($marketplace->image)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                    <img src="{{ Storage::url($marketplace->image) }}" 
                                         alt="Current image" 
                                         class="w-48 h-48 object-cover rounded">
                                </div>
                            @endif
                            
                            <label for="image" class="block text-sm font-medium text-gray-700">New Image</label>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="mt-1 block w-full">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Listing
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 