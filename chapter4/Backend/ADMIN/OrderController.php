<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\TransactionStatusEnum;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\UpdateOrderRequest;

class OrderController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/admin/order/",
     *     summary="Get Today Order",
     *     tags={"Admin/Order"},
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        $transactions = Transaction::with('details','details.menu')->today()->get();
        return $this->responseSuccessNoStucture($transactions, 'Get Today Order');
    }

    /**
     * @OA\Get(
     *     path="/api/admin/order/notification",
     *     summary="Get Today Order & Notification",
     *     tags={"Admin/Order"},
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function notification()
    {
        $transactionCount = Transaction::status(TransactionStatusEnum::Waiting)->count();
        $transactionLatest = Transaction::with('details','details.menu')->status(TransactionStatusEnum::Waiting)->latest()->limit(3)->get();
        $data = [
            'count' => $transactionCount,
            'data'  => $transactionLatest
        ];
        return $this->responseSuccessNoStucture($data, "Notification Count");
    }

    /**
     * @OA\Get(
     *     path="/api/admin/order/{transaction}",
     *     summary="Get Detail Order",
     *     tags={"Admin/Order"},
     *     @OA\Parameter(
     *      name="transaction",
     *      in="path",
     *      required=true,
     *      description="The unique identifier of the menu.",
     *      @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('details','details.menu');
        return $this->responseSuccessNoStucture($transaction, "Detail Transaction");
    }

    /**
     * @OA\Get(
     *     path="/api/admin/order/history",
     *     summary="Get Order History",
     *     tags={"Admin/Order"},
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function history()
    {
        $histories_transaction = Transaction::with('details','details.menu')->latest()->get();
        return $this->responseSuccessNoStucture($histories_transaction, 'Get Histories Order');
    }

    /**
     * @OA\Put(
     *  path="/api/admin/order/{transaction}",
     *  summary="Update Order Status",
     *  tags={"Admin/Order"},
     *  @OA\Parameter(
     *      name="transaction",
     *      in="path",
     *      required=true,
     *      description="The unique identifier of the order transaction.",
     *      @OA\Schema(type="string")
     *  ),
     *  @OA\RequestBody(
     *      @OA\JsonContent(),
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              type="object",
     *              required={"status"},
     *              @OA\Property(
     *                  property="status",
     *                  type="string"
     *              ),
     *          )
     *      )
     *  ),
     *  @OA\Response(response="200", description="Order Status Has Been Updated"),
     *  @OA\Response(response="422", description="Validation Error"),
     *  @OA\Response(response="500", description="Something Went Wrong"),
     *  security={{"bearerAuth": {}}}
     * )
     */
    public function update(UpdateOrderRequest $request, Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            $transaction->update([
                'status' => $request->validated('status')
            ]);

            DB::commit();
            return $this->responseSuccessNoStucture(message:'Transaction Status Has Been Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }
}
