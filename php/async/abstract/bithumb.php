<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bithumb extends \ccxt\async\Exchange {
    public function public_get_ticker_all_quoteid($params = array()) {
        return $this->request('ticker/ALL_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_ticker_baseid_quoteid($params = array()) {
        return $this->request('ticker/{baseId}_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_orderbook_all_quoteid($params = array()) {
        return $this->request('orderbook/ALL_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_orderbook_baseid_quoteid($params = array()) {
        return $this->request('orderbook/{baseId}_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_transaction_history_baseid_quoteid($params = array()) {
        return $this->request('transaction_history/{baseId}_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_network_info($params = array()) {
        return $this->request('network-info', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_assetsstatus_multichain_all($params = array()) {
        return $this->request('assetsstatus/multichain/ALL', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_assetsstatus_multichain_currency($params = array()) {
        return $this->request('assetsstatus/multichain/{currency}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_withdraw_minimum_all($params = array()) {
        return $this->request('withdraw/minimum/ALL', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_withdraw_minimum_currency($params = array()) {
        return $this->request('withdraw/minimum/{currency}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_assetsstatus_all($params = array()) {
        return $this->request('assetsstatus/ALL', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_assetsstatus_baseid($params = array()) {
        return $this->request('assetsstatus/{baseId}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_candlestick_baseid_quoteid_interval($params = array()) {
        return $this->request('candlestick/{baseId}_{quoteId}/{interval}', 'public', 'GET', $params, null, null, array());
    }
    public function private_post_info_account($params = array()) {
        return $this->request('info/account', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_info_balance($params = array()) {
        return $this->request('info/balance', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_info_wallet_address($params = array()) {
        return $this->request('info/wallet_address', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_info_ticker($params = array()) {
        return $this->request('info/ticker', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_info_orders($params = array()) {
        return $this->request('info/orders', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_info_user_transactions($params = array()) {
        return $this->request('info/user_transactions', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_info_order_detail($params = array()) {
        return $this->request('info/order_detail', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_place($params = array()) {
        return $this->request('trade/place', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_cancel($params = array()) {
        return $this->request('trade/cancel', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_btc_withdrawal($params = array()) {
        return $this->request('trade/btc_withdrawal', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_krw_deposit($params = array()) {
        return $this->request('trade/krw_deposit', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_krw_withdrawal($params = array()) {
        return $this->request('trade/krw_withdrawal', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_market_buy($params = array()) {
        return $this->request('trade/market_buy', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_market_sell($params = array()) {
        return $this->request('trade/market_sell', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_trade_stop_limit($params = array()) {
        return $this->request('trade/stop_limit', 'private', 'POST', $params, null, null, array());
    }
    public function publicGetTickerALLQuoteId($params = array()) {
        return $this->request('ticker/ALL_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTickerBaseIdQuoteId($params = array()) {
        return $this->request('ticker/{baseId}_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetOrderbookALLQuoteId($params = array()) {
        return $this->request('orderbook/ALL_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetOrderbookBaseIdQuoteId($params = array()) {
        return $this->request('orderbook/{baseId}_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTransactionHistoryBaseIdQuoteId($params = array()) {
        return $this->request('transaction_history/{baseId}_{quoteId}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetNetworkInfo($params = array()) {
        return $this->request('network-info', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetAssetsstatusMultichainALL($params = array()) {
        return $this->request('assetsstatus/multichain/ALL', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetAssetsstatusMultichainCurrency($params = array()) {
        return $this->request('assetsstatus/multichain/{currency}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetWithdrawMinimumALL($params = array()) {
        return $this->request('withdraw/minimum/ALL', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetWithdrawMinimumCurrency($params = array()) {
        return $this->request('withdraw/minimum/{currency}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetAssetsstatusALL($params = array()) {
        return $this->request('assetsstatus/ALL', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetAssetsstatusBaseId($params = array()) {
        return $this->request('assetsstatus/{baseId}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetCandlestickBaseIdQuoteIdInterval($params = array()) {
        return $this->request('candlestick/{baseId}_{quoteId}/{interval}', 'public', 'GET', $params, null, null, array());
    }
    public function privatePostInfoAccount($params = array()) {
        return $this->request('info/account', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostInfoBalance($params = array()) {
        return $this->request('info/balance', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostInfoWalletAddress($params = array()) {
        return $this->request('info/wallet_address', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostInfoTicker($params = array()) {
        return $this->request('info/ticker', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostInfoOrders($params = array()) {
        return $this->request('info/orders', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostInfoUserTransactions($params = array()) {
        return $this->request('info/user_transactions', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostInfoOrderDetail($params = array()) {
        return $this->request('info/order_detail', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradePlace($params = array()) {
        return $this->request('trade/place', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeCancel($params = array()) {
        return $this->request('trade/cancel', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeBtcWithdrawal($params = array()) {
        return $this->request('trade/btc_withdrawal', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeKrwDeposit($params = array()) {
        return $this->request('trade/krw_deposit', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeKrwWithdrawal($params = array()) {
        return $this->request('trade/krw_withdrawal', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeMarketBuy($params = array()) {
        return $this->request('trade/market_buy', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeMarketSell($params = array()) {
        return $this->request('trade/market_sell', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostTradeStopLimit($params = array()) {
        return $this->request('trade/stop_limit', 'private', 'POST', $params, null, null, array());
    }
}