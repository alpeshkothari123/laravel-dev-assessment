<div class="p-4">
    <h1 class="text-2xl font-bold">Admin - Skills Management</h1>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <h2 class="text-lg font-semibold">Skills List</h2>
            <ul class="border rounded p-4">
                @foreach ($skills as $skill)
                    <li class="flex justify-between items-center mb-2">
                        <span>{{ $skill->name }}</span>
                        <div>
                            <button
                                class="text-blue-500"
                                wire:click="edit({{ $skill->id }})"
                            >
                                Edit
                            </button>
                            <button
                                class="text-red-500"
                                wire:click="delete({{ $skill->id }})"
                            >
                                Delete
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h2 class="text-lg font-semibold">Add/Edit Skill</h2>
            <form wire:submit.prevent="save">
                <input
                    type="text"
                    wire:model="name"
                    placeholder="Enter skill name"
                    class="w-full p-2 border rounded mb-2"
                />
                <button
                    type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded"
                >
                    Save
                </button>
            </form>
        </div>
    </div>
</div>
