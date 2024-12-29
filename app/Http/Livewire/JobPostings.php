<?php 
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\JobPosting;
use App\Models\Skill;

class JobPostings extends Component
{
    use WithFileUploads;

    public $title, $description, $company_name, $company_logo, $experience, $salary, $location, $skills = [];
    public $allSkills, $jobPostings;

    public function mount()
    {
        $this->allSkills = Skill::all();
        $this->jobPostings = JobPosting::with('skills')->get();
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'company_name' => 'required',
            'experience' => 'required',
            'location' => 'required',
            'skills' => 'array',
            'company_logo' => 'nullable|image|max:1024',
        ]);

        if ($this->company_logo) {
            $validated['company_logo'] = $this->company_logo->store('logos', 'public');
        }

        $job = JobPosting::create($validated);
        $job->skills()->sync($this->skills);

        $this->resetForm();
        $this->jobPostings = JobPosting::with('skills')->get();
        session()->flash('success', 'Job-posting Added successfully!');
        $this->render();
    }

    public function delete($id)
    {
        JobPosting::find($id)->delete();
        $this->jobPostings = JobPosting::with('skills')->get();
        session()->flash('success', 'Job-posting deleted successfully!');
    }

    private function resetForm()
    {
        $this->title = $this->description = $this->company_name = $this->experience = $this->location = '';
        $this->salary = null;
        $this->skills = [];
        $this->company_logo = null;
    }

    public function render()
    {
        return view('livewire.job-postings');
    }
}
