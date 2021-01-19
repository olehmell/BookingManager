<?php

namespace App\Http\Controllers;

use App\Actions\AgentProduct\CreateAgentProductAction;
use App\Http\Requests\AgentProductRequest;
use App\Models\AgentProduct;
use Illuminate\Http\Request;

class AgentProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgentProductRequest $request)
    {
        return (new CreateAgentProductAction())->execute($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookings\AgentProduct  $agentProduct
     * @return \Illuminate\Http\Response
     */
    public function show(AgentProduct $agentProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookings\AgentProduct  $agentProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(AgentProduct $agentProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookings\AgentProduct  $agentProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AgentProduct $agentProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookings\AgentProduct  $agentProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgentProduct $agentProduct)
    {
        //
    }
}
