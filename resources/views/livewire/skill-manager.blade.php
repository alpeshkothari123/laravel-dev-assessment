<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Skills Management</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex gap-8">
        <!-- Skills Table -->
        <div class="w-1/2">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Skill</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $skill)
                        <tr>
                            <td class="border px-4 py-2">{{ $skill->name }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="editSkill({{ $skill->id }})" class="bg-blue-500 text-white px-3 py-1 rounded mr-2">
                                    Edit
                                </button>
                                <button wire:click="deleteSkill({{ $skill->id }})" class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add/Edit Form -->
        <div class="w-1/2">
            <form wire:submit.prevent="saveSkill" class="bg-gray-100 p-4 rounded shadow-md">
                <h2 class="text-lg font-bold mb-4">{{ $editMode ? 'Edit Skill' : 'Add New Skill' }}</h2>

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-2">Skill Name</label>
                    <input type="text" id="name" wire:model="name" class="border border-gray-300 rounded px-4 py-2 w-full" />
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                    {{ $editMode ? 'Update' : 'Add' }}
                </button>
                @if ($editMode)
                    <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
                        Cancel
                    </button>
                @endif
            </form>
        </div>
    </div>
</div>
