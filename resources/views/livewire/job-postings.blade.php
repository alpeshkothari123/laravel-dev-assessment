<div>
    <h1 class="text-2xl font-bold mb-4">Manage Job Postings</h1>
    <form wire:submit.prevent="store" class="space-y-4">
        <input type="text" wire:model="title" placeholder="Job Title" class="input" />
        <textarea wire:model="description" placeholder="Description" class="textarea"></textarea>
        <input type="text" wire:model="company_name" placeholder="Company Name" class="input" />
        <input type="file" wire:model="company_logo" class="input" />
        <input type="text" wire:model="experience" placeholder="Experience" class="input" />
        <input type="number" wire:model="salary" placeholder="Salary" class="input" />
        <input type="text" wire:model="location" placeholder="Location" class="input" />
        <select wire:model="skills" multiple class="select">
            @foreach($allSkills as $skill)
                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Create Job</button>
    </form>

    <div class="mt-8">
        <h2 class="text-xl font-semibold">Existing Job Postings</h2>
        <ul>
            @foreach($jobPostings as $job)
                <li class="p-4 border-b">
                    <h3 class="font-bold">{{ $job->title }}</h3>
                    <p>{{ $job->description }}</p>
                    <p>Skills: {{ $job->skills->pluck('name')->join(', ') }}</p>
                    <button wire:click="delete({{ $job->id }})" class="btn btn-danger">Delete</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
