from ccxt.base.types import Entry


class ImplicitAPI:
    public_get_bbo_market = publicGetBboMarket = Entry('bbo/{market}', 'public', 'GET', {'cost': 1})
    public_get_funding_data = publicGetFundingData = Entry('funding/data', 'public', 'GET', {'cost': 1})
    public_get_markets = publicGetMarkets = Entry('markets', 'public', 'GET', {'cost': 1})
    public_get_markets_klines = publicGetMarketsKlines = Entry('markets/klines', 'public', 'GET', {'cost': 1})
    public_get_markets_summary = publicGetMarketsSummary = Entry('markets/summary', 'public', 'GET', {'cost': 1})
    public_get_orderbook_market = publicGetOrderbookMarket = Entry('orderbook/{market}', 'public', 'GET', {'cost': 1})
    public_get_insurance = publicGetInsurance = Entry('insurance', 'public', 'GET', {'cost': 1})
    public_get_referrals_config = publicGetReferralsConfig = Entry('referrals/config', 'public', 'GET', {'cost': 1})
    public_get_system_config = publicGetSystemConfig = Entry('system/config', 'public', 'GET', {'cost': 1})
    public_get_system_state = publicGetSystemState = Entry('system/state', 'public', 'GET', {'cost': 1})
    public_get_system_time = publicGetSystemTime = Entry('system/time', 'public', 'GET', {'cost': 1})
    public_get_trades = publicGetTrades = Entry('trades', 'public', 'GET', {'cost': 1})
    private_get_account = privateGetAccount = Entry('account', 'private', 'GET', {'cost': 1})
    private_get_account_profile = privateGetAccountProfile = Entry('account/profile', 'private', 'GET', {'cost': 1})
    private_get_balance = privateGetBalance = Entry('balance', 'private', 'GET', {'cost': 1})
    private_get_fills = privateGetFills = Entry('fills', 'private', 'GET', {'cost': 1})
    private_get_funding_payments = privateGetFundingPayments = Entry('funding/payments', 'private', 'GET', {'cost': 1})
    private_get_positions = privateGetPositions = Entry('positions', 'private', 'GET', {'cost': 1})
    private_get_tradebusts = privateGetTradebusts = Entry('tradebusts', 'private', 'GET', {'cost': 1})
    private_get_transactions = privateGetTransactions = Entry('transactions', 'private', 'GET', {'cost': 1})
    private_get_liquidations = privateGetLiquidations = Entry('liquidations', 'private', 'GET', {'cost': 1})
    private_get_orders = privateGetOrders = Entry('orders', 'private', 'GET', {'cost': 1})
    private_get_orders_history = privateGetOrdersHistory = Entry('orders-history', 'private', 'GET', {'cost': 1})
    private_get_orders_by_client_id_client_id = privateGetOrdersByClientIdClientId = Entry('orders/by_client_id/{client_id}', 'private', 'GET', {'cost': 1})
    private_get_orders_order_id = privateGetOrdersOrderId = Entry('orders/{order_id}', 'private', 'GET', {'cost': 1})
    private_get_points_data_market_program = privateGetPointsDataMarketProgram = Entry('points_data/{market}/{program}', 'private', 'GET', {'cost': 1})
    private_get_referrals_summary = privateGetReferralsSummary = Entry('referrals/summary', 'private', 'GET', {'cost': 1})
    private_get_transfers = privateGetTransfers = Entry('transfers', 'private', 'GET', {'cost': 1})
    private_post_account_profile_referral_code = privatePostAccountProfileReferralCode = Entry('account/profile/referral_code', 'private', 'POST', {'cost': 1})
    private_post_account_profile_username = privatePostAccountProfileUsername = Entry('account/profile/username', 'private', 'POST', {'cost': 1})
    private_post_auth = privatePostAuth = Entry('auth', 'private', 'POST', {'cost': 1})
    private_post_onboarding = privatePostOnboarding = Entry('onboarding', 'private', 'POST', {'cost': 1})
    private_post_orders = privatePostOrders = Entry('orders', 'private', 'POST', {'cost': 1})
    private_delete_orders = privateDeleteOrders = Entry('orders', 'private', 'DELETE', {'cost': 1})
    private_delete_orders_by_client_id_client_id = privateDeleteOrdersByClientIdClientId = Entry('orders/by_client_id/{client_id}', 'private', 'DELETE', {'cost': 1})
    private_delete_orders_order_id = privateDeleteOrdersOrderId = Entry('orders/{order_id}', 'private', 'DELETE', {'cost': 1})