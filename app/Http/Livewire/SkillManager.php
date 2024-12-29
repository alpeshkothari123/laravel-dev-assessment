<?php
namespace App\Http\Livewire;

use App\Models\Skill;
use Livewire\Component;

class SkillManager extends Component
{
    public $skills;
    public $name;
    public $skillId;
    public $editMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->loadSkills();
    }

    public function loadSkills()
    {
        $this->skills = Skill::all();
    }

    public function saveSkill()
    {
        $this->validate();

        if ($this->editMode) {
            $skill = Skill::findOrFail($this->skillId);
            $skill->update(['name' => $this->name]);
        } else {
            Skill::create(['name' => $this->name]);
        }

        $this->resetForm();
        $this->loadSkills();
        session()->flash('success', $this->editMode ? 'Skill updated successfully!' : 'Skill added successfully!');
    }

    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skillId = $skill->id;
        $this->name = $skill->name;
        $this->editMode = true;
    }

    public function deleteSkill($id)
    {
        Skill::findOrFail($id)->delete();
        $this->loadSkills();
        session()->flash('success', 'Skill deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->skillId = null;
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.skill-manager');
    }
}
