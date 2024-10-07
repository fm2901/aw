<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DamageLevel;
use App\Models\Fileble;
use App\Models\Files;
use App\Models\Make;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function destroy($id)
    {
        DB::table('fileble')->where('file_id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
