<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('active',1)->orderBy('id','desc')->paginate(10);
        return $plans;
    }

    public function all()
    {
        $plans = Plan::where('active',1)->get();
        return response()->json([
            'ok'=>true,
            'data' => $plans,
        ]);
    }

    public function store(Request $request)
    {
        $plan = new Plan;
        $plan->active = 1;
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->price = $request->price;
        $plan->save();
        return response()->json([
            'ok'=>true,
            'plan' => $plan,
        ]);
    }

    public function update(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->id);
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->price = $request->price;
        $plan->save();
        return response()->json([
            'ok'=>true,
            'plan' => $plan,
        ]);
    }

    public function inactive(Request $request)
    {
        $plan = Plan::findOrFail($request->id);
        $plan->active = 0;
        $plan->save();
        return response()->json([
            'ok'=>true
        ]);
    }
}
