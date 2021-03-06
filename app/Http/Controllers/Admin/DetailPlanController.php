<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository, $plan;
        
    /**
     * __construct
     *
     * @param  mixed $detailPlan
     * @return void
     */
    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }
    
    /**
     * index
     *
     * @param  mixed $urlPlan
     * @return void
     */
    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }
    
    /**
     * create
     *
     * @param  mixed $urlPlan
     * @return void
     */
    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @param  mixed $urlPlan
     * @return void
     */
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()){
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }
    
    /**
     * edit
     *
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }
    
    /**
     * show
     *
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }
    
    /**
     * destroy
     *
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail){
            return redirect()->back();
        }

        $detail->delete($detail);

        return redirect()
        ->route('details.plan.index', $plan->url)
        ->with('message', 'Registro deletado com secesso!');
    }
}
