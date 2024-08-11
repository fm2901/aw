<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DamageLevel;
use App\Models\Make;
use App\Models\Order;
use App\Models\Files;
use App\Models\Fileble;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function index(Request $request): View
    {
        $filter = [];
        if(!$request->user()->hasRole('admin')) {
            $filter["user_id"] = $request->user()->id;
        }


        $totalRecords = Purchase::select('count(*) as allcount')->count();
        $rowperpage = 10;
        $curPage = intval($request->get("p")) > 0 ? $request->get("p") : 1;
        $start = ($curPage-1) * $rowperpage;
        $pagesCount = round($totalRecords / $rowperpage);

        $sortBy = $request->query("sortBy", "id");
        $sortDir = $request->query("desc", "asc");

        $purchases = Purchase::where($filter)
            ->orderBy($sortBy, $sortDir)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $query = $request->query();
        unset($query["p"]);

        $currentSort = $request->query('sortBy') ?? 'award_date';
        $currentSort .= '&sort=';
        $currentSort .= $request->query('sort') ?? 'asc';

        return view('purchases.index', [
            'purchases' => $purchases,
            'allCount'    => $totalRecords,
            'pagesCount'    => $pagesCount,
            'curPage'    => $curPage,
            'query'    => http_build_query($query),
            'currentSort' => $currentSort,
        ]);
    }

    public function show(Purchase $purchase): View
    {
        $invoice = explode("/", $purchase->invoice);
        $invoice = $invoice[count($invoice) - 1];

        return view('purchases.show', [
            'purchase' => $purchase,
            'invoice' => $invoice,
        ]);
    }

    public function create(Request $request): View
    {
        $orderId = $request->query('order_id') > 0 ? $request->query('order_id') : null;

        $order = null;
        if($orderId > 0) {
            $order = Order::find($orderId);
        }

        return view('purchases.create', [
            'user' => $request->user(),
            'makes' => Make::all(),
            'users' => User::all(),
            'purchaseId' => Helper::getRandomIdWithCheck((new Purchase), 'purchase_id', 10),
            'order' => $order,
        ]);
    }

    public function edit(Purchase $purchase, Request $request): View
    {
        return view('purchases.edit', [
            'user' => $request->user(),
            'makes' => Make::all(),
            'users' => User::all(),
            'purchase' => $purchase,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $input_data = $request->all();
        $validator = Validator::make(
            $input_data, [
            'invoice.*' => 'required|mimes:pdf|max:20000'
        ],[
                'invoice.*.required' => 'Пожалуйста выберите фотографии',
                'invoice.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'invoice.*.max' => 'Максимальный размер файла 20MB',
            ]
        );
        $invoice = "";

        if(!$validator->fails()) {
            $file = $request->file('invoice');

            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());

            $invoice = "/invoices/".time()."_".$fileName;
            Storage::put($invoice, $fileContent);
        }

        $purchase = Purchase::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'purchase_id' => $request->purchase_id,
            'title' => $request->title,
            'vin' => $request->vin,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'trim' => $request->trim,
            'award_date' => $request->award_date,
            'auction' => $request->auction,
            'invoice' => $invoice,
            'auction_location' => $request->auction_location,
            'lot' => $request->lot,
            'balance' => $request->balance,
            'notes' => $request->notes
        ]);

               $validator = Validator::make(
            $input_data, [
            'photo.*' => 'required|mimes:jpg,png|max:20000'
        ],[
                'photo.*.required' => 'Пожалуйста выберите фотографии',
                'photo.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'photo.*.max' => 'Максимальный размер файла 20MB',
            ]
        );

        if($request->file('photo') && !$validator->fails()) {

            foreach($request->file('photo') as $file) {

                $fileName = $file->getClientOriginalName();
                $fileContent = file_get_contents($file->getRealPath());

                $photo = "/cars/" . time() . "_" . $fileName;
                Storage::put($photo, $fileContent);

                $newPhoto = Files::updateOrCreate([
                    'path' => $photo,
                    'created_by' => $request->user()->id,
                ]);

                Fileble::updateOrCreate([
                    'file_id' => $newPhoto->id,
                    'fileble_id' => $purchase->id,
                    'fileble_type' => Purchase::class,
                ]);
            }
        }

        return Redirect::route('purchases.index');
    }
    public function update(Purchase $purchase, Request $request): RedirectResponse
    {
        $input_data = $request->all();
        $validator = Validator::make(
            $input_data, [
            'invoice.*' => 'required|mimes:pdf|max:20000'
        ],[
                'invoice.*.required' => 'Пожалуйста выберите фотографии',
                'invoice.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'invoice.*.max' => 'Максимальный размер файла 20MB',
            ]
        );
        $invoice = "";

        if($request->file('invoice') && !$validator->fails()) {
            $file = $request->file('invoice');

            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());

            $invoice = "/invoices/".time()."_".$fileName;
            Storage::put($invoice, $fileContent);
        }

        $validator = Validator::make(
            $input_data, [
            'photo.*' => 'required|mimes:jpg,png|max:20000'
        ],[
                'photo.*.required' => 'Пожалуйста выберите фотографии',
                'photo.*.mimes' => 'Поддерживаются только форматы jpg, jpeg, png',
                'photo.*.max' => 'Максимальный размер файла 20MB',
            ]
        );

        if($request->file('photo') && !$validator->fails()) {

            foreach($request->file('photo') as $file) {

                $fileName = $file->getClientOriginalName();
                $fileContent = file_get_contents($file->getRealPath());

                $photo = "/cars/" . time() . "_" . $fileName;
                Storage::put($photo, $fileContent);

                $newPhoto = Files::updateOrCreate([
                    'path' => $photo,
                    'created_by' => $request->user()->id,
                ]);

                Fileble::updateOrCreate([
                    'file_id' => $newPhoto->id,
                    'fileble_id' => $purchase->id,
                    'fileble_type' => Purchase::class,
                ]);
            }
        }

        $data = [
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'purchase_id' => $request->purchase_id,
            'title' => $request->title,
            'vin' => $request->vin,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'trim' => $request->trim,
            'award_date' => $request->award_date,
            'auction' => $request->auction,
            'auction_location' => $request->auction_location,
            'lot' => $request->lot,
            'balance' => $request->balance,
            'notes' => $request->notes
        ];

        if(strlen($invoice) > 0) {
            $data['invoice'] = $invoice;
        }

        $purchase->update($data);

        return Redirect::route('purchases.index');
    }
}
