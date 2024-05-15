<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Mail\RenewalNotification;
use App\Models\Client;
use App\Models\InvoiceSummary;
use App\Models\Ledger;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServicesController extends Controller
{
    public function index()
    {
        return view('admin.service.index');
    }

    public function renew()
    {
        return view('admin.service.renew');
    }

    public function renewalList()
    {
        $today = Carbon::today();

        // Calculate the date 10 days from now
        $tenDaysFromNow = $today->copy()->addDays(10);

        // Calculate the date 1 month from now
        $oneMonthFromNow = $today->copy()->addMonth();

        // Fetch data where expiry date is 10 days away for monthly renewals or 1 month away for yearly renewals
        $data = InvoiceSummary::where(function ($query) use ($today, $tenDaysFromNow, $oneMonthFromNow) {
            $query->where('renewType', 'monthly')
                ->where('expiry_date', '<=', $tenDaysFromNow);
        })
            ->orWhere(function ($query) use ($today, $oneMonthFromNow) {
                $query->where('renewType', 'yearly')
                    ->where('expiry_date', '<=', $oneMonthFromNow);
            })
            ->with(['invdetails', 'client', 'creator'])
            ->latest()
            ->get();



        return view('admin.invoice.renewal-list', compact('data'));
    }

    public function renewStore(Request $request)
    {

        $request->validate([
            'service_fee' => ['required', 'numeric'],
            'renewType' => ['required'],
            'id' => ['required'],
            'inv_id' => ['required'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        Ledger::create([
            'created_by' => auth()->user()->id,
            'inv_id' => $request->inv_id,
            'date' => $request->date,
            'payment_method' => 0,
            'income' => $request->service_fee,
            'type' => Status::Income,
        ]);

        $data = InvoiceSummary::where('id', $request->id)->first();
        $totalPaid = Ledger::where('inv_id', $request->inv_id)->sum('income');
        $status = $totalPaid >= $data->grand_total ? Status::Paid : Status::Partial;

        $expiry_date = Carbon::parse($data->expiry_date);
        $data->renewType = $request->renewType;
        if ($request->renewType == 'monthly') {
            $data->expiry_date = $expiry_date->addDays(30);
        } elseif ($request->renewType == 'yearly') {
            $data->expiry_date = $expiry_date->addYear();
        }
        $data->payment_status = $status;
        $data->save();

        Payment::create([
            'user_id' => $request->user_id,
            'inv_id' => $request->inv_id,
            'date' => $request->date,
            'paid_amount' => $request->service_fee,
            'payment_status' => Status::Paid,
        ]);

            $client = Client::findOrFail($data->client_id);
            $name = $client->name;
            $mobile = $client->mobile;
            $message = "Hello $name, Your Renewal Fee $request->service_fee TK is Stored Successfully.
                Best Regards,
                <br>
                Tizara Business Society";
                $token = "87991921371671024097ac42cd5523ff3df1c17197241b8bae52";

                // Call the sendSms function and store the result
                $smsResult = sendSms($mobile, $message, $token);

                $smsResults[] = [
                    'mobile' => $mobile,
                    'message' => $message,
                    'status' => $smsResult ? 'Success' : 'Failed',
                ];


        $data = [
            'id' => $request->id,
        ];

        return redirect()->route('Service.renewal.list')->with(['success', 'Renew Fee Collected Successfully', 'data'=>$data]);

    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:invoice_summaries,id'],
        ], [
            'id.required' => 'Please Check Atleast One Item or more',
        ]);

        $smsResults = [];

        foreach ($request->id as $id) {
            $invSummary = InvoiceSummary::findOrFail($id);
            $client = Client::findOrFail($invSummary->client_id);

            if ($request->type == 'sendmail' || $request->type == 'both') {
                Mail::to($client->email)->send(new RenewalNotification($client, $invSummary));
            }

            if ($request->type == 'sendsms' || $request->type == 'both') {
                $name = $client->name;
                $mobile = $client->mobile;
                $expired = $invSummary->expiry_date;
                $type = $invSummary->renewType;
                $fee = $invSummary->service_fee;
                $inv = $invSummary->inv_id;

                $message = "Hello $name, Your Service Date will be Expire $expired. Please Contact With Service Provider to Renew Your Service.
                <br>
                <ul>
                    <li>Invoice ID: $inv</li>
                    <li>Renewal Fee: $fee</li>
                    <li>Renewal Type: $type</li>
                </ul>
                <br>
                Best Regards,
                <br>
                Tizara Business Society";
                $token = "87991921371671024097ac42cd5523ff3df1c17197241b8bae52";

                // Call the sendSms function and store the result
                $smsResult = sendSms($mobile, $message, $token);

                // Store the SMS sending result in the array
                $smsResults[] = [
                    'mobile' => $mobile,
                    'message' => $message,
                    'status' => $smsResult ? 'Success' : 'Failed',
                ];
            }
        }

        if ($request->type == 'sendsms' || $request->type == 'both') {
            return redirect()->back()->with('success', 'SMS Sent Successfully');
        } else {
            return redirect()->back()->with('success', 'Emails Sent Successfully');
        }
    }


    // public function sendMessage(Request $request)
    // {
    //     $request->validate([
    //         'id' => ['required', 'exists:invoice_summaries,id'],
    //     ], [
    //         'id.required' => 'Please Check Atleast One Item or more',
    //     ]);

    //     if ($request->type == 'sendmail') {
    //         foreach ($request->id as $id) {
    //             $invSummary = InvoiceSummary::findOrFail($id); // Use findOrFail to automatically throw a 404 error if the invoice summary is not found
    //             $client = Client::findOrFail($invSummary->client_id); // Similarly for the client

    //             // Send email to the client using Laravel's built-in Mail facade
    //             // Example:
    //             Mail::to($client->email)->send(new RenewalNotification($client, $invSummary));
    //         }

    //         return redirect()->back()->with('success', 'Emails Sent Successfully');

    //     } elseif ($request->type == 'sendsms') {
    //         $smsResults = [];

    //         foreach ($request->id as $id) {
    //             $invSummary = InvoiceSummary::where('id', $id)->first();
    //             $client = Client::where('id', $invSummary->client_id)->first();

    //             if ($client) {
    //                 $name = $client->name;
    //                 $mobile = $client->mobile;
    //                 $expired = $invSummary->expiry_date;

    //                 $message = "Mr/Mrs $name, Your Service Date will be Expire $expired. Please Contact With Service Provider to Renew Your Service. Best Regard, Tizara Business Society"; // Modify this message accordingly
    //                 $token = "87991921371671024097ac42cd5523ff3df1c17197241b8bae52";

    //                 // Call the sendSms function and store the result
    //                 $smsResult = sendSms($mobile, $message, $token);

    //                 // Store the SMS sending result in the array
    //                 $smsResults[] = [
    //                     'mobile' => $mobile,
    //                     'message' => $message,
    //                     'status' => $smsResult ? 'Success' : 'Failed',
    //                 ];
    //             }
    //         }
    //         return redirect()->back()->with('success', 'SMS Sent Successfully');

    //     } elseif($request->type == 'both'){

    //     }

    // }

}
