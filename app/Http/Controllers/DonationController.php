<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class DonationController extends Controller
{
    protected $donationModel;

    public function __construct(Donation $donationModel)
    {
        $this->donationModel = $donationModel;
    }

    public function getAllDonations()
    {
        $donations = $this->donationModel->getAll();
        return view('donations', ['donations' => $donations]);
    }

    public function getDonationById($donationId)
    {
        $donation = $this->donationModel->getById($donationId);

        if (!$donation) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        return response()->json($donation);
    }

    public function createDonation(Request $request)
    {
        $request->validate([
            'orgId' => 'string', 
            'caption' => 'string',
            'description' => 'string',
            'dateStarted' => 'date',
            'dateEnded' => 'date',
            'targetAmount' => 'numeric',
            'gatheredAmount' => 'numeric',
        ]);


        $data = $request->all();
        $donationId = $this->donationModel->create($data);

        return response()->json(['message' => "Donation with ID $donationId created successfully"]);
    }

    public function updateDonation(Request $request, $donationId)
    {
        $request->validate([
            'orgId' => 'string', 
            'caption' => 'string',
            'description' => 'string',
            'dateStarted' => 'date',
            'dateEnded' => 'date',
            'targetAmount' => 'numeric',
            'gatheredAmount' => 'numeric',
        ]);

        $data = $request->all();
        $this->donationModel->updateDonation($donationId, $data);

        return response()->json(['message' => "Donation with ID $donationId updated successfully"]);
    }

    public function closeDonation($donationId)
    {
        try {
            $this->donationModel->updateDonationStatus($donationId, "false");

            return redirect()->route('donations')->with('success', 'Donation closed successfully');
        } catch (\Exception $e) {
            return redirect()->route('donations')->with('error', 'Failed to close the donation: ' . $e->getMessage());
        }
    }

    public function deleteDonation($donationId)
    {
        $this->donationModel->deleteDonation($donationId);

        return response()->json(['message' => "Donation with ID $donationId deleted successfully"]);
    }

}
