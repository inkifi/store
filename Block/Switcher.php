<?php
namespace Inkifi\Store\Block;
use Magento\Directory\Model\Currency as C;
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
	 * @param bool $title [optional]
	 * @return string
	 */
	final function cur(S $s, $title = false) {$c = $s->getDefaultCurrency(); /** @var C $c */ return df_cc_n(
		$title ? null : df_tag('div', 'currency-item currency-name',
			df_trim_text_right(df_currency_name($c), ' Sterling')
		)
		,df_tag('div', 'currency-subtitle', df_cc_n(
			df_tag('span', 'currency-item currency-symbol', $c->getCurrencySymbol())
			,df_tag('span', 'currency-item currency-code', $c->getCode())
		))
	);}

	/**
	 * 2018-09-17
	 * @param S $s
	 * @return string
	 */
	final function post(S $s) {return df_post_h()->getPostData(
		$this->getUrl('stores/store/switch'), [IStoreResolver::PARAM_NAME => $s->getCode()]
	);}
}