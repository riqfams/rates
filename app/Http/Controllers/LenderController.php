<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLenderRequest;
use App\Models\AdditionalAdjustment;
use App\Models\FicoAdjustment;
use App\Models\Lender;
use App\Models\LoanAmountAdjustment;
use App\Models\Rate;
use Illuminate\Http\Request;

class LenderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = 10;
        $query = Lender::whereNull('deleted_at');
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
            });
        }

        $lenders = $query->orderByDesc('id')->paginate($perPage);
        return view('pages.lenders.index', compact('lenders'));
    }

    public function show() {

    }

    public function create()
    {
        $credits = [
            '800 +',
            '780 - 799',
            '760 - 780',
            '740 - 759',
            '720 - 739',
            '700 - 719',
            '680 - 699',
            '660 - 679',
            '620 - 659',
            '580 - 619',
            'less than 580'
        ];

        return view('pages.lenders.create', compact('credits'));
    }

    public function store(StoreLenderRequest $request)
    {
        $lender = new Lender();
        $lender->name = $request->input('name');
        $lender->purpose = $request->input('purpose');
        $lender->product = $request->input('product');
        $lender->save();
        
        $rates = $request->input('rates');
        $days15 = $request->input('days15');
        $days30 = $request->input('days30');
        $days45 = $request->input('days45');
        $margins = $request->input('margin');
        $totalRates = $request->input('total_rate');
        // dd($request->all());
        for ($i = 0; $i < count($rates); $i++)  {
            $rateData = new Rate();
            $rateData->lender_id = $lender->id;
            $rateData->rate = $rates[$i];
            $rateData->days15 = $days15[$i];
            $rateData->days30 = $days30[$i];
            $rateData->days45 = $days45[$i];
            $rateData->margin = $margins[$i];
            $rateData->total_rate = $totalRates[$i];
            $rateData->save();
        }

        $low = $request->input('low');
        $high = $request->input('high');
        $adjustment = $request->input('adjustment');
        for ($i = 0; $i < count($low); $i++)  {
            $loanAmountData = new LoanAmountAdjustment();
            $loanAmountData->lender_id = $lender->id;
            $loanAmountData->loan_amount_low = $low[$i];
            $loanAmountData->loan_amount_high = $high[$i];
            $loanAmountData->adjustment = $adjustment[$i];
            $loanAmountData->save();
        }

        $ficoLow = $request->input('fico_low');
        $ficoHigh = $request->input('fico_high');
        $ficoAdjustment = $request->input('fico_adjustment');
        for ($i = 0; $i < count($ficoLow); $i++)  {
            $ficoData = new FicoAdjustment();
            $ficoData->lender_id = $lender->id;
            $ficoData->fico_range_low = $ficoLow[$i];
            $ficoData->fico_range_high = $ficoHigh[$i];
            $ficoData->adjustment = $ficoAdjustment[$i];
            $ficoData->save();
        }

        $option = $request->input('option');
        $operand = $request->input('operand');
        $value = $request->input('value');
        $additionalAdjustments = $request->input('additional_adjustment');
        for ($i = 0; $i < count($option); $i++)  {
            $additionalData = new AdditionalAdjustment();
            $additionalData->lender_id = $lender->id;
            $additionalData->options = $option[$i];
            $additionalData->operand = $operand[$i];
            $additionalData->value = $value[$i];
            $additionalData->adjustment = $additionalAdjustments[$i];
            $additionalData->save();
        }

        return redirect()->route('lenders.index')->with('success', 'Lender added successfully.');
    }
}
