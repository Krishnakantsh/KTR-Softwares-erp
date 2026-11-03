<?php

namespace App\Services\Subscription;

use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionInvoice;
use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    // generate
    public function generate(
        TenantSubscription $subscription,
        array $data
    ): SubscriptionInvoice {

        return DB::transaction(function () use ($subscription, $data) {

            $invoice = SubscriptionInvoice::create([

                'tenant_id' => $subscription->tenant_id,

                'tenant_subscription_id' => $subscription->id,

                'invoice_no' => $this->generateInvoiceNumber(),

                'invoice_date' => now()->toDateString(),

                'due_date' => $data['due_date'] ?? now()->addDays(7),

                'billing_period_from' => $subscription->start_date,

                'billing_period_to' => $subscription->end_date,

                'subtotal' => $subscription->amount,

                'discount_amount' => $subscription->discount,

                'tax_amount' => $subscription->tax,

                'grand_total' => $subscription->final_amount,

                'paid_amount' => 0,

                'due_amount' => $subscription->final_amount,

                'invoice_type' => $data['invoice_type'],

                'payment_status' => 'pending',

                'status' => 'generated',

                'remarks' => $data['remarks'] ?? null,

            ]);

            return $invoice;
        });
    }

    // invoice number
    public function generateInvoiceNumber(): string
    {
        $last = SubscriptionInvoice::latest('id')->first();

        $number = $last ? $last->id + 1 : 1;

        return 'INV-' . date('Y') . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }

    // paid
    public function markPaid(
        SubscriptionInvoice $invoice,
        float $amount
    ): SubscriptionInvoice {

        $invoice->update([

            'paid_amount' => $amount,

            'due_amount' => 0,

            'payment_status' => 'paid',

        ]);

        return $invoice->fresh();
    }

    // partial
    public function markPartial(
        SubscriptionInvoice $invoice,
        float $amount
    ): SubscriptionInvoice {

        $paid = $invoice->paid_amount + $amount;

        $invoice->update([

            'paid_amount' => $paid,

            'due_amount' => $invoice->grand_total - $paid,

            'payment_status' => 'partial',

        ]);

        return $invoice->fresh();
    }

    // failed
    public function markFailed(
        SubscriptionInvoice $invoice
    ): SubscriptionInvoice {

        $invoice->update([

            'payment_status' => 'failed',

        ]);

        return $invoice->fresh();
    }

    // cancel
    public function cancel(
        SubscriptionInvoice $invoice,
        $remarks = null
    ): SubscriptionInvoice {

        $invoice->update([

            'status' => 'cancelled',

            'remarks' => $remarks,

        ]);

        return $invoice->fresh();
    }

    // pending
    public function pending()
    {
        return SubscriptionInvoice::where(
            'payment_status',
            'pending'
        )->latest()->get();
    }

    // paid invoices
    public function paid()
    {
        return SubscriptionInvoice::where(
            'payment_status',
            'paid'
        )->latest()->get();
    }

    // overdue
    public function overdue()
    {
        return SubscriptionInvoice::whereDate(
            'due_date',
            '<',
            Carbon::today()
        )
            ->where('payment_status', '!=', 'paid')
            ->latest()
            ->get();
    }

    // by tenant
    public function tenantInvoices($tenantId)
    {
        return SubscriptionInvoice::where(
            'tenant_id',
            $tenantId
        )->latest()->get();
    }

    // generate pdf
    public function generatePdf(
        SubscriptionInvoice $invoice
    ): string {

        $pdf = Pdf::loadView(
            'pdf.subscription-invoice',
            [
                'invoice' => $invoice
            ]
        );

        $fileName = $invoice->invoice_no . '.pdf';

        $path = 'invoices/' . $fileName;

        Storage::disk('public')->put(
            $path,
            $pdf->output()
        );

        return $path;
    }

    // store pdf
    public function storePdf(
        SubscriptionInvoice $invoice
    ): string {

        return $this->generatePdf($invoice);
    }

    // download
    public function download(
        SubscriptionInvoice $invoice
    ) {

        $pdf = Pdf::loadView(
            'pdf.subscription-invoice',
            [
                'invoice' => $invoice
            ]
        );

        return $pdf->download(
            $invoice->invoice_no . '.pdf'
        );
    }

    // delete pdf
    public function deletePdf(
        SubscriptionInvoice $invoice
    ): bool {

        $file = 'invoices/' . $invoice->invoice_no . '.pdf';

        if (
            Storage::disk('public')->exists($file)
        ) {

            Storage::disk('public')->delete($file);

            return true;
        }

        return false;
    }

    // send mail
    public function sendMail(
        SubscriptionInvoice $invoice,
        string $email
    ): bool {

        $path = $this->generatePdf($invoice);

        Mail::send(
            [],
            [],
            function ($message) use (
                $invoice,
                $email,
                $path
            ) {

                $message->to($email)

                    ->subject(
                        'Invoice ' . $invoice->invoice_no
                    )

                    ->html(
                        '<h3>Your invoice is attached.</h3>'
                    )

                    ->attach(
                        storage_path(
                            'app/public/' . $path
                        )
                    );
            }
        );

        return true;
    }

    // regenerate pdf
    public function regeneratePdf(
        SubscriptionInvoice $invoice
    ): string {

        $this->deletePdf($invoice);

        return $this->generatePdf($invoice);
    }

    // invoice path
    public function getPdfPath(
        SubscriptionInvoice $invoice
    ): string {

        return storage_path(
            'app/public/invoices/' .
                $invoice->invoice_no .
                '.pdf'
        );
    }

    // invoice exists
    public function pdfExists(
        SubscriptionInvoice $invoice
    ): bool {

        return Storage::disk('public')->exists(
            'invoices/' . $invoice->invoice_no . '.pdf'
        );
    }
}
