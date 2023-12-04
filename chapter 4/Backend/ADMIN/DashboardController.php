<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Enums\TransactionStatusEnum;
use App\Http\Controllers\Api\ApiController;

class DashboardController extends ApiController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [
            'menu'          => Menu::count(),
            'today_order'   => Transaction::today()->status(TransactionStatusEnum::Waiting)->count(),
            'all_order'     => Transaction::count(),
        ];

        return $this->responseSuccessNoStucture($data, 'Get Dashboard Count');
    }
}
