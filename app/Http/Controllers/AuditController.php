<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Tracking;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index() {
        $audits = Audit::with('tracking')->orderBy('id','desc')->simplePaginate(10);

        return view('audits.index', [
            'audits' => $audits
        ]);
    }

    public function create() {
        return view('audits.create');
    }

    public function show(Audit $audit) {
        return view('audits.show', ['audit' => $audit]);
    }

    public function store(Request $request) {
        // Get the submitted data from the textarea
        $data = trim($request->input('audit_data'));
    
        // Split the data by line breaks
        $lines = explode("\n", $data);
    
        // Ensure at least 5 lines are entered
        if (count($lines) < 5) {
            return redirect()->back()->with('error', 'Invalid input. Please enter all required fields.');
        }
    
        // Extract values
        $tracking = trim($lines[0]);
        $serial = trim($lines[1]);
        $basket = trim($lines[2]);
        $productControl = trim($lines[3]);
        $title = trim($lines[4]);
    
        // Validate tracking number (at least 12 characters)
        if (strlen($tracking) < 12) {
            return redirect()->back()->with('error', 'Tracking number must be at least 12 characters.');
        }
    
        // Find existing tracking records that end with the provided 12-digit tracking string
        $trackingRecord = Tracking::where('tracking_no', 'like', '%' . $tracking)->first();
    
        if ($trackingRecord) {
            // If a matching tracking number is found, auto-populate data from tracking record
            $audit = Audit::where('tracking_id', $trackingRecord->id)->first();
    
            if ($audit) {
                // If audit exists, update it
                $audit->serial_no = $serial;
                $audit->basket_no = $basket;
                $audit->product_control_no = $productControl;
                $audit->title = $title;
                $audit->save();
    
                return redirect('/audits')->with('success', 'Audit updated successfully!');
            } else {
                // If audit doesn't exist, create a new audit record
                $audit = new Audit();
                $audit->title = $title;
                $audit->product_control_no = $productControl;
                $audit->basket_no = $basket;
                $audit->serial_no = $serial;
                $audit->tracking_id = $trackingRecord->id;
                $audit->save();
    
                return redirect('/audits')->with('success', 'Audit created successfully!');
            }
        } else {
            // If no matching tracking number is found, create a new tracking number
            // Generate 22 random digits as a string
            $randomDigits = '';
            $trackingdiff = 34 - strlen($tracking);
            for ($i = 0; $i < $trackingdiff; $i++) {
                $randomDigits .= rand(0, 9);  // Append a random number (0-9) to the string
            }
            
            // Combine the random digits with the provided 12-digit string
            $newTrackingNo = $randomDigits . $tracking;
    
            // Create new tracking record
            $trackingRecord = new Tracking();
            $trackingRecord->tracking_no = $newTrackingNo;
            $trackingRecord->save();
    
            // Create new audit record with the new tracking ID
            $audit = new Audit();
            $audit->title = $title;
            $audit->product_control_no = $productControl;
            $audit->basket_no = $basket;
            $audit->serial_no = $serial;
            $audit->tracking_id = $trackingRecord->id;
            $audit->save();
    
            return redirect('/audits')->with('success', 'Audit created successfully with new tracking number!');
        }
    }

    public function edit(Audit $audit) {
        return view('audits.edit', ['audit' => $audit]);
    }

    public function update(Audit $audit) {
        // Validate incoming request data
        request()->validate([
            'title' => ['required'],
            'product_control_no' => ['required'],
            'basket_no' => ['required'],
            'serial_no' => ['required'],
            'tracking_no' => ['required'],
        ]);
    
        // Find the tracking record by tracking_no
        $tracking = Tracking::where('tracking_no', request('tracking_no'))->first();
    
        if (!$tracking) {
            // If tracking number doesn't exist, return with an error
            return redirect()->back()->with('error', 'Tracking number not found.');
        }
    
        // Update the audit record with the new data
        $audit->update([
            'title' => request('title'),
            'product_control_no' => request('product_control_no'),
            'basket_no' => request('basket_no'),
            'serial_no' => request('serial_no'),
            'tracking_id' => $tracking->id, // Update the tracking_id in the audit
        ]);
    
        // Return to the audits page with a success message
        return redirect('/audits')->with('success', 'Audit updated successfully!');
    }

    public function destroy(Audit $audit) {
    }
}
