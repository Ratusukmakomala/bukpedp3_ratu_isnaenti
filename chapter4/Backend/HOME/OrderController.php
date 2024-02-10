<?php

namespace App\Http\Controllers\Api\Home;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use App\Enums\TransactionStatusEnum;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\StoreOrderRequest;

class OrderController extends ApiController
{
    /**
     * @OA\Post(
     *  path="/api/home/order",
     *  summary="Create an order",
     *  tags={"Home"},
     *  @OA\RequestBody(
     *  @OA\JsonContent(),
     *  @OA\MediaType(
     *      mediaType="multipart/form-data",
     *      @OA\Schema(
     *          type="object",
     *          required={"table_number", "order_name", "payment", "orders"},
     *          @OA\Property(
     *              property="table_number",
     *              type="integer"
     *          ),
     *          @OA\Property(
     *              property="order_name",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="payment",
     *              type="string"
     *          ),
     *          @OA\Property(
     *              property="orders",
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(
     *                      property="menu_id",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="qty",
     *                      type="integer"
     *                  ),
     *              )
     *          ),
     *      )
     *   )
     *  ),
     *  @OA\Response(response="200", description="Order Has Created Successfully"),
     *  @OA\Response(response="422", description="Validation Error"),
     *  @OA\Response(response="500", description="Something Went Wrong"),
     * )
     */
    public function __invoke(StoreOrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'table_number'  => $request->validated('table_number'),
                'order_name'    => $request->validated('order_name'),
                'payment'       => $request->validated('payment'),
                'order_date'    => Carbon::now()->format('Y-m-d'),
                'status'        => TransactionStatusEnum::Waiting,
            ]);

            $grandTotal = null;
            foreach ($request->validated('orders') as $order) {
                $menu = Menu::find($order['menu_id']);
                $subPrice = (int)$menu->price * $order['qty'];
                $grandTotal += $subPrice;

                DetailTransaction::create([
                    'transaction_id' => $transaction->latest()->first()->id,
                    'menu_id'        => $order['menu_id'],
                    'qty'            => $order['qty'],
                ]);
            }

            $transaction->latest()->first()->update([
                'grand_total' => $grandTotal
            ]);

            DB::commit();
            return $this->responseSuccessNoStucture(message:'Order Has Been Created');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }
}
