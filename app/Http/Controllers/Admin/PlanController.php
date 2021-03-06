<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

/**
 * __construct
 *
 * @param  mixed $plan
 * @return void
 */
public function __construct(Plan $plan)
{
    $this->repository = $plan;
}
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreUpdatePlan $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }
    
    /**
     * show
     *
     * @param  mixed $url
     * @return void
     */
    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        if(!$plan){
            return redirect()->back();
        }
        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }
    
    /**
     * destroy
     *
     * @param  mixed $url
     * @return void
     */
    public function destroy($url)
    {
        $plan = $this->repository
            ->with('details')
            ->where('url', $url)
            ->first();

        if(!$plan)
            return redirect()->back();

        if ($plan->details->count() > 0){
            return redirect()
                    ->back()
                    ->with('error', 'Existem detalhes vinculados a esse plano, por isso não pode deletar!');
        }

        $plan->delete();

        return redirect()->route('plans.index');
    }
    
    /**
     * search
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
    
    /**
     * edit
     *
     * @param  mixed $url
     * @return void
     */
    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();
        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', [
            'plan' => $plan,
        ]);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $url
     * @return void
     */
    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if(!$plan)
            return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }
}
