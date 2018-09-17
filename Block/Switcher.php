<?php
namespace Inkifi\Store\Block;
use Magento\Framework\View\Element\Template as _P;
use Magento\Store\Api\StoreResolverInterface as IStoreResolver;
use Magento\Store\Model\Store as S;
/**
 * 2018-09-17
 * «Implement the store/currency switcher as in publicdesire.com»:
 * https://github.com/inkifi/store/issues/1
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 */
class Switcher extends _P {
	/**
	 * 2018-09-17
	 * @param S $s
	 * @return string
	 */
	final function name(S $s) {return $this->escapeHtml(dftr($s->getCode(), $this->map()));}

	/**
	 * 2018-09-17
	 * @param S $s
	 * @return string
	 */
	final function post(S $s) {return df_post_h()->getPostData(
		$this->getUrl('stores/store/switch'), [IStoreResolver::PARAM_NAME => $s->getCode()]
	);}

	/**
	 * 2018-09-17
	 * @used-by name()
	 * @return array(string => array(string => string))
	 */
	private function map() {return dfc($this, function() {return dftr(df_lang(), [
		'en' => ['in' => 'India', 'uk' => 'United Kingdom', 'us' => 'United States']
	]);});}
}