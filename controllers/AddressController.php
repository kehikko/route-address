<?php

class AddressController extends \Core\Controller
{
	public function postcodeSearchFormAction($options = null)
	{
		$params               = array();
		$params['random_id']  = \Core\Compose::unique();
		$params['search_max'] = 10;
		$params['postcodes']  = \Address\Postcodes::find('FI');
		$params['options']    = $options;

		return $this->display('postcode-search.html', $params);
	}

	public function postcodeSearchAction($country_code, $postcode)
	{
		$postcodes = \Address\Postcodes::find($country_code, $postcode);
		$data = array();
		foreach ($postcodes as $postcode)
		{
			$data[] = array(
				'postcode' => $postcode->getPostcode(),
				'locality' => $postcode->getLocality(),
				'city' => $postcode->getCity(),
				'state' => $postcode->getState(),
				'country_code' => $postcode->getCountryCode(),
			);
		}
		return $this->display(null, $data);
	}
}
