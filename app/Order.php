<?php

namespace App;

class Order {
	/**
	 * Order Details Array
	 * @var array
	 * Values =>
	 * ['delivery-postcode']
	 * ['delivery-first-name']
	 * ['delivery-last-name']
	 * ['delivery-address-line-1']
	 * ['delivery-address-line-2']
	 * ['delivery-town-city']
	 * ['delivery-country']
	 * ['delivery-phone']
	 * ['delivery-email']
	 * ['billing-address-same']
	 * ['billing-postcode']
	 * ['billing-first-name']
	 * ['billing-last-name']
	 * ['billing-address-line-1']
	 * ['billing-address-line-2']
	 * ['billing-town-city']
	 * ['billing-country']
	 * ['billing-phone']
	 * ['billing-email']
	 * ['delivery-type']
	 */
	private $orderDetails = array();

	/**
	 * Constructor Function
	 * @param array $orderDetails The order details form in array format
	 */
	function __construct($orderDetails=array())
	{
		$this->orderDetails = $orderDetails;
	}

	/**
	 * Returns a detail from the order details array
	 * @param  string $detail an order detail (e.g. "delivery-postcode")
	 * @return string        the order detail
	 */
	function getOrderDetail($detail) {
		return $this->orderDetails[$detail];
	}

	/**
	 * Returns the order details array
	 * @return array OrderDetails
	 */
	function getOrderDetails() {
		return $this->orderDetails;
	}

	/**
	 * Returns the delivery details in HTML format
	 * @return string Delivery Details HTML Format
	 */
	function getDeliveryDetailsHtml() {
		$deliveryDetailsHtml = "";
		$orderDetails = $this->getOrderDetails();

		$deliveryDetailsHtml .= "<p>" . $orderDetails['delivery-first-name'] . 
						          " " . $orderDetails['delivery-last-name'] . "</p>";
		$deliveryDetailsHtml .= "<p>" . $orderDetails['delivery-address-line-1'] . "</p>";
		$deliveryDetailsHtml .= "<p>" . $orderDetails['delivery-address-line-2'] . "</p>";
		$deliveryDetailsHtml .= "<p>" . $orderDetails['delivery-town-city'] . "</p>";
		$deliveryDetailsHtml .= "<p>" . $orderDetails['delivery-postcode'] . "</p>";
		$deliveryDetailsHtml .= "<p>" . $orderDetails['delivery-country'] . "</p>";

		return $deliveryDetailsHtml;
	}

	/**
	 * Returns the delivery contact details in HTML format
	 * @return string Delivery Contact Details HTML Format
	 */
	function getDeliveryContactDetailsHtml() {
		$deliveryContactDetails = "";
		$orderDetails = $this->getOrderDetails();

		$deliveryContactDetails .= "<p>" . $orderDetails['delivery-email'] . "</p>";
		$deliveryContactDetails .= "<p>" . $orderDetails['delivery-phone'] . "</p>";

		return $deliveryContactDetails;
	}

	/**
	 * Returns the billing address details in HTML format
	 * @return string Billing Address Details HTML Format
	 */
	function getBillingDetailsHtml() {
		$billingDetailsHtml = "";
		$orderDetails = $this->getOrderDetails();

		$billingDetailsHtml .= "<p>" . $orderDetails['billing-first-name'] . 
						          " " . $orderDetails['billing-last-name'] . "</p>";
		$billingDetailsHtml .= "<p>" . $orderDetails['billing-address-line-1'] . "</p>";
		$billingDetailsHtml .= "<p>" . $orderDetails['billing-address-line-2'] . "</p>";
		$billingDetailsHtml .= "<p>" . $orderDetails['billing-town-city'] . "</p>";
		$billingDetailsHtml .= "<p>" . $orderDetails['billing-postcode'] . "</p>";
		$billingDetailsHtml .= "<p>" . $orderDetails['billing-country'] . "</p>";

		return $billingDetailsHtml;
	}

	/**
	 * Returns the billing contact details in HTML format
	 * @return string Billing Contact Details HTML Format
	 */
	function getBillingContactDetailsHtml() {
		$billingContactDetails = "";
		$orderDetails = $this->getOrderDetails();

		$billingContactDetails .= "<p>" . $orderDetails['billing-email'] . "</p>";
		$billingContactDetails .= "<p>" . $orderDetails['billing-phone'] . "</p>";

		return $billingContactDetails;
	}

	/**
	 * Creates a new order
	 * @return [type] [description]
	 */
	public function createNewOrder() {

	}

}