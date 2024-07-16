<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLenderRequest;
use App\Models\AdditionalAdjustment;
use App\Models\CreditAndLtv;
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

    public function show($id) {
        $lender = Lender::findOrFail($id);
        return view('pages.lenders.show', compact('lender'));
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

        $credits = ['800_+', '780_-_799', '760_-_780', '740_-_759', '720_-_739', '700_-_719', '680_-_699', '660_-_679', '620_-_659', '580_-_619', 'less_than_580'];
        foreach($credits as $credit){
            $credit_ranges = $request->input('credit_' . $credit);
            
            $creditLtv = new CreditAndLtv();
            $creditLtv->lender_id = $lender->id;
            $creditLtv->credit_range = $credit;
            $creditLtv->ltv_0_50 = $credit_ranges[0];
            $creditLtv->ltv_50_55 = $credit_ranges[1];
            $creditLtv->ltv_55_60 = $credit_ranges[2];
            $creditLtv->ltv_60_65 = $credit_ranges[3];
            $creditLtv->ltv_65_70 = $credit_ranges[4];
            $creditLtv->ltv_70_75 = $credit_ranges[5];
            $creditLtv->ltv_75_80 = $credit_ranges[6];
            $creditLtv->ltv_80_85 = $credit_ranges[7];
            $creditLtv->ltv_85_90 = $credit_ranges[8];
            $creditLtv->ltv_90_95 = $credit_ranges[9];
            $creditLtv->ltv_95_100 = $credit_ranges[10];
            $creditLtv->save();
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

    public function edit($id)
    {
        $lender = Lender::findOrFail($id);
        
        $credits = ['800_+', '780_-_799', '760_-_780', '740_-_759', '720_-_739', '700_-_719', '680_-_699', '660_-_679', '620_-_659', '580_-_619', 'less_than_580'];

        return view('pages.lenders.edit', compact('lender', 'credits'));
    }

    public function update(Request $request, $id)
    {
        $lender = Lender::findOrFail($id);
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
        for ($i = 0; $i < count($rates); $i++)  {
            $lender->rates()->delete();
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
            $lender->loanAmountAdjustments()->delete();
            $loanAmountData = new LoanAmountAdjustment();
            $loanAmountData->lender_id = $lender->id;
            $loanAmountData->loan_amount_low = $low[$i];
            $loanAmountData->loan_amount_high = $high[$i];
            $loanAmountData->adjustment = $adjustment[$i];
            $loanAmountData->save();
        }

        $creditAndLtvs = $lender->creditAndLtvs; // Dapatkan data sebelum menghapus
        $lender->creditAndLtvs()->delete(); // Hapus data yang ada

        foreach($creditAndLtvs as $credit){
            $credit_ranges = $request->input('credit_' . $credit->credit_range);
            
            $creditLtv = new CreditAndLtv();
            $creditLtv->lender_id = $lender->id;
            $creditLtv->credit_range = $credit->credit_range;
            $creditLtv->ltv_0_50 = $credit_ranges[0];
            $creditLtv->ltv_50_55 = $credit_ranges[1];
            $creditLtv->ltv_55_60 = $credit_ranges[2];
            $creditLtv->ltv_60_65 = $credit_ranges[3];
            $creditLtv->ltv_65_70 = $credit_ranges[4];
            $creditLtv->ltv_70_75 = $credit_ranges[5];
            $creditLtv->ltv_75_80 = $credit_ranges[6];
            $creditLtv->ltv_80_85 = $credit_ranges[7];
            $creditLtv->ltv_85_90 = $credit_ranges[8];
            $creditLtv->ltv_90_95 = $credit_ranges[9];
            $creditLtv->ltv_95_100 = $credit_ranges[10];
            $creditLtv->save();
        }

        $ficoLow = $request->input('fico_low');
        $ficoHigh = $request->input('fico_high');
        $ficoAdjustment = $request->input('fico_adjustment');
        for ($i = 0; $i < count($ficoLow); $i++)  {
            $lender->ficoAdjustments()->delete();
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
            $lender->additionalAdjustments()->delete();
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

    public function destroy($id)
    {
        $lender = Lender::findOrFail($id);
        $lender->delete();
        return redirect()->route('lenders.index')->with('success', 'Lender deleted successfully.');
    }
}
