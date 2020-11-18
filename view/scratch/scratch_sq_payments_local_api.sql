
if( isSet($ship_UPS_value) ) {
    $shipping = 30;
    $shipping_provider = 'UPS';
} else {
    $shipping: 0;
    $shipping_provider = 'USPS';
}

INSERT INTO `jmgaller_iesusa`.`product_order` 
(
    `product_customer_id`, 
    `product_id`, 
    `item`, 
    `notes`, 
    `quantity`, 
    `price`, 
    `tax`, 
    `shipping`, 
    `shipping_provider`, 
    `promo`, 
    `promo_amount`, 
    `invoice_number`,
    `deposit`,
    `sq_payment_id`,
    `sq_last4`,
    `sq_amount_money`,
    `sq_status`,
    `sq_order_id`,
    `sq_receipt_number`,
    `sq_receipt_url`
) 
VALUES 
(
    '{$customer_id}',
    '1'
    '{$item_pack}', 
    '{$comments}', 
    '1', 
    '{$price}', 
    '0', 
    '{$shipping}', 
    '{$shipping_provider}', 
    '{$promocode}', 
    '{$promo_amount}', 
    '{$invoice_no}'
    '{$deposit}',
    '{$sq_result->payment->id}',
    '{$sq_result->payment->card_details->card->last_4}',
    '{$sq_result->payment->amount_money->amount}',
    '{$sq_result->payment->status}',
    '{$sq_result->payment->order_id}',
    '{$sq_result->payment->receipt_number}',
    '{$sq_result->payment->receipt_url}'
);



    // Array
    // (
    //     [formType] => SquarePaymentForm
    //     [g-recaptcha-response] => 
    //     [refer_IP] => ::1
    //     [product_id] => 1
    //     [contactname] => Stephen McCarthy
    //     [contactemail] => hikerbikerwriter@gmail.com
    //     [promocode] => MAYFLOWERS
    //     [promo_amt] => 897.97
    //     [deposit] => true
    //     [edition] => Limited
    //     [title] => flying-fortress
    //     [size] => 20x30
    //     [price] => 1795.95
    //     [framing] => FRAMELESS
    //     [catalog_id] => AAP51LE
    //     [invoice_no] => 1605305215-AAP51LE
    //     [address] => 7582 Las Vegas Blvd S
    //     [address_other] => #611
    //     [city] => Las Vegas
    //     [state] => NV
    //     [postalcode] => 89123
    //     [phone] => 
    //     [ship_UPS_value] => 30
    //     [comments] => 
    //     [amount_total] => 10000
    //     [nonce] => cnon:CBASEHCDO_sbF0okFY9V9Jm9oOY
    // )
    // ajax_square_payment_local.php().start

n1BAYabeqkniQWrz7zUtUZNqjKKZYstdClass Object
(
    [payment] => stdClass Object
        (
            [id] => n1BAYabeqkniQWrz7zUtUZNqjKKZY
            [created_at] => 2020-11-13T22:37:00.960Z
            [updated_at] => 2020-11-13T22:37:01.126Z
            [amount_money] => stdClass Object
                (
                    [amount] => 10000
                    [currency] => USD
                )

            [total_money] => stdClass Object
                (
                    [amount] => 10000
                    [currency] => USD
                )

            [status] => COMPLETED
            [delay_duration] => PT168H
            [delay_action] => CANCEL
            [delayed_until] => 2020-11-20T22:37:00.960Z
            [source_type] => CARD
            [card_details] => stdClass Object
                (
                    [status] => CAPTURED
                    [card] => stdClass Object
                        (
                            [card_brand] => VISA
                            [last_4] => 1111
                            [exp_month] => 12
                            [exp_year] => 2021
                            [fingerprint] => sq-1-08PMp6FN6MPx6p96ug5ekyjJ9wVQA12lqUHP9s9eN3ylJy1OKzwZBj9Fx5bzgXrzlQ
                            [card_type] => CREDIT
                            [bin] => 411111
                        )

                    [entry_method] => KEYED
                    [cvv_status] => CVV_ACCEPTED
                    [avs_status] => AVS_ACCEPTED
                    [statement_description] => SQ *DEFAULT TEST ACCOUNT
                )

            [location_id] => L88JRPHQSAP21
            [order_id] => BtZjPzdMr8Of31v7ZKBYMjWi7g4F
            [receipt_number] => n1BA
            [receipt_url] => https://squareupsandbox.com/receipt/preview/n1BAYabeqkniQWrz7zUtUZNqjKKZY
        )

)




