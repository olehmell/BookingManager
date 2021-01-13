<?php


namespace App\Actions\AgentProduct;


use App\Models\AgentProduct;

class CreateAgentProductAction
{
    public function execute($request)
    {
        $agentProduct = new AgentProduct();

        $this->checkExisting($request);

        $agentProduct->fill($request);

        return tap($agentProduct)->save();
    }

    protected function checkExisting($request)
    {
        $existing = AgentProduct::where('agent_product_code', $request['agent_product_code'])->first();

        if ($existing) {
            return $existing;
        }
    }
}
