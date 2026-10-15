<?php

namespace App\Services\Subscription;

use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionInvoice;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPayment;
use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use App\Notifications\InvoiceGeneratedNotification;
use App\Notifications\PaymentFailedNotification;
use App\Notifications\PaymentSuccessNotification;
use App\Notifications\RenewalReminderNotification;
use App\Notifications\SubscriptionExpiredNotification;
use App\Notifications\TrialEndingNotification;

class SubscriptionNotificationService
{

    // trial ending
    public function sendTrialEnding(
        TenantSubscription $subscription
    ): bool {

        if (!$subscription->tenant) {
            return false;
        }

        $subscription->tenant->notify(

            new TrialEndingNotification(
                $subscription
            )

        );

        return true;
    }

    // subscription expired
    public function sendSubscriptionExpired(
        TenantSubscription $subscription
    ): bool {

        if (!$subscription->tenant) {
            return false;
        }

        $subscription->tenant->notify(

            new SubscriptionExpiredNotification(
                $subscription
            )

        );

        return true;
    }

    // renewal reminder
    public function sendRenewalReminder(
        TenantSubscription $subscription
    ): bool {

        if (!$subscription->tenant) {
            return false;
        }

        $subscription->tenant->notify(

            new RenewalReminderNotification(
                $subscription
            )

        );

        return true;
    }

    // payment success
    public function sendPaymentSuccess(
        SubscriptionPayment $payment
    ): bool {

        if (!$payment->tenant) {
            return false;
        }

        $payment->tenant->notify(

            new PaymentSuccessNotification(
                $payment
            )

        );

        return true;
    }

    // payment failed
    public function sendPaymentFailed(
        SubscriptionPayment $payment
    ): bool {

        if (!$payment->tenant) {
            return false;
        }

        $payment->tenant->notify(

            new PaymentFailedNotification(
                $payment
            )

        );

        return true;
    }


    // invoice generated
    public function sendInvoice(
        SubscriptionInvoice $invoice
    ): bool {

        if (!$invoice->tenant) {
            return false;
        }

        $invoice->tenant->notify(

            new InvoiceGeneratedNotification(
                $invoice
            )

        );

        return true;
    }

    // bulk reminder
    public function sendBulkRenewalReminder(
        $subscriptions
    ): void {

        foreach ($subscriptions as $subscription) {

            $this->sendRenewalReminder(
                $subscription
            );
        }
    }

    // bulk trial
    public function sendBulkTrialEnding(
        $subscriptions
    ): void {

        foreach ($subscriptions as $subscription) {

            $this->sendTrialEnding(
                $subscription
            );
        }
    }

    // bulk expired
    public function sendBulkExpired(
        $subscriptions
    ): void {

        foreach ($subscriptions as $subscription) {

            $this->sendSubscriptionExpired(
                $subscription
            );
        }
    }
}
