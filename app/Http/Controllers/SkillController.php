<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return inertia('Skills/Index', ['skills' => $skills]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Skill::create(['name' => $request->name]);
        return redirect()->route('skills.index')->with('success', 'Skill added successfully!');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $skill->update(['name' => $request->name]);
        return redirect()->route('skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully!');
    }
}