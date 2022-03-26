<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioRequest;
use App\Service\Portfolio\PortfolioService;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    use GeneralTrait;

    private $portfolioService;

    public function __construct (PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    public function index ()
    {
        $portfolio = $this->portfolioService->index ();
        return view ('admin.portfolio.index', compact ('portfolio'));
    }

    public function create ()
    {
        $categories = $this->portfolioService->create ();
        return view ('admin.portfolio.create', compact ('categories'));
    }

    public function store (PortfolioRequest $request)
    {
        try {
            $this->portfolioService->store ($request);
            return $this->SuccessMessage ('portfolios.index', ' added');
        } catch (\Exception $ex) {
            DB::rollback ();
            return $this->ErrorMessage ('portfolios.create', $ex->getMessage ());
//            return redirect ()->route ('portfolios.create')->withErrors ('error',  $ex->getMessage ());

        }
    }

    public function show ()
    {
    }

    public function edit ($portfolio)
    {
        $portfolio = $this->portfolioService->edit ($portfolio);
        $categories = $this->portfolioService->create ();
        return view ('admin.portfolio.edit', compact ('portfolio', 'categories'));
    }

    public function update (PortfolioRequest $request, $portfolio)
    {
        try {
            $this->portfolioService->update ($request, $portfolio);
            return $this->SuccessMessage ('portfolios.index', ' updated');
        } catch (\Exception $ex) {
            DB::rollback ();
//            return $this->ErrorMessage ('portfolios.edit', $ex->getMessage ());
            return redirect()->route('portfolios.edit')->with('error', $ex->getMessage ());

//            return redirect ()->route ('portfolios.edit')->withErrors ('error',  $ex->getMessage ());
        }
    }

    public function destroy ($portfolio)
    {
        try {
            $this->portfolioService->destroy ($portfolio);
            return $this->SuccessMessage ('portfolios.index', ' deleted');
        } catch (\Exception $ex) {
            DB::rollback ();
            return $this->ErrorMessage ('portfolios.index', $ex->getMessage ());
        }
    }
}
