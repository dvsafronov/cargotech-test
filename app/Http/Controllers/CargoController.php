<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'nullable|integer',
            'offset' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $limit = $request->limit ?? 15;
        $offset = $request->offset ?? 0;
        $result = Cargo::where('status', Cargo::STATUSES['ACTIVE'])
            ->orderBy('updated_at')
            ->limit($limit, $offset)
            ->get();
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = [];
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $id)
    {
        $result = Cargo::where('status', Cargo::STATUSES['ACTIVE'])
            ->where('id', $id)
            ->first();
        if (!$result) {
            return response()->json(['error' => 'not found'], 404);
        }
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $result = [];
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $id)
    {
        $result = Cargo::where('status', Cargo::STATUSES['ACTIVE'])
            ->where('id', $id)
            ->remove();
        return response()->json([
            'result' => $result ? 'success' : 'error'
        ]);
    }
}
