<?php 
namespace App\Http\Livewire\Pages;

use App\Models\Skill;
use Livewire\Component;

class Skills extends Component
{
    public $name;
    public $editing = null;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        if ($this->editing) {
            Skill::find($this->editing)->update(['name' => $this->name]);
        } else {
            Skill::create(['name' => $this->name]);
        }

        $this->reset();
    }

    public function edit($id)
    {
        $skill = Skill::find($id);
        $this->editing = $id;
        $this->name = $skill->name;
    }

    public function delete($id)
    {
        Skill::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.pages.skills', [
            'skills' => Skill::all(),
        ]);
    }
}
