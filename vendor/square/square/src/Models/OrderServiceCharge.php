<?php

declare(strict_types=1);

namespace Square\Models;

/**
 * Represents a service charge applied to an order.
 */
class OrderServiceCharge implements \JsonSerializable
{
    /**
     * @var string|null
     */
    private $uid;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $catalogObjectId;

    /**
     * @var string|null
     */
    private $percentage;

    /**
     * @var Money|null
     */
    private $amountMoney;

    /**
     * @var Money|null
     */
    private $appliedMoney;

    /**
     * @var Money|null
     */
    private $totalMoney;

    /**
     * @var Money|null
     */
    private $totalTaxMoney;

    /**
     * @var string|null
     */
    private $calculationPhase;

    /**
     * @var bool|null
     */
    private $taxable;

    /**
     * @var OrderLineItemAppliedTax[]|null
     */
    private $appliedTaxes;

    /**
     * @var array|null
     */
    private $metadata;

    /**
     * Returns Uid.
     *
     * Unique ID that identifies the service charge only within this order.
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * Sets Uid.
     *
     * Unique ID that identifies the service charge only within this order.
     *
     * @maps uid
     */
    public function setUid(?string $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * Returns Name.
     *
     * The name of the service charge.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets Name.
     *
     * The name of the service charge.
     *
     * @maps name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns Catalog Object Id.
     *
     * The catalog object ID referencing the service charge [CatalogObject](#type-catalogobject).
     */
    public function getCatalogObjectId(): ?string
    {
        return $this->catalogObjectId;
    }

    /**
     * Sets Catalog Object Id.
     *
     * The catalog object ID referencing the service charge [CatalogObject](#type-catalogobject).
     *
     * @maps catalog_object_id
     */
    public function setCatalogObjectId(?string $catalogObjectId): void
    {
        $this->catalogObjectId = $catalogObjectId;
    }

    /**
     * Returns Percentage.
     *
     * The service charge percentage as a string representation of a
     * decimal number. For example, `"7.25"` indicates a service charge of 7.25%.
     *
     * Exactly 1 of `percentage` or `amount_money` should be set.
     */
    public function getPercentage(): ?string
    {
        return $this->percentage;
    }

    /**
     * Sets Percentage.
     *
     * The service charge percentage as a string representation of a
     * decimal number. For example, `"7.25"` indicates a service charge of 7.25%.
     *
     * Exactly 1 of `percentage` or `amount_money` should be set.
     *
     * @maps percentage
     */
    public function setPercentage(?string $percentage): void
    {
        $this->percentage = $percentage;
    }

    /**
     * Returns Amount Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     */
    public function getAmountMoney(): ?Money
    {
        return $this->amountMoney;
    }

    /**
     * Sets Amount Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     *
     * @maps amount_money
     */
    public function setAmountMoney(?Money $amountMoney): void
    {
        $this->amountMoney = $amountMoney;
    }

    /**
     * Returns Applied Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     */
    public function getAppliedMoney(): ?Money
    {
        return $this->appliedMoney;
    }

    /**
     * Sets Applied Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     *
     * @maps applied_money
     */
    public function setAppliedMoney(?Money $appliedMoney): void
    {
        $this->appliedMoney = $appliedMoney;
    }

    /**
     * Returns Total Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     */
    public function getTotalMoney(): ?Money
    {
        return $this->totalMoney;
    }

    /**
     * Sets Total Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     *
     * @maps total_money
     */
    public function setTotalMoney(?Money $totalMoney): void
    {
        $this->totalMoney = $totalMoney;
    }

    /**
     * Returns Total Tax Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     */
    public function getTotalTaxMoney(): ?Money
    {
        return $this->totalTaxMoney;
    }

    /**
     * Sets Total Tax Money.
     *
     * Represents an amount of money. `Money` fields can be signed or unsigned.
     * Fields that do not explicitly define whether they are signed or unsigned are
     * considered unsigned and can only hold positive amounts. For signed fields, the
     * sign of the value indicates the purpose of the money transfer. See
     * [Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-
     * monetary-amounts)
     * for more information.
     *
     * @maps total_tax_money
     */
    public function setTotalTaxMoney(?Money $totalTaxMoney): void
    {
        $this->totalTaxMoney = $totalTaxMoney;
    }

    /**
     * Returns Calculation Phase.
     *
     * Represents a phase in the process of calculating order totals.
     * Service charges are applied __after__ the indicated phase.
     *
     * [Read more about how order totals are calculated.](https://developer.squareup.com/docs/docs/orders-
     * api/how-it-works#how-totals-are-calculated)
     */
    public function getCalculationPhase(): ?string
    {
        return $this->calculationPhase;
    }

    /**
     * Sets Calculation Phase.
     *
     * Represents a phase in the process of calculating order totals.
     * Service charges are applied __after__ the indicated phase.
     *
     * [Read more about how order totals are calculated.](https://developer.squareup.com/docs/docs/orders-
     * api/how-it-works#how-totals-are-calculated)
     *
     * @maps calculation_phase
     */
    public function setCalculationPhase(?string $calculationPhase): void
    {
        $this->calculationPhase = $calculationPhase;
    }

    /**
     * Returns Taxable.
     *
     * Indicates whether the service charge can be taxed. If set to `true`,
     * order-level taxes automatically apply to the service charge. Note that
     * service charges calculated in the `TOTAL_PHASE` cannot be marked as taxable.
     */
    public function getTaxable(): ?bool
    {
        return $this->taxable;
    }

    /**
     * Sets Taxable.
     *
     * Indicates whether the service charge can be taxed. If set to `true`,
     * order-level taxes automatically apply to the service charge. Note that
     * service charges calculated in the `TOTAL_PHASE` cannot be marked as taxable.
     *
     * @maps taxable
     */
    public function setTaxable(?bool $taxable): void
    {
        $this->taxable = $taxable;
    }

    /**
     * Returns Applied Taxes.
     *
     * The list of references to taxes applied to this service charge. Each
     * `OrderLineItemAppliedTax` has a `tax_uid` that references the `uid` of a top-level
     * `OrderLineItemTax` that is being applied to this service charge. On reads, the amount applied
     * is populated.
     *
     * An `OrderLineItemAppliedTax` will be automatically created on every taxable service charge
     * for all `ORDER` scoped taxes that are added to the order. `OrderLineItemAppliedTax` records
     * for `LINE_ITEM` scoped taxes must be added in requests for the tax to apply to any taxable
     * service charge.  Taxable service charges have the `taxable` field set to true and calculated
     * in the `SUBTOTAL_PHASE`.
     *
     * To change the amount of a tax, modify the referenced top-level tax.
     *
     * @return OrderLineItemAppliedTax[]|null
     */
    public function getAppliedTaxes(): ?array
    {
        return $this->appliedTaxes;
    }

    /**
     * Sets Applied Taxes.
     *
     * The list of references to taxes applied to this service charge. Each
     * `OrderLineItemAppliedTax` has a `tax_uid` that references the `uid` of a top-level
     * `OrderLineItemTax` that is being applied to this service charge. On reads, the amount applied
     * is populated.
     *
     * An `OrderLineItemAppliedTax` will be automatically created on every taxable service charge
     * for all `ORDER` scoped taxes that are added to the order. `OrderLineItemAppliedTax` records
     * for `LINE_ITEM` scoped taxes must be added in requests for the tax to apply to any taxable
     * service charge.  Taxable service charges have the `taxable` field set to true and calculated
     * in the `SUBTOTAL_PHASE`.
     *
     * To change the amount of a tax, modify the referenced top-level tax.
     *
     * @maps applied_taxes
     *
     * @param OrderLineItemAppliedTax[]|null $appliedTaxes
     */
    public function setAppliedTaxes(?array $appliedTaxes): void
    {
        $this->appliedTaxes = $appliedTaxes;
    }

    /**
     * Returns Metadata.
     *
     * Application-defined data attached to this service charge. Metadata fields are intended
     * to store descriptive references or associations with an entity in another system or store brief
     * information about the object. Square does not process this field; it only stores and returns it
     * in relevant API calls. Do not use metadata to store any sensitive information (personally
     * identifiable information, card details, etc.).
     *
     * Keys written by applications must be 60 characters or less and must be in the character set
     * `[a-zA-Z0-9_-]`. Entries may also include metadata generated by Square. These keys are prefixed
     * with a namespace, separated from the key with a ':' character.
     *
     * Values have a max length of 255 characters.
     *
     * An application may have up to 10 entries per metadata field.
     *
     * Entries written by applications are private and can only be read or modified by the same
     * application.
     *
     * See [Metadata](https://developer.squareup.com/docs/build-basics/metadata) for more information.
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * Sets Metadata.
     *
     * Application-defined data attached to this service charge. Metadata fields are intended
     * to store descriptive references or associations with an entity in another system or store brief
     * information about the object. Square does not process this field; it only stores and returns it
     * in relevant API calls. Do not use metadata to store any sensitive information (personally
     * identifiable information, card details, etc.).
     *
     * Keys written by applications must be 60 characters or less and must be in the character set
     * `[a-zA-Z0-9_-]`. Entries may also include metadata generated by Square. These keys are prefixed
     * with a namespace, separated from the key with a ':' character.
     *
     * Values have a max length of 255 characters.
     *
     * An application may have up to 10 entries per metadata field.
     *
     * Entries written by applications are private and can only be read or modified by the same
     * application.
     *
     * See [Metadata](https://developer.squareup.com/docs/build-basics/metadata) for more information.
     *
     * @maps metadata
     */
    public function setMetadata(?array $metadata): void
    {
        $this->metadata = $metadata;
    }

    /**
     * Encode this object to JSON
     *
     * @return mixed
     */
    public function jsonSerialize()
    {
        $json = [];
        $json['uid']              = $this->uid;
        $json['name']             = $this->name;
        $json['catalog_object_id'] = $this->catalogObjectId;
        $json['percentage']       = $this->percentage;
        $json['amount_money']     = $this->amountMoney;
        $json['applied_money']    = $this->appliedMoney;
        $json['total_money']      = $this->totalMoney;
        $json['total_tax_money']  = $this->totalTaxMoney;
        $json['calculation_phase'] = $this->calculationPhase;
        $json['taxable']          = $this->taxable;
        $json['applied_taxes']    = $this->appliedTaxes;
        $json['metadata']         = $this->metadata;

        return array_filter($json, function ($val) {
            return $val !== null;
        });
    }
}
