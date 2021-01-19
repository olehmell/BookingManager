<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAgentRequest;
use App\Models\Agent;

class AgentController extends Controller
{
    public function index()
    {
        return Agent::all();
    }

    public function show($id)
    {
        return Agent::findOrFail($id);
    }

    public function store(CreateAgentRequest $request)
    {
        return Agent::create($request->validated());
    }

    public function update(CreateAgentRequest $request, $id)
    {
        $agent = Agent::findOrFail($id);

        return $agent->update($request->validated());
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);

        return $agent->delete();
    }
}
