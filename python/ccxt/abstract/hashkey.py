from ccxt.base.types import Entry


class ImplicitAPI:
    public_get_api_v1_exchangeinfo = publicGetApiV1ExchangeInfo = Entry('api/v1/exchangeInfo', 'public', 'GET', {'cost': 5})
    public_get_quote_v1_depth = publicGetQuoteV1Depth = Entry('quote/v1/depth', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_trades = publicGetQuoteV1Trades = Entry('quote/v1/trades', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_klines = publicGetQuoteV1Klines = Entry('quote/v1/klines', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_ticker_24hr = publicGetQuoteV1Ticker24hr = Entry('quote/v1/ticker/24hr', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_ticker_price = publicGetQuoteV1TickerPrice = Entry('quote/v1/ticker/price', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_ticker_bookticker = publicGetQuoteV1TickerBookTicker = Entry('quote/v1/ticker/bookTicker', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_depth_merged = publicGetQuoteV1DepthMerged = Entry('quote/v1/depth/merged', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_markprice = publicGetQuoteV1MarkPrice = Entry('quote/v1/markPrice', 'public', 'GET', {'cost': 1})
    public_get_quote_v1_index = publicGetQuoteV1Index = Entry('quote/v1/index', 'public', 'GET', {'cost': 1})
    public_get_api_v1_futures_fundingrate = publicGetApiV1FuturesFundingRate = Entry('api/v1/futures/fundingRate', 'public', 'GET', {'cost': 1})
    public_get_api_v1_futures_historyfundingrate = publicGetApiV1FuturesHistoryFundingRate = Entry('api/v1/futures/historyFundingRate', 'public', 'GET', {'cost': 1})
    public_get_api_v1_ping = publicGetApiV1Ping = Entry('api/v1/ping', 'public', 'GET', {'cost': 1})
    public_get_api_v1_time = publicGetApiV1Time = Entry('api/v1/time', 'public', 'GET', {'cost': 1})
    private_get_api_v1_spot_order = privateGetApiV1SpotOrder = Entry('api/v1/spot/order', 'private', 'GET', {'cost': 1})
    private_get_api_v1_spot_openorders = privateGetApiV1SpotOpenOrders = Entry('api/v1/spot/openOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_spot_tradeorders = privateGetApiV1SpotTradeOrders = Entry('api/v1/spot/tradeOrders', 'private', 'GET', {'cost': 5})
    private_get_api_v1_futures_leverage = privateGetApiV1FuturesLeverage = Entry('api/v1/futures/leverage', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_order = privateGetApiV1FuturesOrder = Entry('api/v1/futures/order', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_openorders = privateGetApiV1FuturesOpenOrders = Entry('api/v1/futures/openOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_usertrades = privateGetApiV1FuturesUserTrades = Entry('api/v1/futures/userTrades', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_positions = privateGetApiV1FuturesPositions = Entry('api/v1/futures/positions', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_historyorders = privateGetApiV1FuturesHistoryOrders = Entry('api/v1/futures/historyOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_balance = privateGetApiV1FuturesBalance = Entry('api/v1/futures/balance', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_liquidationassignstatus = privateGetApiV1FuturesLiquidationAssignStatus = Entry('api/v1/futures/liquidationAssignStatus', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_risklimit = privateGetApiV1FuturesRiskLimit = Entry('api/v1/futures/riskLimit', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_commissionrate = privateGetApiV1FuturesCommissionRate = Entry('api/v1/futures/commissionRate', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_getbestorder = privateGetApiV1FuturesGetBestOrder = Entry('api/v1/futures/getBestOrder', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account_vipinfo = privateGetApiV1AccountVipInfo = Entry('api/v1/account/vipInfo', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account = privateGetApiV1Account = Entry('api/v1/account', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account_trades = privateGetApiV1AccountTrades = Entry('api/v1/account/trades', 'private', 'GET', {'cost': 5})
    private_get_api_v1_account_type = privateGetApiV1AccountType = Entry('api/v1/account/type', 'private', 'GET', {'cost': 5})
    private_get_api_v1_account_checkapikey = privateGetApiV1AccountCheckApiKey = Entry('api/v1/account/checkApiKey', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account_balanceflow = privateGetApiV1AccountBalanceFlow = Entry('api/v1/account/balanceFlow', 'private', 'GET', {'cost': 5})
    private_get_api_v1_spot_subaccount_openorders = privateGetApiV1SpotSubAccountOpenOrders = Entry('api/v1/spot/subAccount/openOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_spot_subaccount_tradeorders = privateGetApiV1SpotSubAccountTradeOrders = Entry('api/v1/spot/subAccount/tradeOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_subaccount_trades = privateGetApiV1SubAccountTrades = Entry('api/v1/subAccount/trades', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_subaccount_openorders = privateGetApiV1FuturesSubAccountOpenOrders = Entry('api/v1/futures/subAccount/openOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_subaccount_historyorders = privateGetApiV1FuturesSubAccountHistoryOrders = Entry('api/v1/futures/subAccount/historyOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_futures_subaccount_usertrades = privateGetApiV1FuturesSubAccountUserTrades = Entry('api/v1/futures/subAccount/userTrades', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account_deposit_address = privateGetApiV1AccountDepositAddress = Entry('api/v1/account/deposit/address', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account_depositorders = privateGetApiV1AccountDepositOrders = Entry('api/v1/account/depositOrders', 'private', 'GET', {'cost': 1})
    private_get_api_v1_account_withdraworders = privateGetApiV1AccountWithdrawOrders = Entry('api/v1/account/withdrawOrders', 'private', 'GET', {'cost': 1})
    private_post_api_v1_userdatastream = privatePostApiV1UserDataStream = Entry('api/v1/userDataStream', 'private', 'POST', {'cost': 1})
    private_post_api_v1_spot_ordertest = privatePostApiV1SpotOrderTest = Entry('api/v1/spot/orderTest', 'private', 'POST', {'cost': 1})
    private_post_api_v1_spot_order = privatePostApiV1SpotOrder = Entry('api/v1/spot/order', 'private', 'POST', {'cost': 1})
    private_post_api_v1_1_spot_order = privatePostApiV11SpotOrder = Entry('api/v1.1/spot/order', 'private', 'POST', {'cost': 1})
    private_post_api_v1_spot_batchorders = privatePostApiV1SpotBatchOrders = Entry('api/v1/spot/batchOrders', 'private', 'POST', {'cost': 5})
    private_post_api_v1_futures_leverage = privatePostApiV1FuturesLeverage = Entry('api/v1/futures/leverage', 'private', 'POST', {'cost': 1})
    private_post_api_v1_futures_order = privatePostApiV1FuturesOrder = Entry('api/v1/futures/order', 'private', 'POST', {'cost': 1})
    private_post_api_v1_futures_position_trading_stop = privatePostApiV1FuturesPositionTradingStop = Entry('api/v1/futures/position/trading-stop', 'private', 'POST', {'cost': 3})
    private_post_api_v1_futures_batchorders = privatePostApiV1FuturesBatchOrders = Entry('api/v1/futures/batchOrders', 'private', 'POST', {'cost': 5})
    private_post_api_v1_account_assettransfer = privatePostApiV1AccountAssetTransfer = Entry('api/v1/account/assetTransfer', 'private', 'POST', {'cost': 1})
    private_post_api_v1_account_authaddress = privatePostApiV1AccountAuthAddress = Entry('api/v1/account/authAddress', 'private', 'POST', {'cost': 1})
    private_post_api_v1_account_withdraw = privatePostApiV1AccountWithdraw = Entry('api/v1/account/withdraw', 'private', 'POST', {'cost': 1})
    private_put_api_v1_userdatastream = privatePutApiV1UserDataStream = Entry('api/v1/userDataStream', 'private', 'PUT', {'cost': 1})
    private_delete_api_v1_spot_order = privateDeleteApiV1SpotOrder = Entry('api/v1/spot/order', 'private', 'DELETE', {'cost': 1})
    private_delete_api_v1_spot_openorders = privateDeleteApiV1SpotOpenOrders = Entry('api/v1/spot/openOrders', 'private', 'DELETE', {'cost': 5})
    private_delete_api_v1_spot_cancelorderbyids = privateDeleteApiV1SpotCancelOrderByIds = Entry('api/v1/spot/cancelOrderByIds', 'private', 'DELETE', {'cost': 5})
    private_delete_api_v1_futures_order = privateDeleteApiV1FuturesOrder = Entry('api/v1/futures/order', 'private', 'DELETE', {'cost': 1})
    private_delete_api_v1_futures_batchorders = privateDeleteApiV1FuturesBatchOrders = Entry('api/v1/futures/batchOrders', 'private', 'DELETE', {'cost': 1})
    private_delete_api_v1_futures_cancelorderbyids = privateDeleteApiV1FuturesCancelOrderByIds = Entry('api/v1/futures/cancelOrderByIds', 'private', 'DELETE', {'cost': 1})
    private_delete_api_v1_userdatastream = privateDeleteApiV1UserDataStream = Entry('api/v1/userDataStream', 'private', 'DELETE', {'cost': 1})